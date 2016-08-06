<?php namespace Beacon\Api\Core\Exceptions;

use Exception;

class BaseException extends Exception
{
    /**
     * @var     integer
     */
    public $code;

    /**
     * @var     string
     */
    public $message;
}
