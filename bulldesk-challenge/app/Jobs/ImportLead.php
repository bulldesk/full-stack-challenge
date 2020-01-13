<?php

namespace App\Jobs;

use App\Events\ImportDone;
use App\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;

class ImportLead implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $lead;
    public $user_id;
    public $last;
    public $index;

    /**
     * Create a new job instance.
     *
     * @param array $lead
     * @param int $user_id
     * @param int $index
     * @param bool $last
     *
     * @return void
     */
    public function __construct(array $lead, int $user_id, int $index, bool $last = false)
    {
        $this->lead = $lead;
        $this->user_id = $user_id;
        $this->index = $index;
        $this->last = $last;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Lead::create($this->lead);
        if ($this->last === true) {
            $user = Auth::loginUsingId($this->user_id);
            broadcast(new ImportDone($user, $this->index + 1 ." registros importados."))->toOthers();
        }
    }
}
