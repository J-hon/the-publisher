<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{

    protected function responseJson(bool $status = true, int $responseCode = 200, string $message = '', mixed $data = []): JsonResponse
    {
        return response()->json([
            'status'    =>  $status,
            'message'   => $message,
            'data'      =>  $data
        ], $responseCode);
    }

}
