<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function homepage()
    {
        $articles = Article::orderBy('created_at', 'desc')->take(4)->get();

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

        switch ($request->role) {
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

        return redirect()->route('homepage')->with('message', 'Richiesta inviata correttamente!');
    }
}

