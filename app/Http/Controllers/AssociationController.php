<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Association;
use App\Models\AssociationPhoto;
use App\Models\Committee;

class AssociationController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function showAll($committee_id)
    {
        $associations = Committee::with('associations')->findMany($committee_id, 'committee_id');

        return $associations;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
