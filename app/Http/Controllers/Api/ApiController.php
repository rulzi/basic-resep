<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 201;
    const BAD_REQUEST = 400;
    const FORBIDEN = 403;
    const NOT_FOUND = 404;
    const NOT_ACCEPTABLE = 406;

    public function sendJson($data = null, $message = 'success',  $status = 200, $error = null)
    {
        if(!empty($error)){
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
                'error' => $error
            ], $status);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
