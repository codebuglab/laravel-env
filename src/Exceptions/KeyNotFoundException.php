<?php

namespace CodeBugLab\Enver\Exceptions;

use Exception;

class KeyNotFoundException extends Exception
{
    protected $message = 'Key not found exception';
}
