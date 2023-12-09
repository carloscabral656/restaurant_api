<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 11/07/2023
 * Time: 16:11
 */

namespace App\DTOs;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    protected bool $success;
    protected ?array $data;
    protected ?string $message;
    protected int $statusCode;
    protected ?string $metaData;

    public function __construct($success = true, $data = [], $message = '', $code, $metaData = null){
        $this->success = $success;
        $this->data    = $data;
        $this->message = $message;
        $this->statusCode = $code;
        $this->metaData = $metaData;
    }

    public function createResponse() : JsonResponse{
        return response()
            ->json(
                [
                    'success' => $this->success,
                    'data'    => $this->data,
                    'code'    => $this->statusCode,
                    'meta_data' => $this->metaData,
                    'message' => $this->message
                ]
            )
            ->setStatusCode($this->statusCode)
            ->header("Content-Type", "application/json");
    }
}
