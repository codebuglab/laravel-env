<?php

namespace CodeBugLab\Enver\Facades;

use Illuminate\Support\Facades\Facade;

class Enver extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'enver';
    }
}
