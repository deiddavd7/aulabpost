<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('article.index', compact('articles'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|unique:articles,title',
            'subtitle' => 'required|min:5',
            'body' => 'required|min:10',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'slug' => Article::generateSlug($request->title),
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'image' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'is_accepted' => null,
        ]);

        if ($request->tags) {
            $tags = explode(',', $request->tags);

            foreach ($tags as $tagName) {
                $cleanTagName = strtolower(trim($tagName));

                if ($cleanTagName !== '') {
                    $tag = Tag::updateOrCreate([
                        'name' => $cleanTagName,
                    ]);

                    $article->tags()->attach($tag->id);
                }
            }
        }

        return redirect(route('homepage'))->with('message', 'Articolo creato correttamente, ora è in attesa di revisione');
    }

    public function show(Article $article)
    {
        if ($article->is_accepted !== true) {
            if (!Auth::check() || !Auth::user()->is_revisor) {
                abort(404);
            }
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

    public function searchArticles(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('is_accepted', true)
            ->where(function ($articleQuery) use ($query) {
                $articleQuery->where('title', 'LIKE', '%' . $query . '%')
                    ->orWhere('subtitle', 'LIKE', '%' . $query . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($query) {
                        $categoryQuery->where('name', 'LIKE', '%' . $query . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('article.search-index', compact('articles', 'query'));
    }
}

