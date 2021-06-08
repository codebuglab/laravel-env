<?php

namespace CodeBugLab\Enver;

use Illuminate\Support\ServiceProvider;

class EnverServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('enver', function ($app) {
            return new Enver();
        });

        $this->app->bind('enverLine', function ($app) {
            return new Line(app('enver'));
        });
    }

    public function boot()
    {
        //
    }
}
