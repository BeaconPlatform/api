<?php

namespace Beacon\Api\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Beacon\Api\Core\Http\JsonResponse;
use Illuminate\Http\Exception\HttpResponseException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Request    $request
     * @param  \Exception $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $exceptionMessage = $exception->getMessage();
        $data             = null;
        if (\App::environment() !== 'prod') {
            $data = [
                'debug' => [
                    'message'     => $exceptionMessage,
                    'stack_trace' => $exception->getTrace(),
                ],
            ];
        }
        $errorMessage = 'An error has occurred.';
        if ($this->isHttpException($exception)) {
            if ($exception->getCode() === JsonResponse::HTTP_SERVICE_UNAVAILABLE) {
                return JsonResponse::create(
                    $data,
                    'Platform is currently down for maintenance. Check back soon!',
                    $exception->getCode()
                );
            }
            return JsonResponse::create($data, $exceptionMessage, $exception->getCode());
        }

        if ($exception instanceof HttpResponseException) {
            return JsonResponse::create(
                $exception->getResponse()->getContent(),
                'Input validation failed',
                $exception->getResponse()->getStatusCode()
            );
        }
        if ($exception instanceof NotFoundHttpException) {
            return JsonResponse::create(
                null,
                '404. Welp, that\'s an error.',
                JsonResponse::HTTP_NOT_FOUND
            );
        }
        return JsonResponse::create($data, $errorMessage, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
