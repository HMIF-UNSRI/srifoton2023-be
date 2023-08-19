<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('inti');
            return $next($request);
        });
    }
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.show', compact('user'));
    }
}
