<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $array = (array) $request->all();

        if (!$array['email']) {
            $validator = Validator::make(
                $array,
                [
                    'identifiant' => 'alpha|min:3|max:255',
                    'password' => 'required|alpha_dash|min:8',
                ],
                [
                    'identifiant' => 'Email invalide, il fault mettre un email valide.',
                    'password' => 'Le mot de passe doit contenir des chiffres, des lettres et des caractères spéciaux.'
                ]
            );

            if ($validator->fails()) {
                return response()->json($validator->messages(), 406);
            } else {

                $credentials = $request->only('identifiant', 'password');

                if (!auth()->attempt($credentials)) {
                    return response()->json(['message' => 'Invalid Credentials'], 401);
                }

                $token = auth()->user()->createToken('auth_token');

                return response()->json([
                    'token' => $token->plainTextToken
                ]);
            };
        } else {
            $validator = Validator::make(
                $array,
                [
                    'email' => 'required|email:rfc,dns',
                    'password' => 'required|alpha_dash|min:8',
                ],
                [
                    'email' => 'Email invalide, il fault mettre un email valide.',
                    'password' => 'Le mot de passe doit contenir des chiffres, des lettres et des caractères spéciaux.'
                ]
            );

            if ($validator->fails()) {
                return response()->json($validator->messages(), 406);
            } else {

                $credentials = $request->only('email', 'password');

                if (!auth()->attempt($credentials)) {
                    return response()->json(['message' => 'Invalid Credentials'], 401);
                }

                $token = auth()->user()->createToken('auth_token');

                return response()->json([
                    'token' => $token->plainTextToken
                ]);
            };
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            [], 204
        ]);
    }
}
