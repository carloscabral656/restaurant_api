<?php

namespace App\Http\Controllers\Auth\Api;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\DTOs\UserDTO;
use App\Http\Requests\Auth\Api\AuthRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /**
     * Verifiy the digital identity of a client. Grant access to api.
     *
     * @param Request $request
     * @return JsonResponse
    */
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        if(!auth()->attempt($credentials))
        {
            return
            (
                new ApiResponse
                (
                    success: false,
                    data   : null,
                    message: trans('Responses/Auth.InvalidCredentials'),
                    code   : HttpStatus::UNAUTHORIZED
                )
            )->createResponse();
        }

        $user = auth()->user();

        if($user instanceof User)
        {
            $token = $user->createToken('auth_token');
        }

        $data = [
            'token' => $token->plainTextToken
        ];
        return
        (
            new ApiResponse
            (
                success: true,
                data   : $data,
                message: '',
                code   : HttpStatus::OK
            )
        )->createResponse();
    }

    /**
     * Deletes all tokens from the authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
    */
    public function logout(Request $request) : JsonResponse
    {
        $request->user()->tokens()->delete();
        return
        (
            new ApiResponse
            (
                success: true,
                data   : null,
                message: '',
                code   : HttpStatus::OK
            )
        )->createResponse();
    }


    /**
     * Returns the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
    */
    public function me(Request $request): JsonResponse
    {
        try
        {
            $user = $request->user();
            return
            (
                new ApiResponse
                (
                    success: true,
                    data   : (new UserDTO($user))->createDTO(),
                    message: '',
                    code   : HttpStatus::OK
                )
            )->createResponse();
        }catch(Exception $e){
            return
            (
                new ApiResponse
                (
                    success: false,
                    data   : null,
                    message: $e->getMessage(),
                    code   : HttpStatus::BAD_REQUEST
                )
            )->createResponse();
        }
    }
}
