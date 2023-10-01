<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seminar;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
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

    public function show($id)
    {
        $seminar = Seminar::findOrFail($id);
        return view('dashboard.seminar.show', compact('seminar'));
    }

    public function update($id)
    {
        $seminar = Seminar::findOrFail($id);
        $ticketCode = 'SRFTN';

        $ticketCode .= ($id < 10) ? '00' . $id : (($id < 100) ? '0' . $id : $id);

        $ticketFile = $this->generateTicket($seminar->name, $ticketCode);

        $seminar->update([
            'ticket_code' => $ticketCode,
            'ticket_file' => $ticketFile,
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

    private function generateTicket($name, $ticketCode)
    {
        $fileName = "$ticketCode-$name.jpg";
        $name = strtoupper($name);
        $img = Image::make(public_path('seminar/ticket.jpg'));

        $img->text($name, 1939, 450, function ($font) {
            $font->file(public_path('font/Poppins.ttf'));
            $font->size(26);
            $font->valign('top');
        });

        $img->text($ticketCode, 1899, 604, function ($font) {
            $font->file(public_path('font/Poppins.ttf'));
            $font->size(26);
            $font->valign('top');
        });

        $directoryPath = 'public/tiket-seminar';
        if (!Storage::exists($directoryPath)) {
            Storage::makeDirectory($directoryPath);
        }
        
        $img->save(storage_path("app/public/tiket-seminar/$fileName"));

        return env('APP_URL') . Storage::url("tiket-seminar/$fileName");
    }
}
