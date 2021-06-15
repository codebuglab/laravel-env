<?php

namespace CodeBugLab\LaravelEnv\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelEnv extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LaravelEnv';
    }
}
