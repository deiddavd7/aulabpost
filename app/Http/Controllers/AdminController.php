<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin_requests = User::where('is_admin', false)
            ->where('admin_request', true)
            ->get();

        $revisor_requests = User::where('is_revisor', false)
            ->where('revisor_request', true)
            ->get();

        $writer_requests = User::where('is_writer', false)
            ->where('writer_request', true)
            ->get();

        return view('admin.dashboard', compact('admin_requests', 'revisor_requests', 'writer_requests'));
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = true;
        $user->admin_request = false;
        $user->save();

        return redirect()->route('admin.dashboard')->with('message', "Hai reso {$user->name} Admin.");
    }

    public function makeRevisor(User $user)
    {
        $user->is_revisor = true;
        $user->revisor_request = false;
        $user->save();

        return redirect()->route('admin.dashboard')->with('message', "Hai reso {$user->name} Revisor.");
    }

    public function makeWriter(User $user)
    {
        $user->is_writer = true;
        $user->writer_request = false;
        $user->save();

        return redirect()->route('admin.dashboard')->with('message', "Hai reso {$user->name} Writer.");
    }
}

