<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }elseif($exception instanceof RouteNotFoundException){
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }elseif($exception instanceof NotFoundHttpException){
            return response()->json([
                'error' => 'Incorrect Route'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
