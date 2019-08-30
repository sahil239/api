<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Auth;

class BaseController extends Controller
{

    public function sendResponse($result, $message)
    {


        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200)->header('token','TOKEN HERE');
    }

    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}

