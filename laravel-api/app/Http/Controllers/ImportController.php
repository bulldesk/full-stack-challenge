<?php

namespace App\Http\Controllers;

use App\Jobs\ImportLeedsFromCSV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        
        $validator = Validator::make($request->allFiles(), [
            'importLeeds' => 'required|file|mimes:csv,txt'
        ], [
            'required' => 'Um arquivo  é obrigatório',
            'mimes' => 'O arquivo deve estar no formato de csv',
        ], [
            'importLeeds'      => 'Arquivo para importação',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {

            $path = $request->file('importLeeds')->store('toImport');
            ImportLeedsFromCSV::dispatch($path);
            // dd(auth()->user());
            return response()->json(['mensagem'=>'Arquivo recebido! processando importação, ao terminar você será avisado'], 200);
        }
       
    }
}
