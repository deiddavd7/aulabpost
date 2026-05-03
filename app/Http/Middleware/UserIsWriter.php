<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserIsWriter
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->is_writer) {
            return $next($request);
        }

        return redirect(route('homepage'))->with('message', 'Non sei autorizzato ad accedere a questa sezione');
    }
}

