<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UiuxDesign;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UiuxDesignController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('uiux_design');
            return $next($request);
        });
    }

    public function index()
    {
        $uiuxs = UiuxDesign::all();
        return view('dashboard.competition.uiux_design.index', compact('uiuxs'));
    }

    public function show($id)
    {
        $uiux = UiuxDesign::findOrFail($id);
        $members = ($uiux->id_card3) ? 3 : (($uiux->id_card2) ? 2 : 1);
        return view('dashboard.competition.uiux_design.show', compact('uiux', 'members'));

    }

    public function update($id)
    {
        $uiux = UiuxDesign::findOrFail($id);
        $uiux->update(['isVerified' => true]);

        return redirect()->route('competition.uiux')->with('success', 'Verification Successfull');
    }

    public function delete($id)
    {
        $uiux = UiuxDesign::findOrFail($id);
        $members = ($uiux->id_card3) ? 3 : (($uiux->id_card2) ? 2 : 1);
        for ($i = 1; $i <= $members; $i++) {
            Storage::disk('public')->delete($uiux->{"id_card$i"});
        }
        Storage::disk('public')->delete($uiux->proof);

        $uiux->delete();

        return redirect()->route('competition.uiux')->with('success', 'Delete Successfull');
    }

    public function downloadSubmission($id)
    {
        $uiux = UiuxDesign::findOrFail($id);
        $submission = public_path().'/storage/'.$uiux->submission;

        if (file_exists($submission)) {
            return Response::download($submission); // Change 'submission_file.pdf' to the desired file name
        } else {
            return redirect()->back()->with('error', 'Submission file not found.');
        }
        
    }



}