<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use App\Events\ProcessaImportacao;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Queue::before(function (JobProcessing $event) {
            event(new ProcessaImportacao());
        });

        \Queue::after(function (JobProcessed $event) {
            event(new ProcessaImportacao());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      
    }
}
