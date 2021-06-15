<?php

namespace CodeBugLab\Env\Exceptions;

use Exception;

class KeyNotFoundException extends Exception
{
    protected $message = 'Key not found exception';
}
