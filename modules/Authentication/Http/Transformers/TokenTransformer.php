<?php

namespace Beacon\Api\Authentication\Http\Transformers;

use League\Fractal\TransformerAbstract;
use League\OAuth2\Server\Entity\AccessTokenEntity;

class TokenTransformer extends TransformerAbstract
{
    public function transform(array $payload)
    {
        return [
            'access_token'      => data_get($payload, 'access_token'),
            'refresh_token'     => data_get($payload, 'refresh_token'),
            'expires_in'        => data_get($payload, 'expires_in'),
            'token_type'        => data_get($payload, 'token_type')
        ];
    }
}
