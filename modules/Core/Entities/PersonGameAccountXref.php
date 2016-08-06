<?php namespace Beacon\Api\Core\Entities;

use Beacon\Api\Game\Entities\Account;

class PersonGameAccountXref extends BaseEntity
{
    public $incrementing        = false;
    protected $table            = 'person_gameaccount_xref';

    /**
     * Return the game account.
     *
     * @return      Account
     */
    public function gameAccount()
    {
        return $this->hasOne(Account::class, 'account_id', 'game_account_id')->first();
    }
}
