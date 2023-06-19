<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\MobileLegend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MobileLegendRequest;

class MobileLegendController extends Controller
{
    public function register(MobileLegendRequest $request)
    {
        $data = $request->validated();

        $proof = "bukti-pembayaran/mobile-legends/$request->payment_method-$request->team_name-" . Str::random(16) . "." . $request->proof->getClientOriginalExtension();

        $idCards = [];
        $members = ($request->id_card6 == null) ? 5 : 6;

        for ($i = 1; $i <= $members; $i++) {
            $nim = $request->{"nim$i"};
            $extension = $request->{"id_card$i"}->getClientOriginalExtension();

            $idCard = "id-card/mobile-legends/$request->team_name/anggota$i-$nim-" . Str::random(16) . ".$extension";

            $idCards[$i - 1] = $idCard;
        }

        $data['user_id'] = Auth::guard('api')->user()->id;
        $data['proof'] = $proof;

        for ($i = 1; $i <= $members; $i++) {
            $data["id_card$i"] = $idCards[$i - 1];
        }

        MobileLegend::create($data);

        Storage::disk('public')->put($proof, file_get_contents($request->proof));

        for ($i = 1; $i <= $members; $i++) {
            Storage::disk('public')->put($idCards[$i - 1], file_get_contents($request->{"id_card$i"}));
        }

        return response()->json([
            'message' => 'Berhasil daftar mobile legends',
            'data' => $data
        ]);
    }
}
