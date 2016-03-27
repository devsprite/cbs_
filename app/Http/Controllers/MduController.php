<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 06/10/15
 * Time: 17:34
 */

namespace cbs\Http\Controllers;

use cbs\Data_operateur;
use cbs\DefautsAutomate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class MduController extends Controller
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
            $urlStartAndEndDate = '?daterangepicker_start='.date('m-d-Y', strtotime($startDate)).
                '&daterangepicker_end='.date('m-d-Y', strtotime($endDate));
        } else {
            $startDate = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, date("d"), date("Y")));
            $endDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $urlStartAndEndDate = '';
        }

        $mdu = DefautsAutomate::getDefauts('I_DEF_DISC_CONT_DEC_TRA115', '', 'FERMER', 'OUVRIR', $startDate, $endDate);
        $mduOperateurs = Data_operateur::mdu($startDate, $endDate);
        $rangeDate = Data_operateur::rangeDate($startDate, $endDate, 'asc');

        $mduNotes[] = [];
        $dateExist[] = [];

        if($mduOperateurs != null) {
            foreach ($mduOperateurs as $mduOpe ) {
                $mduNotes[$mduOpe->date] = Data_operateur::mduNotes($mduOpe->date);
            }
        }

        array_shift($mduNotes);

        return view('mdu')->with([
            'mdu' => $mdu,
            'mduOperateurs' => $mduOperateurs,
            'mduNotes' => $mduNotes,
            'rangeDate' => $rangeDate,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'urlStartAndEndDate' => $urlStartAndEndDate
        ]);
    }

    public function post()
    {
        $input = Input::except('_token');

        $row = Data_operateur::find($input['id']);
        $row->update($input);


        return Redirect::route('mdu')->with([
            'success' => 'Mise à jour réussi !']);
    }

}
