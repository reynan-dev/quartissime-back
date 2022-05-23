<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Riverains;
use Illuminate\Support\Facades\Mail;

class RiverainsController extends Controller
{
    public function store(request $request)
    {
        // return response()->json($request->email);
    
        
        Mail::to($request->email)->send(new Riverains());

        // return redirect()
        //     ->route('/map')
        //     ->with('message', 'Votre invitation a bien été envoyée');
    }
}
