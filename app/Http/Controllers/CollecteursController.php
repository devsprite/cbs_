<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 01/10/15
 * Time: 06:40
 */

namespace cbs\Http\Controllers;

use cbs\DefautsAutomate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CollecteursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($ligne = null)
    {

        if (isset($ligne) && ($ligne == 'ligne1' || $ligne == 'ligne2')) {

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

            if ($ligne == 'ligne1') {
//                $ligneCollecteur = DefautsAutomate::getDefauts('PAUSE_TRA100', 'PAUSE_TRA100', 'FERMER', 'OUVRIR', $startDate, $endDate);
                $ligneCollecteur = DefautsAutomate::getDefautsDevice('PAUSE_TRA100', $startDate, $endDate);
                $ligne = 'Ligne 1 - Toutes compagnies';
            } else {
//                $ligneCollecteur = DefautsAutomate::getDefauts('PAUSE_TRA110', 'PAUSE_TRA110', 'FERMER', 'OUVRIR', $startDate, $endDate);
                $ligneCollecteur = DefautsAutomate::getDefautsDevice('PAUSE_TRA110', $startDate, $endDate);
                $ligne = 'Ligne 2 - Air France';
            }

            $checkResults = Tools::checkResults($ligneCollecteur, 'FERMER');
            if($checkResults !== false){
                return view('checkResults')->with([
                    'results' => $checkResults
                ]);
            }
            $collecteurDefauts = Tools::dureeDefauts($ligneCollecteur);


            return view('collecteurs')->with([
                'collecteurDefauts' => $collecteurDefauts,
                'collecteur' => $ligne,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'urlStartAndEndDate' => $urlStartAndEndDate
            ]);

        } else {
            App::abort(404);
        }


    }

    public function post()
    {
        $input = Input::except('_token');

        $row = DefautsAutomate::find($input['id']);
        $row->update($input);


        return Redirect::route('home')->with([
            'success' => 'Mise à jour réussi !']);
    }

}
