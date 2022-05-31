<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\CommitteeUser;
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
                'name' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'email' => 'required|email:rfc,dns',
                'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'administrator' => 'numeric'
            ],
            [
                'name' => 'Le format du nom est invalide.',
                'email' => "L'email est invalide",
                'password' => 'Le format du mot de passe est invalide.'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 406);
        }
        $data = $request->only('name', 'email', 'password', 'administrator');
        $data['password'] = Hash::make($data['password']);

        if (!$user = $user->create($data)) {
            return response()->json(['message' => "Error au créer l'utilisateur."], 500);
        };

        if ($data['administrator'] === 0) {
            $committee_user = [
                'committee_id' => $request->committee_id,
                'user_id' => $user->id,
            ];

            CommitteeUser::create($committee_user);
        };

        return response()->json([
            'user' => $user
        ]);
    }
}
