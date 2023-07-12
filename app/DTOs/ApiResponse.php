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

    public function __construct($success = true, $data = [], $message){

    }

    public function createResponse(){
        return response()->json(
            [
                'success' => $this->success,
                'content' => $this->data,
                'message' => $this->message
            ]
        );
    }
}