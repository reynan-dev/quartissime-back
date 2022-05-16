<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Association;
use App\Models\Event;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return $events;
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255|alpha_num',
            'adress' => 'required|alpha_num',
            'date' => 'required|date',
            'link' => 'alpha_dash',
            'description' => 'alpha_num',
            'association_id' => 'required|integer',
        ]);

        $event = [
            'name' => $request->input('name'),
            'adress' => $request->input('adress'),
            'date' => $request->input('date'),
            'link' => $request->input('link'),
            'description' => $request->input('description'),
            'association_id' => $request->input('association_id'),
        ];

        $new_event = Event::create($event);

        return $new_event;
    }


    public function show($id)
    {
        $event = Event::findOrFail($id);
        
        return $event;
    }

    public function showAll($association_id)
    {
        $events = Association::with('events')->findMany($association_id, 'association_id');

        return $events;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255|alpha_num',
            'adress' => 'required|alpha_num',
            'date' => 'required|date',
            'link' => 'alpha_dash',
            'description' => 'alpha_num',
            'association_id' => 'required|integer',
        ]);

        $event = Event::findOrFail($id);

        $event->name = $request->input('name');
        $event->adress = $request->input('adress');
        $event->date = $request->input('date');
        $event->link = $request->input('link');
        $event->description = $request->input('description');
        $event->association_id = $request->input('association_id');

        $event->save();

        return $event;
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return "L'évènement a été bien supprimer.";
    }
}
