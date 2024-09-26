<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UnverifiedEmail
{
    /** 
     * This route is only for unverified user's email
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // redirect to dashboard if already verified
        if(Auth::check() && $request->user()->hasVerifiedEmail()){
            return redirect()->route('profile');
        }
        return $next($request);
    }
}
