<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Src\Importacao\ImportacaoService;
use App\Jobs\ProcessaImportacao;
use App\Src\Parser\Csv\CsvParser;

class ImportController extends Controller
{   

    protected $importacaoService;

    public function getHeaders(Request $request)
    {   
        $validator = \Validator::make($request->all(), [
            'file' => 'required|file',
        ]);
    
        if ($validator->fails()) {
            return ['status' => false, 'messages' => $validator->errors()];
        }

        if($request->has('file')){

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            if($extension == 'csv'){
                $url = $file->storeAs('importacao',time().".".$extension);
                $csvParser = new CsvParser();  
                $csvParser->setFile($url);
                $csvParser->setDelimeter(";");
                $csvParser->parse();
                $importacaoService = new ImportacaoService($csvParser);
              
                return response()->json([
                    'data' => [
                        'headers' => $importacaoService->getHeaders(),
                        'url' => $url
                    ],
                    'message' => 'success'
                ]);  
            }           
        }
    }

    public function importar(Request $request)
    {
        $csvParser = new CsvParser();  
        $csvParser->setFile($request->input('url'));
        $csvParser->setDelimeter(";");
        $importacaoService = new ImportacaoService($csvParser);
        $importacaoService->setAssoc($request->input('associations'));
        ProcessaImportacao::dispatch($importacaoService);

        return response()->json([
            'data' => [],
            'message' => 'success'
        ]);  
    }
}

