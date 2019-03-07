<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Retorna uma resposta HTTP
     * 
     * @param  array  $data      Array a ser retornado no formato JSON
     * @param  int  $code        Codigo HTTP da resposta
     * @param  string  $message  Mensagem da resposta
     * @return response
     */
    protected function api_response($data, $code = 200, $message = "OK")
    {
    	return response()->json($data)->setStatusCode($code, utf8_decode($message));
    }
}
