<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebDevelopment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        for($i = 1; $i <= $members; $i++){
            Storage::disk('public')->delete($webdev->{"id_card$i"});
        }
        Storage::disk('public')->delete($webdev->proof);

        $webdev->delete();

        return redirect()->route('competition.webdev')->with('success', 'Delete Successfull');
    }

    

}
