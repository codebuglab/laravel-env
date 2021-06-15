<?php

namespace CodeBugLab\LaravelEnv\Exceptions;

use Exception;

class KeyNotFoundException extends Exception
{
    protected $message = 'Key not found exception';
}
