<?php

namespace App\Exceptions;

use Exception;

class TestingHttpException extends Exception
{
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            if (view()->exists('errors.' . $exception->getStatusCode())) {
                return response()->view('errors.' . $exception->getStatusCode(), [], $exception->getStatusCode());
            }
        }

        return parent::render($request, $exception);
    }
}
