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

        // the centre of your search
    $latPosition = $request->input('latPosition');
    $longPosition = $request->input('longPosition');

// search radius
    $distance = 5;  //(miles - see note)

        $haversine = "(
    6371 * acos(
        cos(radians(" . $latPosition . "))
        * cos(radians(latitude))
        * cos(radians(longitude) - radians(" . $longPosition . "))
        + sin(radians(" . $latPosition . ")) * sin(radians(latitude))
    )
)";
        $committees = DB::table('committees')
        ->select("*")
        ->selectRaw("$haversine AS distance")
        ->having("distance", "<=", $distance)
        ->orderby("distance")
        ->limit(3)
        ->get();
        return response()->json(['committees' => $committees]);
    }   
}
