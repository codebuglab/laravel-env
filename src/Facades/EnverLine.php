<?php

namespace CodeBugLab\Enver\Facades;

use Illuminate\Support\Facades\Facade;

class EnverLine extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'enverLine';
    }
}
