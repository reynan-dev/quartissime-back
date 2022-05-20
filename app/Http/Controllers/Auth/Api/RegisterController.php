<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function registerAdmin(Request $request, User $user)
    {

        // Validar request (A FAIRE)

        $userData = $request->only('name', 'email', 'password', 'administrator');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData)) abort(500, 'Erro para criar usuario');

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function registerComite(Request $request, User $user)
    {

        // Validar request (A FAIRE)

        $userData = $request->only('name', 'email', 'password', 'identifiant');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData)) abort(500, 'Erro para criar usuario');

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }
}
