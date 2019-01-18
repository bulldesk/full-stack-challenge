<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Src\Importacao\Importacao;
use App\Src\Importacao\ImportacaoService;

class ProcessaImportacao implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $importacao;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ImportacaoService $importacao)
    {
        $this->importacao = $importacao;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $this->importacao->importar();
    }
}
