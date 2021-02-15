<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message, $result = null)
    {
    	$response = [
            'success' => true,
            'message' => $message,
        ];

        if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $errorMessages = null, $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $message,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
