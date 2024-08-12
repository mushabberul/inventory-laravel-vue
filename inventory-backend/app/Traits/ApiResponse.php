<?php

namespace App\Traits;

trait ApiResponse
{

    /**
     * @param string $message
     * @param mixed $data
     * @param string $status,
     * @param integer $status_code
     * @return mixed
     */

    public function success($message, $data = null,$metadata=null, $status = 'success', $status_code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'metadata'=>$metadata,
            'status' => $status
        ], $status_code);
    }

    /**
     * @param string $message
     * @param mixed $errors
     * @param string $status
     * @param integer $status_code
     * @return mixed
     */
    public function error($message, $errors = null, $status = 'error', $status_code = 400)
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
            'status' => $status
        ], $status_code);
    }
    /**
     * @param string $message
     * @param mixed $errors
     * @param string $status
     * @param integer $status_code
     * @return mixed
     */
    public function info($message, $data = null, $status = 'info', $status_code = 200)
    {
        return response()->json([
            'message' => $message,
            'errors' => $data,
            'status' => $status
        ], $status_code);
    }
}
