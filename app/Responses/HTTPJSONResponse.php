<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class HTTPJSONResponse extends JsonResponse
{
    public function __construct($data = null, $status = 'success', $status_code = 200, array $headers = [], $options = 0)
    {
        $customData = [
            'status' => $status,
            'status_code' => $status_code,
            'data' => $data,
            'message' => $status_code === 200 ? 'Operation successful' : 'An error occurred'
        ];

        parent::__construct($customData, $status_code, $headers, $options);
    }

    public static function success($data, $message = 'Operation successful', $status="success", $status_code = 200)
    {
        return new static([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ], $status_code);
    }

    public static function error($message = 'An error occurred',$status = 'error', $status_code = 500, $data = [])
    {
        return new static([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ], $status_code);
    }
}