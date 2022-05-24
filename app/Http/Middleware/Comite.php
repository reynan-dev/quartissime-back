<?php

namespace App\Http\Middleware;

use App\Models\CommitteeUser;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class Comite
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->administrator === 0) {
            return $next($request);
        }

        if (Auth::user()->administrator === 1) {
            return redirect()->route('dashboard.index', $request);
        }
        
    }
}
