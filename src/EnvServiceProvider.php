<?php

namespace CodeBugLab\Env;

use Illuminate\Support\ServiceProvider;
use CodeBugLab\Env\Providers\EventServiceProvider;

class EnvServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->bind('env', function ($app) {
            return new Env();
        });

        $this->app->bind('envLine', function ($app) {
            return new Line(app('Env'));
        });
    }

    public function boot()
    {
        //
    }
}
