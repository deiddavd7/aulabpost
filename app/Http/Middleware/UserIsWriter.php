<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsWriter
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() && auth()->user()->is_writer) {
            return $next($request);
        }

        return redirect()->route('homepage')->with('error', 'Non sei autorizzato a inserire articoli. Devi essere Writer.');
    }
}

