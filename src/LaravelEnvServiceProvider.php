<?php

namespace CodeBugLab\LaravelEnv;

use Illuminate\Support\ServiceProvider;
use CodeBugLab\LaravelEnv\Providers\EventServiceProvider;

class LaravelEnvServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->bind('LaravelEnv', function ($app) {
            return new LaravelEnv();
        });

        $this->app->bind('LaravelEnvLine', function ($app) {
            return new Line(app('LaravelEnv'));
        });
    }

    public function boot()
    {
        //
    }
}
