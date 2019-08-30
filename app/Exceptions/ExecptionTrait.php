<?php

namespace App\Exceptions;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

trait ExceptionTrait
{

    public function apiException($request,$exception){

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if($exception instanceof RouteNotFoundException){
            return response()->json([
                'error' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if($exception instanceof NotFoundHttpException){
            return response()->json([
                'error' => 'Incorrect Route'
            ], Response::HTTP_NOT_FOUND);
        }

        return parent::render($request,$exception);
    }
}
