<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 14/09/15
 * Time: 21:17
 */

namespace cbs\Http\Controllers;

use cbs\Data_operateur;
use Illuminate\Support\Facades\Input;

class MobilesController extends Controller
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

//        $mobiles = [];
//        $mobilesDistinct = Data_operateur::getDistinctMobile();
//
//        foreach($mobilesDistinct as $m){
//                $mobiles[$m->mobile][0] = Data_operateur::getMobile($m->mobile, $startDate, $endDate);
//                $mobiles[$m->mobile][1] = Data_operateur::getNumberOfInterventionsDailyMobile($m->mobile, $startDate, $endDate);
//                $mobiles[$m->mobile][2] = count($mobiles[$m->mobile][0]);
//        }
//
//        // Classement par ordre décroissant du nombre de defaut
//        rsort($mobiles);
//
//        $rangeDate = $this->getDefauts($startDate, $endDate);
        $m = $this->getDefauts($startDate, $endDate);


        return view('mobiles/mobiles')->with([
            'mobiles' => $m['mobiles'],
            'mobilesDistinct' => $m['mobilesDistinct'],
            'startDate' => $startDate,
            'rangeDate' => $m['rangeDate'],
            'endDate' => $endDate,
            'urlStartAndEndDate' => $urlStartAndEndDate
        ]);
    }

    public function getDefauts($startDate, $endDate)
    {
        $mobiles = [];
        $mobilesDistinct = Data_operateur::getDistinctMobile();

        foreach ($mobilesDistinct as $m) {
            $mobiles[$m->mobile][0] = Data_operateur::getMobile($m->mobile, $startDate, $endDate);
            $mobiles[$m->mobile][1] = Data_operateur::getNumberOfInterventionsDailyMobile($m->mobile, $startDate, $endDate);
            $mobiles[$m->mobile][2] = count($mobiles[$m->mobile][0]);
        }

        // Classement par ordre décroissant du nombre de defaut
        rsort($mobiles);

        $rangeDate = $this->getDefauts($startDate, $endDate);

        $r = array(
            'mobiles' => $mobiles,
            'mobilesDistinct' => $mobilesDistinct,
            'rangeDate' => $rangeDate
        );

        return $r;
    }

}