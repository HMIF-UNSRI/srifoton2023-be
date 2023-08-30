<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebDevelopment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\WebDevelopmentRequest;

class WebDevelopmentController extends Controller
{
    /**
     * Web Development Registration
     * 
     * Endpoint ini digunakan untuk mendaftar kompetisi Web Development.
     * 
     * @authenticated
     * 
     * @bodyParam team_name string required
     * Example: Manchester City
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Harus berupa email valid.</li>
     *      <li>Harus unique (tidak boleh email yang telah terdaftar di kompetisi Web Development)</li>
     * </ul>
     * Example: pep@gmail.com
     * @bodyParam college string required
     * Example: Universitas Manchester City
     * 
     * @bodyParam name1 string required
     * Example: Erling Haaland
     * @bodyParam nim1 string required
     * Example: 09021182126001
     * @bodyParam phone_number1 string required
     * Example: 082162798119
     * @bodyParam instagram1 string required
     * Example: anakpapapep
     * @bodyParam id_card1 file required
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name2 string
     * Example: Kevin De Bruyne
     * @bodyParam nim2 string
     * Example: 09021182126002
     * @bodyParam phone_number2 string
     * Example: 082296232641
     * @bodyParam instagram2 string
     * Example: fixgoal
     * @bodyParam id_card2 file
     * <ul>
     *      <li>Maksimal 2 MB</li>
     *      <li>Harus berupa ekstensi png, jpg, jpeg, svg, pdf</li>
     * </ul>
     * 
     * @bodyParam name3 string
     * Example: Lionel Messi
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
    public function Register(WebDevelopmentRequest $request)
    {
        $data = $request->validated();

        $existingUser = WebDevelopment::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['error' => 'Email ini telah terdaftar di kompetisi Web Development.'], 409);
        }

        $proof = "bukti-pembayaran/web-development/$request->payment_method-$request->team_name-" . Str::random(16) . "." . $request->proof->getClientOriginalExtension();

        $idCards = [];

        $members = ($request->id_card3) ? 3 : (($request->id_card2) ? 2 : 1);

        for ($i = 1; $i <= $members; $i++) {
            $nim = $request->{"nim$i"};
            $extension = $request->{"id_card$i"}->getClientOriginalExtension();

            $idCard = "id-card/web-development/$request->team_name/anggota$i-$nim-" . Str::random(16) . ".$extension";

            $idCards[$i - 1] = $idCard;
        }

        $data['user_id'] = Auth::guard('api')->user()->id;
        $data['proof'] = env('APP_URL') . Storage::url($proof);

        for ($i = 1; $i <= $members; $i++) {
            $data["id_card$i"] = env('APP_URL') . Storage::url($idCards[$i - 1]);
        }

        WebDevelopment::create($data);

        Storage::disk('public')->put($proof, file_get_contents($request->proof));

        for ($i = 1; $i <= $members; $i++) {
            Storage::disk('public')->put($idCards[$i - 1], file_get_contents($request->{"id_card$i"}));
        }

        return response()->json([
            'message' => 'Berhasil daftar Web Development',
            'data' => $data
        ]);
    }

    /**
     * Web Development Submission
     * 
     * @bodyParam title string required
     * Example: Monocode
     * @bodyParam submission file required
     * <ul>
     *      <li>Harus berupa ekstensi rar, zip</li>
     * </ul>
     * 
     * @authenticated
     */
    public function submitSubmission(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'submission' => 'required|file|mimes:rar,zip'
        ]);

        $userId = Auth::user()->id;
        $webdev = WebDevelopment::where('user_id', $userId)->first();

        if (!$webdev) {
            return response()->json([
                'message' => 'Anda belum terdaftar pada kompetisi Web Development.'
            ], 404);
        }

        if (!$webdev->isVerified) {
            return response()->json([
                'message' => 'Bukti pembayaran belum diverifikasi'
            ], 402);
        }

        if ($webdev->submission) {
            return response()->json([
                'message' => 'Hanya bisa mengumpulkan submission sekali, jika ingin mengubah silahkan hubungi narahubung.'
            ], 409);
        }

        $submission = "submission/web-development/$webdev->team_name - " . $request->title . "." . $request->submission->getClientOriginalExtension();

        WebDevelopment::where('user_id', $userId)->update([
            'title' => $request->title,
            'submission' => env('APP_URL') . Storage::url($submission),
        ]);

        Storage::disk('public')->put($submission, file_get_contents($request->submission));

        return response()->json([
            'message' => 'Submission berhasil disimpan',
            'submission' => env('APP_URL') . Storage::url($submission)
        ]);
    }
}
