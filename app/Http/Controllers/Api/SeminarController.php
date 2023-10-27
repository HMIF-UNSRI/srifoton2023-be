<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Models\Seminar;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SeminarRequest;
use Illuminate\Support\Facades\Storage;

class SeminarController extends Controller
{
    /**
     * Seminar Registration
     * 
     * Endpoint ini digunakan untuk mendaftar seminar.
     * 
     * @authenticated
     * 
     * @bodyParam name string required
     * Example: Aldi taher
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     *      <li>Harus unique (tidak boleh email yang telah terdaftar di seminar)</li>
     * </ul>
     * Example: youremail@gmail.com
     * @bodyParam nim required
     * Example: 09021182126005
     * @bodyParam college string required
     * Example: Universitas Foreplay
     * @bodyParam phone_number string required
     * Example: 082162798119
     * @bodyParam type string required
     * Example: Offline
     * 
     * @bodyParam proof file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * @bodyParam payment_method string required
     * Example: Gopay
     */
    public function register(SeminarRequest $request)
    {
        if($request->type == 'offline') {
            return response()->json([
                'message' => 'Maaf, Pendaftaran dengan tipe offline telah ditutup'
            ], 403);
        }

        $data = $request->validated();

        $existingUser = Seminar::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['error' => 'Email ini telah terdaftar pada seminar.'], 409);
        }

        $proof = "bukti-pembayaran/seminar/$request->type/$request->payment_method-$request->phone_number-" . Str::random(16) . "." . $request->proof->getClientOriginalExtension();

        $data['user_id'] = Auth::guard('api')->user()->id;
        $data['proof'] = env('APP_URL') . Storage::url($proof);

        Seminar::create($data);

        Storage::disk('public')->put($proof, file_get_contents($request->proof));

        Helper::sendAlertToExhibition($data['name'], $data['type'], $data['payment_method'], env('APP_URL') . '/dashboard/admin/seminar?search=' . urlencode($data['name']));

        return response()->json([
            'message' => 'Berhasil daftar seminar',
            'data' => $data
        ]);
    }

    /**
     * Donwload Seminar Ticket
     * 
     * Endpoint ini digunakan untuk mendowonload tiket seminar berdasarkan ticket code.
     * 
     * @urlParam ticket_code string required
     * Example: SRFTN005
     * 
     */
    public function download($ticket)
    {
        $seminar = Seminar::where('ticket_code', $ticket)->first();

        if ($seminar) {
            $ticketPath = str_replace(env('APP_URL'), '', $seminar->ticket_file);

            $path = public_path($ticketPath);

            if (File::exists($path)) {
                $file = File::get($path);
                $response = new Response($file);
                $response->header('Content-Type', 'image/jpg');
                $response->header('Content-Disposition', 'attachment; filename="' . basename($path) . '"');

                return $response;
            } else {
                return response()->json([
                    'message' => 'Tiket seminar tidak ditemukan'
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Anda belum terdaftar pada seminar'
            ], 404);
        }
    }
}
