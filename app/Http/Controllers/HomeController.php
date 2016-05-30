<?php

namespace cbs\Http\Controllers;

use cbs\Data_operateur;
use cbs\DefautsAutomate;
use cbs\Stats_bagage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class Homecontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        // Est-ce qu'une date de début et de fin est passé en paramètre, sinon on prend le dernier mois
        if (Input::get('daterangepicker_start') && Input::get('daterangepicker_end')) {
            $startDate = HomeController::reOrderDate(Input::get('daterangepicker_start'));
            $endDate = HomeController::reOrderDate(Input::get('daterangepicker_end'));
            $urlStartAndEndDate = '?daterangepicker_start=' . date('m-d-Y', strtotime($startDate)) .
                '&daterangepicker_end=' . date('m-d-Y', strtotime($endDate));
        } else {
            $startDate = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, date("d"), date("Y")));
            $endDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $urlStartAndEndDate = '';
        }

        // Requete pour le graphique du nombre d'interventions quotidienne
        $graphInterventions = Data_operateur::getNumberOfIntervention($startDate, $endDate);

        // Stats Bagages
        $statsBagages = Stats_bagage::getStatsBagages($startDate, $endDate);

        if (!$graphInterventions || !$statsBagages)
            return Redirect::route('form_upload');

        // Nombre de dégradé ultime
        $nbrOfMdu = Data_operateur::getNumberOfCause($startDate, $endDate, 'MODE Dégradé ultime');

        // Nombre d'interventions sur les mobiles
        $nbrInterventionMobiles = Data_operateur::getNumberOfCause($startDate, $endDate, 'Problème de mobile');

        // Nombre d'interventions sur le tomographe
        $nbrInterventionTomographe = Data_operateur::getNumberOfCause($startDate, $endDate, 'Problème Tomographe');

        // Nombre d'interventions sur l'eds
        $nbrInterventionEds = Data_operateur::getNumberOfCause($startDate, $endDate, 'Problème Eds');

        $sumDatas['totalInterventions'] = Homecontroller::sumDatas($graphInterventions);
        $sumDatas['totalInterMobiles'] = count($nbrInterventionMobiles);
        $sumDatas['totalInterTomo'] = count($nbrInterventionTomographe);
        $sumDatas['totalInterEds'] = count($nbrInterventionEds);
        $sumDatas['totalBagages'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'nombre_de_bagages_inspecte_par_eds01');
        $sumDatas['totalLigne1'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'nombre_de_bagages_injectes_par_la_ligne_1');
        $sumDatas['totalLigne2'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'nombre_de_bagages_injectes_par_la_ligne_2');
        $sumDatas['totalRejet'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'nombre_de_bagages_envoyes_vers_chute_rejet');
        $sumDatas['totalTomo'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'nombre_de_bagages_inspectes_par_le_tomographe');
        $sumDatas['totalRejetCBS'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de');
        $sumDatas['totalRejetLigne1'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l');
        $sumDatas['totalRejetLigne2'] = Stats_bagage::getTotalOfSomething($startDate, $endDate, 'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri');

        $mobilesDistinct = Data_operateur::getDistinctMobile();

        $getDefautsMDU = DefautsAutomate::getDefautsDevice('I_DEF_DISC_CONT_DEC_TRA115', $startDate, $endDate);
        $checkResults = Tools::checkResults($getDefautsMDU, 'FERMER');
        if($checkResults !== false){
            return view('checkResults')->with([
                'results' => $checkResults
            ]);
        }
        $defautsMDU = Tools::dureeDefauts($getDefautsMDU);

        $getDefautsTRA100 = DefautsAutomate::getDefautsDevice('PAUSE_TRA100', $startDate, $endDate);
        $defautsTRA100 = Tools::dureeDefauts($getDefautsTRA100);

        $getDefautsTRA110 = DefautsAutomate::getDefautsDevice('PAUSE_TRA110', $startDate, $endDate);
        $defautsTRA110 = Tools::dureeDefauts($getDefautsTRA110);

        $defautsMobiles = StatsController::getDefautsMobiles($startDate, $endDate);
        $defautsMobiles['defauts'] = array_slice($defautsMobiles['defauts'], 0, 3);
        foreach ($defautsMobiles['defauts'] as $numeroMobile => $defautsMobile ) {
            $c = 0;
            foreach ($defautsMobile as $key => $value) {
                $c += $value->count;
            }
            $defautsMobiles['defauts'][$numeroMobile]['total'] = $c;
        }

        $defautsMobiles['cantons'] = array_slice($defautsMobiles['cantons'], 0, 3);
        $defautsMobiles['commentaires'] = array_slice($defautsMobiles['commentaires'], 0, 3);

        $defautsIncendie = DefautsAutomate::getDefauts('DEF_INCENDIE', '', 'FERMER', 'OUVRIR', $startDate, $endDate);

        $lastDateOperateurs = Data_operateur::lastDate();
        $lastDateAutomate = DefautsAutomate::lastDate();
        $lastDateStats = Stats_bagage::lastDate();

        $datasOperateurs = Data_operateur::select('*')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        $derniereMaJ = [
            'operateurs' => $lastDateOperateurs,
            'automate' => $lastDateAutomate,
            'stats' => $lastDateStats
        ];

        return view('accueil')
            ->with([
                'nbrOfMdu' => $nbrOfMdu,
                'sumDatas' => $sumDatas,
                'graphInterventions' => $graphInterventions,
                'statsBagages' => $statsBagages,
                'mobilesDistinct' => $mobilesDistinct,
                'defautsTRA100' => $defautsTRA100,
                'defautsTRA110' => $defautsTRA110,
                'defautsMDU' => $defautsMDU,
                'defautsIncendie' => $defautsIncendie,
                'datasOperateurs' => $datasOperateurs,
                'derniereMaJ' => $derniereMaJ,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'urlStartAndEndDate' => $urlStartAndEndDate,
                'defautsMobiles' => $defautsMobiles
            ]);
    }

    /**
     * retourne la somme des propriété count d'un collection d'objet
     * @return int
     */
    public static function sumDatas($datas)
    {
        $s = 0;
        foreach ($datas as $data) {
            $s += +$data->count;
        }
        return $s;
    }

    /**
     * @param $date string au format mm-dd-YYYY
     * @return string au format YYYY-mm-dd
     */
    public static function reOrderDate($date)
    {
        return substr($date, 6, 4) . '-' . substr($date, 0, 2) . '-' . substr($date, 3, 2);
    }

}