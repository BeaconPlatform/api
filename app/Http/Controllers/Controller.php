<?php

namespace Beacon\Api\Http\Controllers;

use Beacon\Api\Core\Entities\Person;
use Beacon\Api\Core\Exceptions\PersonNotFoundException;
use Beacon\Api\Core\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use LucaDegasperi\OAuth2Server\Authorizer;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var     Manager
     */
    protected $fractal;

    /**
     * @var     Authorizer
     */
    protected $authorizationServer;

    public function __construct(Manager $fractal, Authorizer $authorizationServer)
    {
        $this->fractal              = $fractal;
        $this->authorizationServer  = $authorizationServer;
    }

    public function collection($collection, $transformer, $key = null)
    {
        return JsonResponse::create($this->createCollectionArray($collection, $transformer, $key));
    }
    public function item($item, $transformer, $key = null)
    {
        return JsonResponse::create($this->createItemArray($item, $transformer, $key));
    }
    public function error($error, $statusCode)
    {
        return JsonResponse::create(null, $error, $statusCode);
    }
    public function errorNotFound($message = 'Not Found')
    {
        return $this->error($message, 404);
    }
    public function errorBadRequest($message = 'Bad Request')
    {
        return $this->error($message, 400);
    }
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->error($message, 403);
    }
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->error($message, 401);
    }
    public function errorInternal($message = 'Internal Error')
    {
        return $this->error($message, 500);
    }

    /**
     * @param $collection
     * @param $transformer
     * @param $key
     *
     * @return array
     */
    public function createCollectionArray($collection, $transformer, $key = null)
    {
        $resource = new Collection($collection, $transformer, $key);
        $data     = $this->fractal->createData($resource)->toArray();
        if (!empty($key)) {
            $data = [$key => $data];
        }
        return $data;
    }
    /**
     * @param $item
     * @param $transformer
     * @param $key
     *
     * @return array
     */
    public function createItemArray($item, $transformer, $key = null)
    {
        $resource = new Item($item, $transformer, $key);
        $data     = $this->fractal->createData($resource)->toArray();
        if (!empty($key)) {
            $data = [$key => $data];
        }
        return $data;
    }

    /**
     * Helper method to retrieve current person based on Resource Owner Identifier.
     *
     * @return      \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Person
     * @throws      PersonNotFoundException
     */
    protected function person()
    {
        try {
            return Person::findOrFail($this->authorizationServer->getResourceOwnerId());
        } catch (ModelNotFoundException $e) {
            throw new PersonNotFoundException;
        }
    }
}
