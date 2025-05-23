<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
       
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        // Ensure user has 'admin' role
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Access Denied. Admins only.');
        }

        return $next($request);
    }
}
