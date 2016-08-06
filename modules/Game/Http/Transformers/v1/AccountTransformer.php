<?php namespace Beacon\Api\Game\Http\Transformers\v1;

use Beacon\Api\Game\Entities\Account;
use League\Fractal\TransformerAbstract;

class AccountTransformer extends TransformerAbstract
{
    public function transform(Account $account)
    {
        return [
            'account_id'                => (integer) $account->account_id,
            'username'                  => (string) $account->userid,
            'password'                  => $account->user_pass,
            'gender'                    => $account->sex,
            'email'                     => $account->email,
            'group_id'                  => (integer) $account->group_id,
            'state'                     => (integer) $account->state,
            'unban_time'                => (integer) $account->unban_time,
            'expiration_time'           => (integer) $account->expiration_time,
            'login_count'               => (integer) $account->login_count,
            'lastlogin_at'              => $account->lastlogin,
            'lastlogin_ipaddress'       => $account->last_ip,
            'birthdate'                 => $account->birthdate,
            'character_slots'           => (integer) $account->character_slots,
            'pincode'                   => (integer) $account->pincode,
            'pincode_change'            => $account->pincode_change,
            'vip_time'                  => $account->vip_time,
            'deprecated_group_id'       => $account->old_group
        ];
    }
}
