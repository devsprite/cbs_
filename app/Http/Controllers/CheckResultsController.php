<?php

namespace cbs\Http\Controllers;


use cbs\DefautsAutomate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CheckResultsController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function post(){
        $input = Input::except('_token');


        $row = DefautsAutomate::find($input['id']);
        $row->update($input);

        return Redirect::route('home')->with([
            'success' => 'Mise à jour réussi !']);
    }

}

