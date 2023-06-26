<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
