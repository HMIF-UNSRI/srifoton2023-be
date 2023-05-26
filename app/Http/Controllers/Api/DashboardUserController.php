<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->except('email');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'college' => 'required',
            'semester' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'instagram' => 'required'
        ]);

        User::where('id', $user->id)->update($data);

        return response()->json([
            'message' => 'Data berhasil diupdate'
        ]);
    }
}
