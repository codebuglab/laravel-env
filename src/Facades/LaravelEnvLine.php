<?php

namespace CodeBugLab\LaravelEnv\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelEnvLine extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LaravelEnvLine';
    }
}
