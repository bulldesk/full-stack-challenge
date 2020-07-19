<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AllDoneEvent;
use App\csvData;


class ImportDataListener implements ShouldQueue
{

    public $timeout = 600;

    public function handle($event)
    {
        $request = $event->request;
        $path = $event->path;
        foreach(file($path) as $row => $dataRow) {
            if ($row > 0) {
                $dataCols = explode(';', $dataRow);
                array_unshift($dataCols, '');
                $csvData = new csvData();
                $csvData->imported_id = $dataCols[$request[0]];
                $csvData->nome = $dataCols[$request[1]]; 
                $csvData->email = $dataCols[$request[2]]; 
                $csvData->cpf_cnpj = $dataCols[$request[3]]; 
                $csvData->empresa = $dataCols[$request[4]]; 
                $csvData->profissao_cargo = $dataCols[$request[5]]; 
                $csvData->telefone = $dataCols[$request[6]]; 
                $csvData->cidade = $dataCols[$request[7]];
                $csvData->estado = $dataCols[$request[8]];
                $csvData->pais = $dataCols[$request[9]];
                $csvData->status = $dataCols[$request[10]];
                $csvData->estagio_funil = $dataCols[$request[11]];
                $csvData->titulo_negocio = $dataCols[$request[12]]; 
                $csvData->valor_negocio = $dataCols[$request[13]]; 
                $csvData->conversoes = $dataCols[$request[14]]; 
                $csvData->ultima_conversao = $dataCols[$request[15]]; 
                $csvData->dominio = $dataCols[$request[16]];
                $csvData->data_cadastro = $dataCols[$request[17]];
                $csvData->url = $dataCols[$request[18]];
                $csvData->save();
            }
        }
        unlink($path);
        event(new AllDoneEvent('all done!'));               
    }
}
