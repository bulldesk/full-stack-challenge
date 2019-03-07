<?php

namespace App\Http\Controllers;

use App\Import;
use App\Jobs\ProcessImport;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $code = 403;
        $message = "Informe o usuário!";

        if ($request->has("created_by") ){
            $code = 200;
            $message = "OK";
            $imports = Import::where("created_by", $request->created_by)->get();
            $data = [ "imports" => $imports ];
        }

        return $this->api_response($data, $code, $message);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $code = 403;
        $message = "Nenhum arquivo CSV recebido!";

        // Verifica se foi enviado o arquivo CSV
        if ($request->has("csv")) {

            $message = "Você enviou um arquivo inválido!";

            // Verifica o formato de dados recebidos
            if (is_array($request->csv)) {

                // Seta os campos importados
                $fields = [];

                foreach ($request->csv[0] as $key => $value) {
                    $fields[] = $key;
                }

                $fields = json_encode($fields);

                // Seta o usuário que esta importando o arquivo
                $user = \Auth::user();

                // Cria o objeto de IMPORT
                $import = new Import([ "fields" => $fields, "created_by" => $user->id ]);

                // Salva o objeto
                if ($import->save()) {

                    $code = 200;
                    $message = "Arquivo importado com sucesso!";
                    $data = [ "import" => $import ];

                    // Processa a importação
                    ProcessImport::dispatch($import, $request->csv);

                } else {
                    $code = 500;
                    $message = "Problema realizar importação!";
                }
            }

        }

        return $this->api_response($data, $code, $message);
    }
}
