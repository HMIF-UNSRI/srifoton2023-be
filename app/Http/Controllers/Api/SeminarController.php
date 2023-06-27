<?php

namespace App\Http\Controllers\Api;

use App\Models\Seminar;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $data = $request->validated();

        $proof = "bukti-pembayaran/seminar/$request->payment_method-$request->phone_number-" . Str::random(16) . "." . $request->proof->getClientOriginalExtension();

        $data['user_id'] = Auth::guard('api')->user()->id;
        $data['proof'] = $proof;

        Seminar::create($data);

        Storage::disk('public')->put($proof, file_get_contents($request->proof));

        return response()->json([
            'message' => 'Berhasil daftar seminar',
            'data' => $data
        ]);
    }
}
