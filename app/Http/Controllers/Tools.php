<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 13/02/2016
 * Time: 17:33
 */

namespace cbs\Http\Controllers;

class Tools
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function checkResults($results, $etat)
    {
        $isOk = false;
        if ($results) {
            foreach ($results as $result) {
                if (Tools::doublons($result, $etat) == false) {
                    return $result;
                } else {

                }
            }
        }
        return $isOk;
    }

    public static function doublons($result, $etat)
    {
        $isOk = true;
        if ($etat == 'FERMER') {
            $debutDefaut = 'OUVRIR';
        } else {
            $debutDefaut = 'FERMER';
        }
        // Vérification du premier defaut
        if ($result[0]->etat_2 != $etat) {
            $isOk = false;
        }

        // Vérification des doublons

        foreach ($result as $r) {
            if ($r->etat_2 != $debutDefaut) {
                $debutDefaut = $r->etat_2;

            } else {
                $isOk = false;
            }
        }

        // Vérification dernière entrée
        $last = end($result);
        if ($last->etat_2 == $etat) {
            $isOk = false;
        }

        return $isOk;
    }


    public static function dureeDefauts($results)
    {
        $retour = [
            'totalDefaut' => 0,
            'totalDuree' => 0
        ];
        if($results) {
            foreach ($results as $result) {

                $time = 0;
                $totalTime = 0;
                foreach ($result as $r) {
                    if ($time == 0) {
                        $time = $r->time;
                    } else {
                        $totalTime += strtotime($r->time) - strtotime($time);
                        $time = 0;
                    }
                }

                $retour = [
                    'totalDefaut' => $retour['totalDefaut'] + count($result) / 2,
                    'totalDuree' => $retour['totalDuree'] + $totalTime,
                ];
                $raw[$result[0]->date] = [
                    'id' => $result[0]->id,
                    'commentaires' => $result[0]->commentaires,
                    'duree' => self::convertTime($totalTime),
                    'nbrDefauts' => count($result) / 2
                ];
                $retour['defauts'] = $raw;
            }
            $retour['totalDuree'] = self::convertTime($retour['totalDuree']);
        }
        return $retour;
    }


    public static function convertTime($time)
    {
        $jours = (int)floor($time / 86400);
        $reste = $time % 86400;
        $heures = (int)floor($reste / 3600);
        $reste = $reste % 3600;
        $minutes = (int)floor($reste / 60);
        $secondes = (int)$reste % 60;

        $t['jours'] = $jours;
        $t['heures'] = str_pad($heures, 2, "0", STR_PAD_LEFT);
        $t['minutes'] = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        $t['secondes'] = str_pad($secondes, 2, "0", STR_PAD_LEFT);

        return $t;
    }
}