<?php

namespace App\Http\Controllers\Auth\Api;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // TODO: VALIDAR REQUEST.
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
}
