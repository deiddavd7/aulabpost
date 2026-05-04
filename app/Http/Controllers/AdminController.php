<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminRequests = User::where('admin_request', true)->get();
        $revisorRequests = User::where('revisor_request', true)->get();
        $writerRequests = User::where('writer_request', true)->get();

        $tags = Tag::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.dashboard', compact(
            'adminRequests',
            'revisorRequests',
            'writerRequests',
            'tags',
            'categories'
        ));
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = true;
        $user->admin_request = false;
        $user->save();

        return redirect(route('admin.dashboard'))->with('message', 'Ruolo admin assegnato correttamente');
    }

    public function makeRevisor(User $user)
    {
        $user->is_revisor = true;
        $user->revisor_request = false;
        $user->save();

        return redirect(route('admin.dashboard'))->with('message', 'Ruolo revisore assegnato correttamente');
    }

    public function makeWriter(User $user)
    {
        $user->is_writer = true;
        $user->writer_request = false;
        $user->save();

        return redirect(route('admin.dashboard'))->with('message', 'Ruolo writer assegnato correttamente');
    }

    public function updateTag(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => [
                'required',
                'min:2',
                Rule::unique('tags', 'name')->ignore($tag->id),
            ],
        ]);

        $tag->update([
            'name' => strtolower(trim($request->name)),
        ]);

        return redirect(route('admin.dashboard'))->with('message', 'Tag modificato correttamente');
    }

    public function deleteTag(Tag $tag)
    {
        $tag->articles()->detach();
        $tag->delete();

        return redirect(route('admin.dashboard'))->with('message', 'Tag cancellato correttamente');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required',
                'min:2',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
        ]);

        $category->update([
            'name' => strtolower(trim($request->name)),
        ]);

        return redirect(route('admin.dashboard'))->with('message', 'Categoria modificata correttamente');
    }

    public function deleteCategory(Category $category)
    {
        if ($category->articles()->count() > 0) {
            return redirect(route('admin.dashboard'))->with(
                'message',
                'Non puoi cancellare una categoria collegata ad articoli esistenti'
            );
        }

        $category->delete();

        return redirect(route('admin.dashboard'))->with('message', 'Categoria cancellata correttamente');
    }
}

