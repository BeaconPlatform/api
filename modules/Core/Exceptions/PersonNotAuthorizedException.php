<?php namespace Beacon\Api\Core\Exceptions;

class PersonNotAuthorizedException extends BaseException
{
    public $code        = 401;
    public $message     = 'Authorization has failed based on the credentials provided.';
}
