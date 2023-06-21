<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileLegend;
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
        $mobilelegends = MobileLegend::all();
        return view('dashboard.competition.mobile_legends', compact('mobilelegends'));
    }

    public function update($id)
    {
        $mobilelegend = MobileLegend::findOrFail($id);
        $mobilelegend->update(['isVerified' => true]);

        return redirect()->route('competition.mole')->with('success', 'Verification Successfull');
    }


}