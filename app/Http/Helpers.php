<?php
namespace App\Http;

class Helpers
{
    public static function resp($code, $message, $data = [])
    {
        $code = is_numeric($code) ? $code : (int) Config($code);
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $code);
    }

}
