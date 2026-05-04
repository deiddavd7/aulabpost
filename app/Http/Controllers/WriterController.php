<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class WriterController extends Controller
{
    public function dashboard()
    {
        $articles = Article::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('writer.dashboard', compact('articles'));
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        $articleTags = $article->tags->pluck('name')->implode(', ');

        return view('article.edit', compact('article', 'articleTags'));
    }

    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => [
                'required',
                'min:5',
                Rule::unique('articles', 'title')->ignore($article->id),
            ],
            'subtitle' => 'required|min:5',
            'body' => 'required|min:10',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
        ]);

        $imagePath = $article->image;

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
        }

        $article->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'is_accepted' => null,
        ]);

        $tagIds = [];

        if ($request->tags) {
            $tags = explode(',', $request->tags);

            foreach ($tags as $tagName) {
                $cleanTagName = strtolower(trim($tagName));

                if ($cleanTagName !== '') {
                    $tag = Tag::updateOrCreate([
                        'name' => $cleanTagName,
                    ]);

                    $tagIds[] = $tag->id;
                }
            }
        }

        $article->tags()->sync($tagIds);

        return redirect(route('writer.dashboard'))->with(
            'message',
            'Articolo modificato correttamente. Ora è tornato in revisione.'
        );
    }

    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->tags()->detach();
        $article->delete();

        return redirect(route('writer.dashboard'))->with('message', 'Articolo cancellato correttamente');
    }
}

