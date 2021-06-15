<?php

namespace CodeBugLab\Env\Facades;

use Illuminate\Support\Facades\Facade;

class Env extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'env';
    }
}
