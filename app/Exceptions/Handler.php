<?php

namespace App\Exceptions;

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
        switch (true) {
            case $e instanceof InvalidDataBagException:
                return \response(
                    ['errors' => $e->toArray()],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            case $e instanceof InvalidRequestBodyException:
                return \response(
                    ['errors' => $e->toArray()],
                    Response::HTTP_BAD_REQUEST
                );
            case $e instanceof InvalidRequestContentTypeException:
                return \response(
                    ['errors' => $e->toArray()],
                    Response::HTTP_UNSUPPORTED_MEDIA_TYPE
                );
            default:
                return parent::render($request, $e);
        }
    }
}
