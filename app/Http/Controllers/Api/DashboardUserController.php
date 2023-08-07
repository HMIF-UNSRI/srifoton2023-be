<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    /**
     * Update Data User
     * 
     * Endpoint ini digunakan untuk memperbarui data user.
     * 
     * @bodyParam name string required
     * <ul>
     *      <li>Maksimal 255 karakter.</li>
     * </ul>
     * Example: Aldi Taher
     * 
     * @bodyParam college string required
     * Example: Universitas Sriwijaya
     * 
     * @bodyParam nim string required
     * Example: 09021182126005
     * 
     * @bodyParam phone_number string required
     * Example: 089520194424
     * 
     * @bodyParam gender string required
     * Example: Laki-laki
     * 
     * @bodyParam instagram string required
     * Example: lookatthestars
     * @authenticated
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->except('email');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'college' => 'required',
            'nim' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'instagram' => 'required'
        ]);

        User::where('id', $user->id)->update($data);

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'user' => $user
        ]);
    }
}
