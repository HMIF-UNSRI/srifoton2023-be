<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebDevelopment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class WebDevelopmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('web_development');
            return $next($request);
        });
    }

    public function index()
    {
        $webdevs = WebDevelopment::all();
        return view('dashboard.competition.web_development.index', compact('webdevs'));
    }

    public function show($id)
    {
        $webdev = WebDevelopment::findOrFail($id);
        $members = ($webdev->id_card3) ? 3 : (($webdev->id_card2) ? 2 : 1);
        return view('dashboard.competition.web_development.show', compact('webdev', 'members'));

    }

    public function update($id)
    {
        $webdev = WebDevelopment::findOrFail($id);
        $webdev->update(['isVerified' => true]);

        return redirect()->route('competition.webdev')->with('success', 'Verification Successfull');
    }

    public function delete($id)
    {
        $webdev = WebDevelopment::findOrFail($id);
        $members = ($webdev->id_card3) ? 3 : (($webdev->id_card2) ? 2 : 1);
        for ($i = 1; $i <= $members; $i++) {
            Storage::disk('public')->delete($webdev->{"id_card$i"});
        }
        Storage::disk('public')->delete($webdev->proof);

        $webdev->delete();

        return redirect()->route('competition.webdev')->with('success', 'Delete Successfull');
    }

    public function downloadSubmission($id)
    {
        $webdev = WebDevelopment::findOrFail($id);
        $submission = public_path().'/storage/'.$webdev->submission;

        if (file_exists($submission)) {
            return Response::download($submission); // Change 'submission_file.pdf' to the desired file name
        } else {
            return redirect()->back()->with('error', 'Submission file not found.');
        }
        
    }



}