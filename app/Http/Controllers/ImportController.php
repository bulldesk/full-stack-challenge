<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Src\Importacao\ImportacaoCsv;
use App\Jobs\ProcessaImportacao;
use App\Src\Parser\Csv\CsvParser;


class ImportController extends Controller
{   



    public function __construct(){
            
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assoc = $request->input('associations');
        $url = $request->input('url');
        $importacaoCsv = new ImportacaoCsv();
        $importacaoCsv->setAssoc($assoc);
        $importacaoCsv->setUrl($url);
        ProcessaImportacao::dispatch($importacaoCsv);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getHeaders(Request $request){

        if($request->has('file')){

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            if($extension == 'csv'){

                $url = $file->storeAs('importacao',time().".".$extension);
                $csvParser = new CsvParser('importacao/leads.csv', ";");     
                $csvParser->parse();

                return response()->json([
                    'data' => [
                        'headers' => $csvParser->getHeaders(),
                        'url' => $url
                    ],
                    'message' => 'success'
                ]);
                
            }           
        }
    }
}

