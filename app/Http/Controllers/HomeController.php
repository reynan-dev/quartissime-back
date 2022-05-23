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
    public function calcultop3assocomite(Request $request,$latitude,$longitude)
    {
    //     $request->validate([
    //         'longitude' => 'required|numeric',
    //         'latitude' => 'required|numeric',
    //     ]);
    //     $lon = $request->input("longPosition");
    //     $lat = $request->input("latPosition");
    //     $radius = 1;

    //     $haversine = "(6371 * acos(cos(radians($lat)) 
    //     * cos(radians(model.latitude)) 
    //     * cos(radians(model.longitude)) 
    //     - radians($lon)) 
    //     + sin(radians($lat)) 
    //     * sin(radians(model.latitude)))";

    //     $committees =  DB::table('committees')
    //     ->select("*") //pick the columns you want here.
    //         ->selectRaw("{$haversine} AS distance")
    //         ->having('distance', '<', $radius)
    //         ->orderBy('distance')
    //         ->limit(3)
    //         ->get();

    //     return response()->json(['committees' => $committees]);

        // the centre of your search
    $latitude = $request->input('latPosition');
    $longitude = $request->input('longPosition');

// search radius
    $distance = 1;  //(miles - see note)

        $haversine = "(
    6371 * acos(
        cos(radians(" . $latitude . "))
        * cos(radians(latitude))
        * cos(radians(longitude) - radians(" . $longitude . "))
        + sin(radians(" . $latitude . ")) * sin(radians(latitude))
    )
)";
        $committees = DB::table('committees')
        ->select("*")
        ->selectRaw("$haversine AS distance")
        ->having("distance", "<=", $distance)
        ->orderby("distance", "desc")
        ->limit(3)
        ->get();
        return response()->json(['committees' => $committees]);
    }   
}
