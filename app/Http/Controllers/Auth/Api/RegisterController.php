<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function registerAdmin(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|alpha|min:3|max:255',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|alpha_dash|min:6',
            'administrator' => 'min:1|max:1|numeric'
        ]);

        $userData = $request->only('name', 'email', 'password', 'administrator');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData)) abort(500, 'Erro para criar usuario');

        return response()->json([
            'user' => $user
        ]);
    }

    public function registerComite(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|alpha|min:3|max:255',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|alpha_dash|min:6',
            'identifiant' => 'required|alpha_num|min:3|max:255',
        ]);

        $userData = $request->only('name', 'email', 'password', 'identifiant');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData)) abort(500, 'Erro para criar usuario');

        return response()->json([
            'user' => $user
        ]);
    }
}
