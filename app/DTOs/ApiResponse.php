<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 11/07/2023
 * Time: 16:11
 */

namespace App\DTOs;

class ApiResponse
{
    protected $success;
    protected $data;
    protected $message;
    protected $statusCode;

    public function __construct($success = true, $data = [], $message = '', $code){
        $this->success = $success;
        $this->data    = $data;
        $this->message = $message;
        $this->statusCode    = $code;
    }

    public function createResponse(){
        return response()
            ->json(
                [
                    'success' => $this->success,
                    'data'    => $this->data,
                    'message' => $this->message
                ]
            )
            ->setStatusCode($this->statusCode)
            ->header("Content-Type", "application/json");

    }
}
