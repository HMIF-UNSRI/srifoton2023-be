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
    /**
     * Mobile Legend Registration
     * 
     * Endpoint ini digunakan untuk mendaftar kompetisi mobile legends.
     * 
     * @authenticated
     * 
     * @bodyParam team_name string required
     * Example: UCL
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     *      <li>Harus unique (tidak boleh email yang telah terdaftar di kompetisi mobile legends)</li>
     * </ul>
     * Example: youremail@gmail.com
     * 
     * @bodyParam name1 string required
     * Example: Erling Haaland
     * @bodyParam nim1 string required
     * Example: 09021182126001
     * @bodyParam college1 string required
     * Example: Universitas Manchester City
     * @bodyParam phone_number1 string required
     * Example: 082162798119
     * @bodyParam instagram1 string required
     * Example: anakpapapep
     * @bodyParam id_mole1 string required
     * Example: 259409998
     * @bodyParam id_card1 file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name2 string required
     * Example: Cristiano Ronaldo
     * @bodyParam nim2 string required
     * Example: 09021182126002
     * @bodyParam college2 string required
     * Example: Universitas Al Nasr
     * @bodyParam phone_number2 string required
     * Example: 082296232641
     * @bodyParam instagram2 string required
     * Example: fixgoal
     * @bodyParam id_mole2 string required
     * Example: 504467129
     * @bodyParam id_card2 file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name3 string required
     * Example: Lionel Messi
     * @bodyParam nim3 string required
     * Example: 09021182126003
     * @bodyParam college3 string required
     * Example: Universitas Inter Miami
     * @bodyParam phone_number3 string required
     * Example: 081278059819
     * @bodyParam instagram3 string required
     * Example: juarapildun
     * @bodyParam id_mole3 string required
     * Example: 229303819
     * @bodyParam id_card3 file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name4 string required
     * Example: Neymar Jr.
     * @bodyParam nim4 string required
     * Example: 09021182126004
     * @bodyParam college4 string required
     * Example: Universitas PSG
     * @bodyParam phone_number4 string required
     * Example: 082938193018
     * @bodyParam instagram4 string required
     * Example: jogetinajabray
     * @bodyParam id_mole4 string required
     * Example: 371938103
     * @bodyParam id_card4 file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name5 string required
     * Example: Mohammed Salah
     * @bodyParam nim5 string required
     * Example: 09021182126005
     * @bodyParam college5 string required
     * Example: Universitas Liverpool
     * @bodyParam phone_number5 string required
     * Example: 082289310381
     * @bodyParam instagram5 string required
     * Example: anekangenmane
     * @bodyParam id_mole5 string required
     * Example: 394103810
     * @bodyParam id_card5 file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name6 string
     * Example: Kai Havertz
     * @bodyParam nim6 string
     * Example: 09021182126006
     * @bodyParam college6 string
     * Example: Universitas Chelsea
     * @bodyParam phone_number6 string
     * Example: 085728192048
     * @bodyParam instagram6 string
     * Example: clubbapukasu
     * @bodyParam id_mole6 string
     * Example: 283913038
     * @bodyParam id_card6 file
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
