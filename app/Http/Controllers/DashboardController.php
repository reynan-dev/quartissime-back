<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index($id)
    {
        $committee = $id;
        $newAssociations = Association::all()->where('accept', 0)->where('committee_id', $id);
        $associations = Association::all()->where('accept', 1)->where('committee_id', $id);

        $events = Event::all()->where('committee_id', $id);

        return view('committee.dashboard', compact('newAssociations', 'associations', 'events', 'committee'));
    }
}
