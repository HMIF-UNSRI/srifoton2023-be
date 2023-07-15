<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
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
}