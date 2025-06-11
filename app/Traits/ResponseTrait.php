<?php

namespace App\Traits;

use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{
    public function successResponse($data = [], $message = '', $status = Response::HTTP_OK, $header = [])
    {
        return new SuccessResponse($data, $message, $status, $header);
    }

    public function errorResponse($message = '', $exception = null, $code = 500)
    {
        return new ErrorResponse($message, $exception, $code);
    }
}
