<?php

namespace CodeBugLab\Env\Facades;

use Illuminate\Support\Facades\Facade;

class EnvLine extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'envLine';
    }
}
