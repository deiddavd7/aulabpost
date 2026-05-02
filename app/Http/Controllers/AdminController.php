<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminRequests = User::where('is_admin', null)->get();
        $revisorRequests = User::where('is_revisor', null)->get();
        $writerRequests = User::where('is_writer', null)->get();

        return view('admin.dashboard', compact('adminRequests', 'revisorRequests', 'writerRequests'));
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = true;
        $user->save();

        return redirect()->route('admin.dashboard')->with('message', "Hai reso {$user->name} admin.");
    }

    public function makeRevisor(User $user)
    {
        $user->is_revisor = true;
        $user->save();

        return redirect()->route('admin.dashboard')->with('message', "Hai reso {$user->name} revisor.");
    }

    public function makeWriter(User $user)
    {
        $user->is_writer = true;
        $user->save();

        return redirect()->route('admin.dashboard')->with('message', "Hai reso {$user->name} writer.");
    }
}

