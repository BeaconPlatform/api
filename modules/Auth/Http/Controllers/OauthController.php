<?php

namespace Beacon\Api\Auth\Http\Controllers;

use Beacon\Api\Core\Http\JsonResponse;
use Pingpong\Modules\Routing\Controller;

class OauthController extends Controller
{
    public function index(JsonResponse $jsonResponse)
    {
        return $jsonResponse->create(null, 'test', 200);
    }

}