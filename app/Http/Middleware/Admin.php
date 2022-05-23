<?php

namespace App\Http\Middleware;

use App\Models\CommitteeUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->administrator === 0) {
            $user_id = Auth::user()->id;
            // dd($user_id);
            $link = CommitteeUser::get()->where("user_id", $user_id);
            // dd($link);
            $committee_id = $link[0]->committee_id;
            return redirect()->route('dashboard.show', $committee_id);
        }

        if (Auth::user()->administrator === 1) {
            return $next($request);
        }
        
    }
}
