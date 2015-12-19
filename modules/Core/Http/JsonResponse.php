<?php

namespace Beacon\Api\Core\Http;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\MessageBag;

class JsonResponse extends Response
{
    /**
     * @var int
     */
    protected $code;
    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param       array|null              $data
     * @param       MessageBag|string|null  $message
     * @param       array|integer           $code
     */
    public function __construct($data = null, $message = null, $code = self::HTTP_OK)
    {
        $this->code     = $code;

        if ($message instanceof MessageBag) {
            $message    = $message->first();
        }

        parent::__construct([
            'status'  => $this->getStatus(),
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    /**
     * Retrieve status for response.
     *
     * @return      string
     */
    protected function getStatus()
    {
        switch (true) {
            case ($this->code >= self::HTTP_OK and $this->code < self::HTTP_MULTIPLE_CHOICES):
                $status     = 'success';
                break;
            case ($this->code >= self::HTTP_BAD_REQUEST and $this->code < self::HTTP_INTERNAL_SERVER_ERROR):
                $status     = 'fail';
                break;
            default:
                $status     = 'error';
                break;
        }

        return $status;
    }

    /**
     * Create a response.
     *
     * @param       array|null              $data
     * @param       MessageBag|string|null  $message
     * @param       array|integer           $code
     * @return      static
     */
    public static function create($data = null, $message = null, $code = self::HTTP_OK)
    {
        return new static($data, $message, $code);
    }
}