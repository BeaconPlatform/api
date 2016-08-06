<?php namespace Beacon\Api\Core\Exceptions;

class PersonNotFoundException extends BaseException
{
    public $code        = 404;
    public $message     = 'Person record was not found.';
}
