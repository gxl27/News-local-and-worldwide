<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, $nessage = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $nessage,
            'data' => $data
        ], $code);
    }

    /**
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message, $nessage = null, $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}