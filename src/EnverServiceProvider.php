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
    }

    public function boot()
    {
        //
    }
}
