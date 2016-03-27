<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 05/09/2015
 * Time: 11:27
 */

namespace cbs\Http\Controllers;


use cbs\Data_operateur;
use cbs\DefautsAutomate;
use cbs\Stats_bagage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Mockery\CountValidator\Exception;

class BaseStatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function modificationStats($id)
    {
        // Enregistrement à modifier
        $row1 = Stats_bagage::where('id', $id)->first();
        // Enregistrement précédant
        $row2 = Stats_bagage::where('date', date("Y-m-d", strtotime($row1->date . " - 1 day")))->first();
        // Si l'enregistrement du jour précédant n'existe pas, on créer un objet vide;
        if(!$row2){
            $row2 = New Stats_bagage();
        }
        // Nouvelle enregistrement, prendra la place de $row1 après validation de l'utilisateur
        $row3 = new Stats_bagage();

        // création du nouvel enregistrement
        try {
            foreach ($row1['attributes'] as $key => $value) {

                switch ($key) {
                    case $key == 'id' :
                        $row3->id = $value;
                        break;
                    case $key == 'date' :
                        $row3->date = $value;
                        break;
                    case $key == 'created_at' :
                        $row3->$key = $value;
                        break;
                    case $key == 'updated_at' :
                        $row3->$key = $value;
                        break;
                    case $key == 'valid' :
                        $row3->$key = $value;
                        break;
                    default:
                        $row3->$key = abs($row1->$key - $row2->$key);
                }
            }

            return view('modificationStat')->with(['row1' => $row1, 'row2' => $row2, 'row3' => $row3]);
        } catch (Exception $e) {
            return view('modificationStat')->with('error', $e);
        }
    }

    /**
     * Page stats CBS
     *
     * @return $this
     */
    public function showStats()
    {
        $showStats = Stats_bagage::orderBy('date', 'desc')->paginate(20);
        return view('showStats')->with('showStats', $showStats);
    }

    /**
     * Page données Opérateurs CBS
     *
     * @return $this
     */
    public function showDatasOperateurs()
    {
        $datasOperateurs = Data_operateur::orderBy('heure_de_debut', 'desc')->paginate(20);
        return view('showDatasOperateurs')->with('datasOperateurs', $datasOperateurs);
    }

    /**
     * Page données automate CBS
     *
     * @return $this
     */
    public function showDefautsAutomate()
    {
        $defautsAutomate = DefautsAutomate::orderBy('date', 'desc')->orderBy('time', 'desc')->paginate(20);
        return view('showDefautsAutomate')->with('defautsAutomate', $defautsAutomate);
    }

    /**
     * mise à jour du tuple correspondant
     */
    public function postStats()
    {
        $input = Input::except('_token');

        $row = Stats_bagage::find($input['id']);
        $row->update($input);

        $showStats = Stats_bagage::orderBy('date', 'desc')->paginate(20);

        return Redirect::route('showStats')->with([
            'success' => 'Mise à jour réussi !',
            'showStats' => $showStats]);
    }

}