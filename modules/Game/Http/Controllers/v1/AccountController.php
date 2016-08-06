<?php namespace Beacon\Api\Game\Http\Controllers\v1;

use Beacon\Api\Game\Http\Transformers\v1\AccountTransformer;
use Beacon\Api\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Authorizer;

class AccountController extends Controller
{
    public function index(Authorizer $authorizationServer)
    {
        return $this->collection($this->person()->gameAccounts(), new AccountTransformer, 'accounts');
    }
}
