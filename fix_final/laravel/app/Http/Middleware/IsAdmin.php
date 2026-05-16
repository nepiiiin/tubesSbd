<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            
            if (Auth::user()->role === 'admin') {
                return $next($request); 
            }

            return redirect('/')->with('error', 'Maaf, halaman ini khusus Admin ya!');
        }

        return redirect('/')->with('error', 'Silakan login terlebih dahulu.');
    }
}