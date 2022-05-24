<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\User;
use App\Models\Committee;
use App\Models\CommitteeUser;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommitteeController extends Controller
{
    public function index()
    {
        $associations = Association::all();
        $events = Event::all();
        $committees = Committee::all();

        return response()->json([
            'commmittees' => $committees,
            'associations' => $associations,
            'events' => $events,
        ]);
    }

    public function show($committee)
    {
        $committee = Committee::findOrFail($committee);
        $associations = Association::where('committee_id', $committee->id);
        $events = Event::where('committee_id', $committee->id);

        return response()->json([
            'commmittee' => $committee,
            'associations' => $associations,
            'events' => $events,
        ]);
    }

    public function store(Request $request)
    {
        $array = (array) $request->all();

        $validator = Validator::make(
            $array,
            [
                'name' => 'required|string|regex:/^[A-Za-z0-9_]+$/',
                'adress' => 'required|string|regex:/^[A-Za-z0-9_]+$/',
                'website' => 'required|url',
                'facebook' => 'url',
                'email' => 'required|email:rfc,dns',
                'tel' => 'regex:/(0)[0-9]{9}/',
                'president_name' => 'required|string|alpha',
                'description' => 'alpha_num',
            ],
            [
                'name' => 'Le nom est invalide.',
                'adress' => 'Le adress est invalide.',
                'website' => "L'url est invalide.",
                'facebook' => "L'url est invalide.",
                'email' => "L'email est invalide.",
                'tel' => "Le tel est invalide.",
                'president_name' => "Le nom du président est invalide.",
                'description' => "La description est invalide.",
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 406);
        } else {

            $new_committee = [
                'name' => $request->name,
                'adress' => $request->adress,
                'adress_public' => $request->adress_public,
                'website' => $request->website,
                'facebook' => $request->facebook,
                'email' => $request->email,
                'tel' => $request->tel,
                'president_name' => $request->president_name,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            $committee = Committee::create($new_committee);

            return response()->json([
                'committee' => $committee
            ]);
        };
    }

    public function update(Request $request, $id)
    {
        $array = (array) $request->all();

        $validator = Validator::make(
            $array,
            [
                'name' => 'required|string|regex:/^[A-Za-z0-9_]+$/',
                'adress' => 'required|string|regex:/^[A-Za-z0-9_]+$/',
                'website' => 'required|url',
                'facebook' => 'url',
                'email' => 'required|email:rfc,dns',
                'tel' => 'regex:/(0)[0-9]{9}/',
                'president_name' => 'required|string|alpha',
                'description' => 'alpha_num',
            ],
            [
                'name' => 'Le nom est invalide.',
                'adress' => 'Le adress est invalide.',
                'website' => "L'url est invalide.",
                'facebook' => "L'url est invalide.",
                'email' => "L'email est invalide.",
                'tel' => "Le tel est invalide.",
                'president_name' => "Le nom du président est invalide.",
                'description' => "La description est invalide.",
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 406);
        } else {

            $committee = Committee::findOrFail($id);

            $committee->name = $request->name;
            $committee->adress =  $request->adress;
            $committee->adress_public =  $request->adress_public;
            $committee->website =  $request->website;
            $committee->facebook =  $request->facebook;
            $committee->email =  $request->email;
            $committee->tel =  $request->tel;
            $committee->president_name =  $request->president_name;
            $committee->description =  $request->description;
            $committee->latitude = $request->latitude;
            $committee->longitude =  $request->longitude;

            $committee->update();

            return response()->json([
                'committee' => $committee
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($request->user_id);

        $committee = Committee::findOrFail($id);

        $validation_password = true;

        if (password_verify($request->input('password'), $user->password) !== true) {
            $validation_password = false;
        };

        if ($validation_password === true) {
            $committee->delete();
        };

        return response()->json([
            'message' => 'Delete successfull'
        ]);
    }
}
