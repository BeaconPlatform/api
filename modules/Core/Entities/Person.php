<?php namespace Beacon\Api\Core\Entities;

use Beacon\Api\Game\Entities\Account;
use Illuminate\Support\Collection;

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

    /**
     * @return      PersonGameAccountXref
     */
    public function gameAccounts()
    {
        /**
         * @var     Collection      $xrefRecords
         */
        $xrefRecords        = $this->hasMany(PersonGameAccountXref::class, 'uuid', 'uuid')->get();

        return $xrefRecords->map(function (PersonGameAccountXref $record) {
            return $record->gameAccount();
        });
    }
}
