<?php namespace Beacon\Api\Core\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseEntity
 * @package Beacon\Api\Core\Entities
 * @mixin \Eloquent
 */
class BaseEntity extends Model
{
    const CONNECTION_GAME       = 'game';

    /**
     * Connection name (defaults to site)
     *
     * @var     string
     */
    protected $connection       = 'site';
}
