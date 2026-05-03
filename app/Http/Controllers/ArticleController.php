<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\NewArticleToCheck;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'subtitle' => 'required|min:5',
            'body' => 'required|min:10',
            'category_id' => 'required',
            'image' => 'nullable|image',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'is_accepted' => null,
            'image' => null,
        ]);

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
            $article->save();
        }

        $revisors = User::where('is_revisor', true)->get();

        foreach ($revisors as $revisor) {
            Mail::to($revisor->email)->send(new NewArticleToCheck($article));
        }

        return redirect()->route('homepage')->with('message', 'Articolo inserito correttamente. Sarà visibile dopo l’approvazione di un revisore.');
    }

    public function index()
    {
        $articles = Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('article.index', compact('articles'));
    }

    public function show(Article $article)
    {
        if (!$article->is_accepted) {
            abort(404);
        }

        return view('article.show', compact('article'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()
            ->where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('article.by-category', compact('articles', 'category'));
    }

    public function byUser(User $user)
    {
        $articles = $user->articles()
            ->where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('article.by-user', compact('articles', 'user'));
    }
}

