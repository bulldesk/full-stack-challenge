<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Lead;

class ProcessLeads implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fields;
    protected $lead;
    public $total;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->total = $payload['total'];
        $this->fields = $payload['fields'];
        $this->lead = $payload['lead'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $register = [];

        foreach ($this->lead as $field => $value) {
            if (array_key_exists($field, $this->fields)) {
                $register[ $this->fields[ $field ] ] = $value;
            }
        }

        Lead::create($register);
    }
}
