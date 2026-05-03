<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Mail\CareerRequestMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['homepage']),
        ];
    }

    public function homepage()
    {
        $articles = Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('welcome', compact('articles'));
    }

    public function careers()
    {
        return view('careers');
    }

    public function careersSubmit(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        $user = Auth::user();

        $role = $request->role;
        $email = $request->email;
        $message = $request->message;

        $data = compact('role', 'email', 'message', 'user');

        Mail::to('admin@theaulabpost.it')->send(new CareerRequestMail($data));

        switch ($role) {
            case 'admin':
                $user->is_admin = null;
                break;

            case 'revisor':
                $user->is_revisor = null;
                break;

            case 'writer':
                $user->is_writer = null;
                break;
        }

        $user->save();

        return redirect(route('homepage'))->with('message', 'Richiesta inviata correttamente');
    }
}

