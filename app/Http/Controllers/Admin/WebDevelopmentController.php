<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebDevelopment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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
        $submission = $webdev->submission;
        $appUrl = env('APP_URL');
        $submission = public_path(str_replace($appUrl, '', $submission));

        if (file_exists($submission)) {
            return Response::download($submission);
        } else {
            return redirect()->back()->with('error', 'Submission file not found.');
        }

    }

    public function downloadAllSubmission()
    {
        $folderPath = public_path('storage/submission/web-development');
        $zipFileName = 'web-development-all-submission.zip';

        if (!File::isDirectory($folderPath) || count(File::files($folderPath)) === 0) {
            return redirect()->back()->with('error', 'Submission file not found.');
        }

        $zip = new \ZipArchive();

        if ($zip->open(public_path($zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            $files = File::files($folderPath);

            foreach ($files as $file) {
                $zip->addFile($file, pathinfo($file)['basename']);
            }

            $zip->close();
        }

        return Response::download(public_path($zipFileName))->deleteFileAfterSend(true);
    }



}