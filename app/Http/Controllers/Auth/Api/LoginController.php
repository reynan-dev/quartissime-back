<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginAdmin(Request $request)
    {

        // Validar request (A FAIRE)

        $credentials = $request->only('email', 'password');
        
        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken
            ]
        ]);
    }

    public function loginComite(Request $request)
    {

        // Validar request (A FAIRE)

        $credentials = $request->only('identifiant', 'password');

        if (!auth()->attempt($credentials))
            abort(401, 'Invalid Credentials');

        $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken
            ]
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            [], 204
        ]);
    }
/*
    public function getToken($localStorage_token)
    {
        $bdd_token = auth('sanctum')->check();
        dd($bdd_token);
    }*/
}
