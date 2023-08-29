<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use App\Helper\Helper;
use App\Models\UiuxDesign;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

        Helper::sendWhatsappGroupInvitationEmail($uiux->email, $uiux->name1, $uiux->teamName, 'UIUX Design', 'https://chat.whatsapp.com/KMfV1b9VpTODBOG0l7VdOZ');

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
        $submission = $uiux->submission;

        if ($submission) {
            return Response::download($submission);
        } else {
            return redirect()->back()->with('error', 'Submission file not found.');
        }
    }

    public function downloadAllSubmission()
    {
        $folderPath = public_path('storage/submission/uiux-design');
        $zipFileName = 'uiux-all-submission.zip';

        if (!File::isDirectory($folderPath) || count(File::files($folderPath)) === 0) {
            return redirect()->back()->with('error', 'Submission file not found.');
        }

        $zip = new ZipArchive();

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
