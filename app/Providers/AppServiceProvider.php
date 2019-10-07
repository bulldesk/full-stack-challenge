<?php

namespace App\Providers;

use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Events\LeadsImported;

class AppServiceProvider extends ServiceProvider
{
    protected $count = 0;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Queue::after(function (JobProcessed $event) {
            $this->count++;

            $payload = json_decode($event->job->getRawBody());
            $data = unserialize($payload->data->command);

            if ($this->count === $data->total) {
                broadcast(new LeadsImported());
            }
        });
    }
}
