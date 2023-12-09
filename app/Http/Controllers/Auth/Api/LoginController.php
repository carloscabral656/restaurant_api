<?php

namespace App\Http\Controllers\Auth\Api;

use App\DTOs\ApiResponse;
use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if(!auth()->attempt($credentials)) 
        {
            return 
            (    
                new ApiResponse
                (
                    success: false,
                    data   : null,
                    message: null,
                    code   : HttpStatus::FORBIDDEN
                )
            )->createResponse();
        }
    }
}
