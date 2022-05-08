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
    public function sendResponse($message, $result = null, $code = 200)
    {
    	$response = [
            'success' => true,
            'message' => $message ?? 'Request processed successfully.',
        ];

        if($result !== null){
            $response['data'] = $result;
        }

        return response()->json($response, $code);
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

        if($errorMessages !== null){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
