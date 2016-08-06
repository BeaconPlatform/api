<?php namespace Beacon\Api\Game\Entities;

use Beacon\Api\Core\Entities\BaseEntity;

class Account extends BaseEntity
{
    protected $connection   = self::CONNECTION_GAME;
    protected $table        = 'login';
}
