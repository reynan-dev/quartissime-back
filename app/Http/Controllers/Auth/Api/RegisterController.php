<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $array = (array) $request->all();


        $validator = Validator::make(
            $array,
            [
                'name' => 'required|alpha|min:3|max:255',
                'email' => 'required|email:rfc,dns',
                'password' => 'required|alpha_dash|min:6',
                'identifiant' => 'min:3|max:255|alpha_num',
                'administrator' => 'min:1|max:1|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 406);
        }
        $data = $request->only('name', 'email', 'password', 'identifiant', 'administrator');
        $data['password'] = Hash::make($data['password']);

        if (!$user = $user->create($data)) {
            return response()->json(['message' => "Error au créer l'utilisateur."], 500);
        };

        return response()->json([
            'user' => $user
        ]);
    }
}
