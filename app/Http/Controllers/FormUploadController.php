<?php
namespace cbs\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class FormUploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->email == ('greeftdc@gmail.com' || 'p.emery@montpellier.aeroport.fr') ) {
            return view('form_upload');
        } else {
            return redirect('/');
        }
    }


    public function uploadFile(Request $request)
    {
        $input = Input::all();
        $rules = array(
            'file' => 'required',
            'extension' => 'xls,xlsm,ALM'
        );
        Log::info('Type : ' . $request->file('file')->getMimeType());
        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::json('Le fichier n\'est pas valide !', 400);
        }

        $file = Input::file('file');
        $destinationPath = 'uploads';

        $filename = $file->getClientOriginalName();
        $upload_success = Input::file('file', null, 'UTF-8')->move($destinationPath, $filename);

        $name_file = $destinationPath . '/' . $filename;

        Log::info('File_path : ' . $name_file);

        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
}