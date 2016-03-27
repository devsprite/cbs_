<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 05/10/15
 * Time: 06:52
 */

namespace cbs\Http\Controllers;


use cbs\Data_operateur;
use cbs\DefautsAutomate;
use Illuminate\Support\Facades\Input;

class TomoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function index()
    {
        // Est-ce qu'une date de début et de fin est passé en paramètre, sinon on prend le dernier mois
        if (Input::get('daterangepicker_start') && Input::get('daterangepicker_end')) {
            $startDate = HomeController::reOrderDate(Input::get('daterangepicker_start'));
            $endDate = HomeController::reOrderDate(Input::get('daterangepicker_end'));
            $urlStartAndEndDate = '?daterangepicker_start='.date('m-d-Y', strtotime($startDate)).
                '&daterangepicker_end='.date('m-d-Y', strtotime($endDate));
        } else {
            $startDate = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, date("d"), date("Y")));
            $endDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $urlStartAndEndDate = '';
        }

        $tomo = DefautsAutomate::getDefauts('CTX_OK', '', 'OUVRIR', 'FERMER', $startDate, $endDate);
//        $tomo = DefautsAutomate::getDefauts('DEF_API', 'OUVRIR', 'FERMER', $startDate, $endDate);
        $rangeDate = Data_operateur::rangeDate($startDate, $endDate, 'asc');

        return view('tomographe')->with([
            'tomo' => $tomo,
            'rangeDate' => $rangeDate,
            'urlStartAndEndDate' => $urlStartAndEndDate
        ]);
    }

}