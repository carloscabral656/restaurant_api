<?php

namespace App\Http\Requests\Auth\Api;

use App\DTOs\ApiResponse;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'min:5'
            ],

            'password' => [
                'required',
                'max:255'
            ]
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(
            (new ApiResponse(
                success: false,
                data: $validator->errors()->toArray(),
                message: 'Validation Error.',
                code: JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            ))->createResponse()
        );
    }
}
