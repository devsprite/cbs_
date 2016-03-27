<?php


namespace cbs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DefautsAutomate extends Model
{
    protected $fillable = ['date', 'time', 'defaut', 'etat_1', 'etat_2', 'description', 'commentaires'];


    public static function getDefautsByHours($defaut_1, $defaut_2, $startDate, $endDate)
    {
        $datas = DB::table('defauts_automates')
            ->selectRaw('*, COUNT(*) as count')
            ->whereRaw('( defaut = "' . $defaut_1 . '" OR defaut = "' . $defaut_2 . '" )')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereBetween('time', ["04:30:00", "21:30:00"])
            ->groupBy(DB::raw('HOUR(time)'))
            ->orderBy('count', 'asc')
            ->get();

        return $datas;
    }

    public static function getDefautsByDays($defaut_1, $defaut_2, $startDate, $endDate)
    {
        $datas = DB::table('defauts_automates')
            ->selectRaw('*, COUNT(*) as count')
            ->whereRaw('( defaut = "' . $defaut_1 . '" OR defaut = "' . $defaut_2 . '" )')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereBetween('time', ["04:30:00", "21:30:00"])
            ->groupBy(DB::raw('DAY(date), MONTH(date)'))
            ->orderBy('count', 'asc')
            ->get();

        return $datas;
    }

    public static function getDefautsByMonth($defaut_1, $defaut_2)
    {
        $datas = DB::table('defauts_automates')
            ->selectRaw('*, COUNT(*) as count')
            ->whereRaw('( defaut = "' . $defaut_1 . '" OR defaut = "' . $defaut_2 . '" )')
//            ->whereBetween('time', ["04:30:00", "21:30:00"])
            ->groupBy(DB::raw('MONTH(date), YEAR(date)'))
            ->orderBy('count', 'asc')
            ->get();

        return $datas;
    }


    public static function getDefautsDevice($defaut_1, $startDate, $endDate)
    {
        $datas = DB::table('defauts_automates')
            ->selectRaw('*')
            ->whereRaw('( defaut = "' . $defaut_1 . '" )')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereBetween('time', ["04:30:00", "21:30:00"])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        if ($datas) {
            // on initialise le tableau de resultats
            $results[$datas[0]->date] = [];
            foreach ($datas as $data) {
                $results[$data->date] = [];
            }
            // On affecte chaque resultat à la date correspondant au defaut
            foreach ($datas as $data) {
                array_push($results[$data->date], $data);
            }
        } else {
            $results = false;
        }
        return $results;
    }


    /**
     * Retourne un tableau correspondant aux jours des defaut avec le temps
     * d'apparition du defaut par jour et le total sur la periode
     *
     * @param $defaut
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public static function getDefauts($defaut_1, $defaut_2, $debutDefaut, $finDefaut, $startDate, $endDate)
    {
        $datas = DB::table('defauts_automates')
            ->selectRaw('*')
            ->whereRaw('( defaut = "' . $defaut_1 . '" OR defaut = "' . $defaut_2 . '" )')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereBetween('time', ["04:30:00", "21:30:00"])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $defauts[] = [];
        $defauts_etape_1[] = [];
        $defauts_etape_2[] = [];

        foreach ($datas as $d) {
            // On classe les defauts par jour
            if (isset($defauts[$d->date])) {
                $defauts[$d->date] += [$d->time => $d->etat_2];
                $defauts[$d->date] += ["commentaires" => $d->commentaires,
                    "id" => $d->id
                ];

            } else {
                $defauts = array_add($defauts, $d->date, [$d->time => $d->etat_2]);
                $defauts[$d->date] += ["commentaires" => $d->commentaires,
                    "id" => $d->id
                ];
            }
        }

        // On efface l'entrée vide
        array_shift($defauts);
        array_shift($defauts_etape_1);
        array_shift($defauts_etape_2);
        // on boucle sur les resultats de chaque journée
        foreach ($defauts as $k => $v) {

            if (count($v) >= 2) { // On vérifie qu'il y a 2 lignes de defauts
                $defauts_etape_1[$k] = DefautsAutomate::checkFirstEntry($v, $debutDefaut);

                $defauts_etape_2[$k] = DefautsAutomate::checkDoublons($defauts_etape_1[$k], $debutDefaut);

                $somme = (int)count($defauts_etape_2[$k]) / 2;
                $defauts_etape_2[$k]['Total'] = $somme;

                $defauts_etape_2[$k]['dureeDefaut'] = DefautsAutomate::dureeDefaut($defauts_etape_2[$k], $debutDefaut, $finDefaut);
            }
        }

        $dureeDef = 0;
        $nbrDefaut = 0;

        foreach ($defauts_etape_2 as $key => $value) {

            $dureeDef += strtotime($value['dureeDefaut']);
            $nbrDefaut += $value['Total'];
        }

        $defauts_etape_2['totalDuree'] = $dureeDef;
        $defauts_etape_2['totalDefaut'] = $nbrDefaut;

        return $defauts_etape_2;

    }

    /**
     * Si le tableau ne commence pas par le bon etat, on efface l'entrée correspondante
     *
     * @param $v
     * @param $etat
     * @return mixed
     */
    public static function checkFirstEntry($v, $debutDefaut)
    {
        reset($v);
        $first_key = key($v);

        while (isset($v[$first_key]) != $debutDefaut) {
            unset($v[$first_key]);
            reset($v);
            $first_key = key($v);
        }

        return $v;
    }

    /**
     * On efface l'entrée qui est en doublons, ou la derniere entrée si l'etat est le meme que la première
     * ex: deux OUVRIR à la suite ne doivent pas exister
     *
     * @param $v
     * @param $etat
     */
    private static function checkDoublons($v, $debutDefaut)
    {

        $e = $debutDefaut; // On memorise l'état initial d'apparition du defaut
        $first = true; // utiliser pour ne pas controler la première entrée

        foreach ($v as $key => $value) {

            if (!$first && $value == $e) {
                unset($v[$key]);
            }

            $e = $value;
            $first = false;
        }

        // Si la derniere entrée du tableau est dans le même etat que la première, on efface la derniere entree

        end($v);
        $end_key = key($v);

        if ($v[$end_key] == $debutDefaut) {
            array_pop($v);
        }

        return $v;
    }

    /**
     * Fait la somme du temps d'apparition du defaut
     *
     * @param $k
     * @param $debutDefaut
     * @param $finDefaut
     * @return bool|string
     */
    private static function dureeDefaut($k, $debutDefaut, $finDefaut)
    {
        $d_open = array_keys($k, $debutDefaut);
        $d_close = array_keys($k, $finDefaut);
        $dureeDefaut = 0;

        if (count($d_open) == count($d_close)) {
            for ($i = 0; $i < count($d_open); $i++) {
                $dureeDefaut += strtotime($d_close[$i]) - strtotime($d_open[$i]);
            }
        }

        return date('H:i:s', $dureeDefaut);
    }

    public static function lastDate()
    {
        $datas = DB::table('defauts_automates')
            ->select('date')
            ->orderBy('date', 'desc')
            ->first();

        return $datas;
    }

    public static function getAjax($recherche)
    {
        $datas = DB::table('defauts_automates')
            ->select('*')
            ->where('defaut', 'LIKE', '%' . $recherche . '%')
            ->orWhere('description', 'LIKE', '%' . $recherche . '%')
            ->orWhere('date', 'LIKE', '%' . $recherche . '%')
            ->distinct()
            ->take(400)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return $datas;
    }

}
