<?php

namespace Laravel\Scout;

use Illuminate\Support\ServiceProvider;
use Laravel\Scout\Console\ClearCommand;
use Laravel\Scout\Console\ImportCommand;

class ScoutServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EngineManager::class, function ($app) {
            return new EngineManager($app);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportCommand::class,
                ClearCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/scout.php' => config_path('scout.php'),
            ]);
        }
    }
}
