<?php

namespace App\Http\Controllers\Admin;

use App\Models\MobileLegend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        return view('dashboard.competition.mobile_legends.index', compact('mobilelegends'));
    }

    public function show($id)   
    {
        $mobilelegend = MobileLegend::findOrFail($id);
        $members = $mobilelegend->id_card6 == null ? 5 : 6;
        return view('dashboard.competition.mobile_legends.show', compact('mobilelegend', 'members'));

    }

    public function update($id)
    {
        $mobilelegend = MobileLegend::findOrFail($id);
        $mobilelegend->update(['isVerified' => true]);

        return redirect()->route('competition.mole')->with('success', 'Verification Successfull');
    }

    public function delete($id)
    {
        $mobilelegend = MobileLegend::findOrFail($id);
        $members = $mobilelegend->id_card6 == null ? 5 : 6;
        for($i = 1; $i <= $members; $i++){
            Storage::disk('public')->delete($mobilelegend->{"id_card$i"});
        }
        Storage::disk('public')->delete($mobilelegend->proof);

        $mobilelegend->delete();

        return redirect()->route('competition.mole')->with('success', 'Delete Successfull');
    }


}