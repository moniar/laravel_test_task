<?php

namespace App\Exceptions;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        $headers = collect()->put('Content-Type', 'application/json');
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $content = [
            'errors' => $e instanceof Arrayable ? $e->toArray() : [
                'code' => 'internal_server_error',
                'message' => 'Internal server error'
            ]
        ];

        switch (true) {
            case $e instanceof InvalidDataBagException:
                $status = Response::HTTP_UNPROCESSABLE_ENTITY;
                break;
            case $e instanceof InvalidRequestBodyException:
                $status = Response::HTTP_BAD_REQUEST;
                break;
            case $e instanceof InvalidRequestContentTypeException:
                $headers->put('Accept', $e->getExpectedContentType());
                $status = Response::HTTP_UNSUPPORTED_MEDIA_TYPE;
                break;
            default:
                if (config('app.debug')) {
                    $content = (string)$e;
                    $headers->put('Content-Type', 'text/html');
                }
                break;
        }

        return \response(
            $content,
            $status,
            $headers->all()
        );
    }
}
