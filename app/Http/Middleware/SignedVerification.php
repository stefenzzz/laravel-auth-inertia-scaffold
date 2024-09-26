<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class SignedVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->hasValidSignature()){
            throw new AccessDeniedHttpException('This link has expired.');
        }
        // if user already verified redirect to profile page
        if($request->user()->hasVerifiedEmail()){
            return redirect()->route('profile');   
        }
        return $next($request);
    }
}
