<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Mail\ArticleAccepted;
use App\Mail\ArticleRejected;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    public function dashboard()
    {
        $articles_to_check = Article::whereNull('is_accepted')
            ->orderBy('created_at', 'desc')
            ->get();

        $accepted_articles = Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $rejected_articles = Article::where('is_accepted', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('revisor.dashboard', compact('articles_to_check', 'accepted_articles', 'rejected_articles'));
    }

    public function acceptArticle(Article $article)
    {
        $article->is_accepted = true;
        $article->save();

        if ($article->user) {
            Mail::to($article->user->email)->send(new ArticleAccepted($article));
        }

        return redirect()->route('revisor.dashboard')->with('message', 'Articolo accettato correttamente. È stata inviata una mail all’autore.');
    }

    public function rejectArticle(Article $article)
    {
        $article->is_accepted = false;
        $article->save();

        if ($article->user) {
            Mail::to($article->user->email)->send(new ArticleRejected($article));
        }

        return redirect()->route('revisor.dashboard')->with('message', 'Articolo rifiutato correttamente. È stata inviata una mail all’autore.');
    }
}

