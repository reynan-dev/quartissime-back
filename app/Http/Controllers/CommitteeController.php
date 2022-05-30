<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\User;
use App\Models\Committee;
use App\Models\CommitteeUser;
use App\Models\Event;
use App\Models\CommitteePhoto;
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
        $user = Auth::user();
        $users = User::all();

        return response()->json([
            'committees' => $committees,
            'associations' => $associations,
            'events' => $events,
            'user' => $user,
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $committee = Committee::findOrFail($id);
        $committees = [];
        array_push($committees, $committee);

        $association = Association::where('committee_id', $committee->id)->get();
        is_array($association) ? $associations = array_push($associations, $association) : $associations = $association;

        $event = Event::where('committee_id', $committee->id)->get();
        is_array($event) ? $events = array_push($events, $event) : $events = $event;

        $user = Auth::user();

        return response()->json([
            'committees' => $committees,
            'associations' => $associations,
            'events' => $events,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {

        $array = (array) $request->all();

        $validator = Validator::make(
            $array,
            [
                'name' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'adress' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'website' => 'required|url',
                'facebook' => 'url|nullable',
                'email' => 'required|email:rfc,dns',
                'tel' => 'regex:/(0)[0-9]{9}/|nullable',
                'president_name' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'description' => 'alpha_num',
                'photo' => 'image'
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
                'photo' => "Le format d'image est pas accepté.",
            ]
        );

        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()], 406);
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


        if ($request->adress_public === false) {
            $new_committee['adress_public'] = 0;
        };

        if ($request->adress_public === true) {
            $new_committee['adress_public'] = 1;
        };

        $committee = Committee::create($new_committee);
        /*
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('/comite-' . $committee->id . '/upload'), $fileName);
            $path = public_path('/comite-' . $committee->id . '/upload') . $fileName;


            $file = [
                'extension' => $request->file->getClientOriginalExtension(),
                'url' => $path,
                'committee_id' => $request->committee_id
            ];

            $new_file = CommitteePhoto::create($file);*/

            return response()->json([
                'committee' => $committee,
                // 'photo' => $new_file
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $array = (array) $request->all();

        $validator = Validator::make(
            $array,
            [
                'name' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'adress' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'website' => 'required|url',
                'facebook' => 'url|nullable',
                'email' => 'required|email:rfc,dns',
                'tel' => 'regex:/(0)[0-9]{9}/|nullable',
                'president_name' => 'required|string|regex:/^[A-z0-9_\s\']+$/',
                'description' => 'nullable|regex:/^[A-z0-9_\s\']+$/',
                'photo' => 'image'
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
                'photo' => "Le format d'image est pas accepté.",
            ]
        );

        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()], 406);
        } else {

            $committee = Committee::findOrFail($id);

            if ($request->adress_public === false) {
                $committee->adress_public = 0;
            };

            if ($request->adress_public === true) {
                $committee->adress_public = 1;
            };

            $committee->name = $request->name;
            $committee->adress =  $request->adress;
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
        $user = Auth::user();

        $committee = Committee::findOrFail($request->id);

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
