<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.index');
    }

    public function users(){
        $this->authorize('inti'); 
        return view('dashboard.user.index');
    }
    public function competitive_programming(){
        $this->authorize('competitive_programming'); 
        return view('dashboard.competition.competitive_programming');
    }
    public function uiux_design(){
        $this->authorize('uiux_design'); 
        return view('dashboard.competition.uiux_design');
    }
    public function web_development(){
        $this->authorize('web_development'); 
        return view('dashboard.competition.web_development');
    }
    public function mobile_legends(){
        $this->authorize('mobile_legends'); 
        return view('dashboard.competition.mobile_legends');
    }
    public function seminar(){
        $this->authorize('seminar'); 
        return view('dashboard.seminar.index');
    }
}