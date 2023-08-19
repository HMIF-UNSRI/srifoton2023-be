<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Seminar;
use App\Http\Controllers\Controller;
use App\Models\CompetitiveProgramming;
use App\Models\UiuxDesign;
use App\Models\WebDevelopment;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalSeminars = Seminar::count();
        $totalWebdevs = WebDevelopment::count();
        $totalUiuxs = UiuxDesign::count();
        $totalCP = CompetitiveProgramming::count();
        return view('dashboard.admin.index', compact('totalUsers', 'totalSeminars', 'totalWebdevs', 'totalUiuxs', 'totalCP'));
    }

}