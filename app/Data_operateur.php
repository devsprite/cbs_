<?php

namespace cbs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Data_operateur extends Model
{
    protected $fillable = ['date', 'heure_de_debut', 'duree', 'nombre_agent', 'intervenant', 'mobile', 'numero_canton',
        'numero_convoyeur', 'defaut_eds', 'defaut_tomographe', 'saturation_chute', 'cause', 'mode_de_defaillance',
        'symptome', 'commentaires', 'valid'];


    /**
     * Retourne le nombre d'interventions tout confondu par jour
     * @param String $startDate au format YYYY-mm-dd
     * @param String $endDate au format YYYY-mm-dd
     * @return un array avec le nombre d'interventions par jour tout confondu
     */
    public static function getNumberOfIntervention($startDate, $endDate)
    {
        $datas = DB::table('data_operateurs')
            ->selectRaw('date, COUNT(*) as count')
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return $datas;
    }

    /**
     * Retourne le nombre d'intervention par jour par mobile
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public static function getNumberOfInterventionsDailyMobile($mobile, $startDate, $endDate)
    {
        $datas = DB::table('data_operateurs')
            ->selectRaw('date, COUNT(mobile) as count')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('mobile', '=', $mobile)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return $datas;
    }


    /**
     * Nombre de probleme par entité grouper par nombre d'occurence
     * @param $startDate
     * @param $endDate
     * @param $devices
     * @return array
     */
    public static function getNumberOfProblemByDevice($startDate, $endDate, $devices)
    {
        $datas = [];

        foreach ($devices as $key) {
            $datas[$key] = DB::table('data_operateurs')
                ->selectRaw($key . ', COUNT(*) as count')
                ->whereBetween('date', [$startDate, $endDate])
                ->groupBy($key)
                ->orderBy('count', 'desc')
                ->get();
        }

        return $datas;
    }

    /**
     * Retourne le nombre de type de probleme par entité
     * @param $startDate
     * @param $endDate
     * @param $devices
     * @param $typeDefaut
     * @param $typeDevice
     * @return array
     */
    public static function getNumberOfTypeProblemByDevice($startDate, $endDate, $devices, $typeDefaut, $typeDevice) {

        $datas = [];
        foreach ($devices as $key) {
            $key = get_object_vars($key);

            $datas[$key[$typeDevice]] = DB::table('data_operateurs')
                ->selectRaw($typeDefaut . ', date,  COUNT(*) as count')
                ->whereBetween('date', [$startDate, $endDate])
                ->where($typeDevice, '=', $key[$typeDevice] )
                ->groupBy($typeDefaut)
                ->orderBy('count', 'desc')
                ->orderBy('date', 'desc')
                ->get();
        }

        return $datas;
    }


    /**
     * Renvoie l'ensemble des jours demandés
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public static function rangeDate($startDate, $endDate, $order)
    {
        $datas = DB::table('data_operateurs')
            ->select('date')
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', $order)
            ->get();

        return $datas;
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $cause correspond à la colonne cause de la table data_operateurs
     * @return mixed
     */
    public static function getNumberOfCause($startDate, $endDate, $cause)
    {
        $datas = DB::table('data_operateurs')
            ->select('date')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('cause', '=', $cause)
            ->orderBy('date', 'asc')
            ->get();

        return $datas;
    }

// Retourne tous les mobiles
    public static function getDistinctMobile()
    {
        $datas = DB::table('data_operateurs')
            ->select('mobile')
            ->where('mobile', '!=', 'null')
            ->distinct()
            ->orderBy('mobile', 'asc')
            ->get();

        return $datas;
    }


    public static function getMobile($mobile, $startDate, $endDate)
    {
        $datas = DB::table('data_operateurs')
            ->select('*')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('mobile', '=', $mobile)
            ->orderBy('heure_de_debut', 'desc')
            ->get();

        return $datas;
    }

    /**
     * retourne tous les mdu
     *
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public static function mdu($startDate, $endDate)
    {
        $datas = DB::table('data_operateurs')
            ->select('*')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('cause', '=', 'MODE Dégradé ultime')
            ->orderBy('heure_de_debut', 'desc')
            ->get();

        return $datas;
    }

    public static function lastDate()
    {
        $datas = DB::table('data_operateurs')
            ->select('date')
            ->orderBy('date', 'desc')
            ->first();

        return $datas;
    }

    public static function mduNotes($date)
    {
        $datas = DB::table('data_operateurs')
            ->select('*')
            ->where('date', '=', $date)
            ->orderBy('heure_de_debut', 'asc')
            ->get();

        return $datas;
    }

    public static function getAjax($recherche)
    {
        $datas = DB::table('data_operateurs')
            ->select('*')
            ->where('cause', 'LIKE', '%' . $recherche . '%')
            ->orWhere('symptome', 'LIKE', '%' . $recherche . '%')
            ->orWhere('commentaires', 'LIKE', '%' . $recherche . '%')
            ->orWhere('mobile', 'LIKE', '%' . $recherche . '%')
            ->orWhere('numero_canton', 'LIKE', '%' . $recherche . '%')
            ->orWhere('numero_canton', 'LIKE', '%' . $recherche . '%')
            ->orWhere('date', 'LIKE', '%' . $recherche . '%')
            ->distinct()
            ->take(100)
            ->orderBy('heure_de_debut', 'desc')
            ->get();

        return $datas;
    }

}


