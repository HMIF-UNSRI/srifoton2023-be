<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seminar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SeminarController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authorize('seminar');
            return $next($request);
        });
    }
    public function index()
    {
        $seminars = Seminar::all();
        return view('dashboard.seminar.index', compact('seminars'));
    }

    public function update($id)
    {
        $seminar = Seminar::findOrFail($id);
        $ticketCode = 'SRFTN';

        $ticketCode .= ($id < 10) ? '00' . $id : (($id < 100) ? '0' . $id : $id);

        $seminar->update([
            'ticket_code' => $ticketCode,
            'isVerified' => true,
        ]);

        return redirect()->route('seminar')->with('success', 'Verification Successful');
    }

    public function delete($id)
    {
        $seminar = Seminar::findOrFail($id);
        Storage::disk('public')->delete($seminar->proof);
        $seminar->delete();

        return redirect()->route('seminar')->with('success', 'Delete Successfull');
    }
}