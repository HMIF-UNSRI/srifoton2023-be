<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetitiveProgramming;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompetitiveProgrammingRequest;

class CompetitiveProgrammingController extends Controller
{
    /**
     * Competitive Programming Registration
     * 
     * Endpoint ini digunakan untuk mendaftar kompetisi competitive programming.
     * 
     * @authenticated
     * 
     * @bodyParam team_name string required
     * Example: Liverpool
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     *      <li>Harus unique (tidak boleh email yang telah terdaftar di kompetisi competitive programming)</li>
     * </ul>
     * Example: youremail@gmail.com
     * @bodyParam college string required
     * Example: Universitas Liverpool
     * 
     * @bodyParam name1 string required
     * Example: Mohammed Salah
     * @bodyParam nim1 string required
     * Example: 09021182126001
     * @bodyParam phone_number1 string required
     * Example: 082162798119
     * @bodyParam instagram1 string required
     * Example: kiyaisalah
     * @bodyParam id_card1 file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name2 string
     * Example: Darwin Nunez
     * @bodyParam nim2 string
     * Example: 09021182126002
     * @bodyParam phone_number2 string
     * Example: 082296232641
     * @bodyParam instagram2 string
     * Example: nunezgoat
     * @bodyParam id_card2 file
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name3 string
     * Example: Thiago Alcantara
     * @bodyParam nim3 string
     * Example: 09021182126003
     * @bodyParam phone_number3 string
     * Example: 081278059819
     * @bodyParam instagram3 string
     * Example: juarapildun
     * @bodyParam id_card3 file
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam proof file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * @bodyParam payment_method string required
     * Example: Dana
     */
    public function register(CompetitiveProgrammingRequest $request)
    {
        $data = $request->validated();

        $existingUser = CompetitiveProgramming::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['error' => 'Email ini telah terdaftar di kompetisi Competitive Programming.'], 409);
        }

        $proof = "bukti-pembayaran/competitive-programming/$request->payment_method-$request->team_name-" . Str::random(16) . "." . $request->proof->getClientOriginalExtension();

        $idCards = [];
        $members = ($request->id_card3) ? 3 : (($request->id_card2) ? 2 : 1);

        for ($i = 1; $i <= $members; $i++) {
            $nim = $request->{"nim$i"};
            $extension = $request->{"id_card$i"}->getClientOriginalExtension();

            $idCard = "id-card/competitive-programming/$request->team_name/anggota$i-$nim-" . Str::random(16) . ".$extension";

            $idCards[$i - 1] = $idCard;
        }

        $data['user_id'] = Auth::guard('api')->user()->id;
        $data['proof'] = env('APP_URL') . Storage::url($proof);

        for ($i = 1; $i <= $members; $i++) {
            $data["id_card$i"] = env('APP_URL') . Storage::url($idCards[$i - 1]);
        }

        CompetitiveProgramming::create($data);

        Storage::disk('public')->put($proof, file_get_contents($request->proof));

        for ($i = 1; $i <= $members; $i++) {
            Storage::disk('public')->put($idCards[$i - 1], file_get_contents($request->{"id_card$i"}));
        }

        return response()->json([
            'message' => 'Berhasil daftar competitive programming',
            'data' => $data
        ]);
    }
}
