<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $array = (array) $request->all();

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

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            [], 204
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $array = (array) $request->all();

        $validator = Validator::make(
            $array,
            [
                'name' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'email' => 'required|email:rfc,dns',
                'password' => 'nullable|regex:/(?=^.{8,}$)(?=.*\\d)(?=.*\\W+)(?=.*[A-Z])(?=.*[a-z])(?!.*\\n).*$/',
                'administrator' => 'min:1|max:1|numeric'
            ],
            [
                'name' => 'Le format du nom est invalide.',
                'email' => "L'email est invalide",
                'password' => 'Le format du mot de passe est invalide.'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 406);
        } else {

            $validation_password = true;
            $auth_user = Auth::user();

            if (password_verify($request->input('confirm_changes'), $auth_user->password) !== true) {
                $validation_password = false;
            };

            if ($validation_password === true) {

                $user = User::findOrFail($id);

                $user->name = $request->name;
                $user->email = $request->email;

                if ($request->password != null) {
                    $password_hash = Hash::make($request->password);
                    $user->password = $password_hash ;
                }

                $user->save();

                return response()->json([
                    'user' => $user
                ]);
            };
        }
    }

    public function destroy(Request $request, $id)
    {
        $auth_user = Auth::user();
        $user = User::findOrFail($id);


        $validation_password = true;

        if (password_verify($request->password, $auth_user->password) !== true) {
            $validation_password = false;
        };

        if ($validation_password === true) {
            $user->delete();
        };

        return response()->json([
            'message' => 'Delete successfull'
        ]);

    }
}
