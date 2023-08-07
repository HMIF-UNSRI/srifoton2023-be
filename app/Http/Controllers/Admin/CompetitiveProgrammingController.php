<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CompetitiveProgramming;
use Illuminate\Support\Facades\Storage;

class CompetitiveProgrammingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('competitive_programming');
            return $next($request);
        });
    }
    public function index()
    {
        $programmings = CompetitiveProgramming::all();
        return view('dashboard.competition.competitive_programming.index', compact('programmings'));
    }

    public function show($id)   
    {
        $programming = CompetitiveProgramming::findOrFail($id);
        $members = 3;
        return view('dashboard.competition.competitive_programming.show', compact('programming', 'members'));

    }

    public function update($id)
    {
        $programming = CompetitiveProgramming::findOrFail($id);
        $programming->update(['isVerified' => true]);

        return redirect()->route('competition.cp')->with('success', 'Verification Successfull');
    }

    public function delete($id)
    {
        $programming = CompetitiveProgramming::findOrFail($id);
        $members = ($programming->id_card3) ? 3 : (($programming->id_card2) ? 2 : 1);
        for($i = 1; $i <= $members; $i++){
            Storage::disk('public')->delete($programming->{"id_card$i"});
        }
        Storage::disk('public')->delete($programming->proof);

        $programming->delete();

        return redirect()->route('competition.cp')->with('success', 'Delete Successfull');
    }

}
