<?php namespace Beacon\Api\Core\Entities;

/**
 * Class        Person
 * @package     Beacon\Api\Core\Entities
 * @property    string      $uuid
 * @property    string      $username
 * @property    string      $email
 * @property    string      $password
 * @property    boolean     $isConfirmed
 */
class Person extends UuidEntity
{
    protected $table        = 'person';
}
