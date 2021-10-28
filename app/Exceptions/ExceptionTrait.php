<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// class ExeptionTrait extends Exception
// {
//     //



// }

trait ExceptionTrait
{

    public function apiException($request, $e)
    {
        if ($this->isModel($e)) {
            return $this->ModelResponse($e);
        }

        if ($this->isHttp($e)) {
            return $this->HttpResponse($e);
        }
    }


    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function ModelResponse($e)
    {
        return response()->json([
            'error' => 'Sorry This Product Not Found.',
            'Status' => Response::HTTP_NOT_FOUND
        ], Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse($e)
    {
        return response()->json([
            'error' => 'Incorrect Route',
            'Status' => Response::HTTP_NOT_FOUND
        ], Response::HTTP_NOT_FOUND);
    }
}
