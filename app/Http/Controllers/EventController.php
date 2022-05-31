<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Association;
use App\Models\Committee;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $committees = Committee::all();


        return response()->json([
            'events' => $events,
            'committees' => $committees
        ]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        $committee = Committee::findOrFail($event->committee_id);
        $committees = [];
        array_push($committees, $committee);

        return response()->json([
            'event' => $event,
            'committees' => $committees
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
                'date' => 'required|date|after:tomorrow',
                'association_id' => 'numeric|nullable',
                'committee_id' => 'required|numeric',
                'link' => 'url|nullable',
                'description' => 'nullable|regex:/^[A-z0-9_\s\']+$/',
            ],
            [
                'name' => 'Le nom est invalide.',
                'adress' => 'Le adress est invalide.',
                'date' => 'La date est invalide.',
                'link' => "Link est invalide.",
                'description' => 'nullable|regex:/^[A-z0-9_\s\']+$/',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()], 406);
        } else {

        $new_event = [
            'name' => $request->name,
            'adress' => $request->adress,
            'date' => $request->date,
            'link' => $request->link,
            'description' => $request->description,
            'association_id' => $request->association_id,
            'committee_id' => $request->committee_id
        ];

        $event = Event::create($new_event);

        return response()->json([
            'event' => $event
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
                'date' => 'required|date|after:tomorrow',
                'association_id' => 'numeric|nullable',
                'committee_id' => 'required|numeric',
                'link' => 'url|nullable',
                'description' => 'nullable|regex:/^[A-z0-9_\s\']+$/',
            ],
            [
                'name' => 'Le nom est invalide.',
                'adress' => 'Le adress est invalide.',
                'date' => 'La date est invalide.',
                'link' => "Link est invalide.",
                'description' => 'nullable|regex:/^[A-z0-9_\s\']+$/',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()], 406);
        } else {

        $event = Event::findOrFail($id);

        $event->name = $request->name;
        $event->adress = $request->adress;
        $event->date = $request->date;
        $event->link = $request->link;
        $event->description = $request->description;
        $event->association_id = $request->association_id;
        $event->committee_id = $request->committee_id;

        $event->update();

        return response()->json([
            'event' => $event
        ]);
         }
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $event = Event::findOrFail($request->id);

        $validation_password = true;

        if ($validation_password === true) {
            $event->delete();
        };

        return response()->json([
            'message' => 'Delete successfull'
        ]);
    }
}
