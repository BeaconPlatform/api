<?php

namespace Beacon\Api\Authentication\Http\Controllers\OAuth2;

use Beacon\Api\Authentication\Http\Transformers\TokenTransformer;
use Beacon\Api\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Authorizer;

class TokenController extends Controller
{
    public function issue(Authorizer $authorizationServer)
    {
        return $this->item($authorizationServer->issueAccessToken(), new TokenTransformer, 'token');
    }
}
