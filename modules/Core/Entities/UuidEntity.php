<?php namespace Beacon\Api\Core\Entities;

use Eloquence\Behaviours\Uuid;

class UuidEntity extends BaseEntity
{
    use Uuid;

    public $incrementing        = false;
    protected $primaryKey       = 'uuid';
}
