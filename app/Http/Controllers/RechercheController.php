<?php

namespace cbs\Http\Controllers;

use cbs\Data_operateur;
use cbs\DefautsAutomate;
use Illuminate\Support\Facades\DB;
use Request;
use Illuminate\Support\Facades\Input;

class RechercheController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postAjax()
    {
        $recherche = "";
        $pattern = '/^\d{2}-\d{2}-\d{4}$/';
        if (Request::ajax()) {
            $recherche = trim(Input::get('recherche'));
            if(preg_match($pattern, $recherche)){
                $recherche = substr($recherche,6,4).'-'.substr($recherche,3,2).'-'.substr($recherche,0,2);
            }
        }

        $recherches['operateurs'] = Data_operateur::getAjax($recherche);
        $recherches['automate'] = DefautsAutomate::getAjax($recherche);

        return view('recherche')->with('recherches', $recherches);
    }
}
