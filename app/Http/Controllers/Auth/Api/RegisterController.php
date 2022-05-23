<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
/*
        $request->validate([
            'name' => 'required|alpha|min:3|max:255',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|alpha_dash|min:6',
            'administrator' => 'min:1|max:1|numeric'
        ]); */

        $userData = $request->only('name', 'email', 'password','administrator', 'identifiant');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData)) abort(500, 'Erro para criar usuario');

        return response()->json([
            'user' => $user
        ]);
    }

}
