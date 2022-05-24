<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Riverains;
use Illuminate\Support\Facades\Mail;

class RiverainsController extends Controller
{
    public function store(request $request)
    {
        $comiteName= $request->comiteName;
        Mail::to($request->comiteMail)->send(new Riverains());
        compact('comiteName');
    }
}
