<?php

namespace CodeBugLab\Env\Exceptions;

use Exception;

class KeyAlreadyExistsException extends Exception
{
    protected $message = "Key already exists";
    protected $code = 1;
}
