<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd('coucou');
        $committee_user = Committee::all();
        dd($committee_user);
        return view('CommitteeUsers', compact('committee_user'));
    }
    public function calcultop3assocomite(Request $request)
    {
        $request->validate([
            'lon' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);
        $lon = $request->input("lon");
        $lat = $request->input("lat");

        $haversine = "(6371 * acos(cos(radians($lat)) 
        * cos(radians(committees.latitude)) 
        * cos(radians(committees.latitude)) 
        - radians($lon)) 
        + sin(radians($lat)) 
        * sin(radians(committees.latitude)))";

        $committees =  DB::table('committees')
            ->select("*") //pick the columns you want here.
            ->selectRaw("{$haversine} AS distance")
            ->orderBy('distance')
            ->limit(3)
            ->get();

        return response()->json(['committees' => $committees]);
    }
}
