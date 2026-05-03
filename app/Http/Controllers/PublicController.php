<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
    {
        $articles = Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
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
            'role' => 'required|in:admin,revisor,writer',
        ]);

        $user = auth()->user();

        if ($request->role == 'admin') {
            $user->admin_request = true;
        }

        if ($request->role == 'revisor') {
            $user->revisor_request = true;
        }

        if ($request->role == 'writer') {
            $user->writer_request = true;
        }

        $user->save();

        return redirect()->route('homepage')->with('message', 'Richiesta inviata correttamente. Un amministratore la valuterà al più presto.');
    }
}
  