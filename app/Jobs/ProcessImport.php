<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\ImportCompleted;
use App\Import;
use App\Lead;
use Log;

class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $leads;
    protected $import;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Import $import, array $leads)
    {
        $this->import = $import;
        $this->leads = $leads;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Passa pelo array de leads
        foreach ($this->leads as $lead) {

            // Seta o ID da importação no lead
            $lead['import_id'] = $this->import->id;

            // Cria o objeto
            $lead = new Lead($lead);

            // Salva o lead
            if (!$lead->save()) {
                Log::alert("Problema ao salvar lead: " . json_encode($lead));
            }
        }

        // Seta a importação como completa
        $this->import->completed = true;
        $this->import->save();

        // Realiza o broadcast
        event(new ImportCompleted($this->import));
    }
}
