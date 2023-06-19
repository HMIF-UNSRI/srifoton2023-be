<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileLegendController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('mobile_legends');
            return $next($request);
        });
    }
    public function index()
    {
        return view('dashboard.competition.mobile_legends');
    }
}