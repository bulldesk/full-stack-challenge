<?php

namespace App\Jobs;

use App\Leads;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InsertLeads implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $leadData;

    /**
     * Create a new job instance.
     *
     * @param $leadData
     */
    public function __construct($leadData)
    {
        $this->leadData = $leadData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Leads::create($this->leadData);
    }
}
