<?php

namespace App\Listeners;

use App\Events\ImportCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImportCompletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImportCompleted  $event
     * @return void
     */
    public function handle(ImportCompleted $event)
    {
        //
    }
}
