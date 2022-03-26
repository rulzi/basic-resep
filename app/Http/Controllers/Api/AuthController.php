<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->sendJson(null,'error', 401, ['error' => 'Unauthorized']);
        }

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];

        return $this->sendJson($data);
    }

    public function me()
    {
        $data = [
            'user' => auth('api')->user(),
        ];

        return $this->sendJson($data);
    }

    public function logout()
    {
        auth('api')->logout();
        
        return $this->sendJson(null, 'Successfully logged out');
    }

    public function refresh()
    {
        $data = [
            'access_token' => auth('api')->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];

        return $this->sendJson($data);
    }
}
