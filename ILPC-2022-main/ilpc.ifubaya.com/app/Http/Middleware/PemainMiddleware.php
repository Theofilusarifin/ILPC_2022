<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == "pemain") {
            if(Auth::user()->team->status=="ready") return $next($request);
            else if(Auth::user()->team->status == "waiting" && $request->get("_token") != null) return $next($request); // Biar pemain bisa make POST request untuk upload file
            else if(Auth::user()->team->status == "waiting") return response()->view('pemain.pembayaran.upload');
            else if(Auth::user()->team->status == "unverified") return response()->view('pemain.pembayaran.unverified');
            else if (Auth::user()->team->status == "deactivated") return response()->view('pemain.deactivated');                  
        }
        abort(404);
    }
}