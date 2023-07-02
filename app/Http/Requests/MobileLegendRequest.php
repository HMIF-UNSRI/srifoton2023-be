<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobileLegendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'team_name' => 'required',
            'email' => 'required|email|unique:mobile_legends',

            // Anggota 1
            'name1' => 'required',
            'nim1' => 'required',
            'college1' => 'required',
            'phone_number1' => 'required',
            'instagram1' => 'required',
            'id_mole1' => 'required',
            'id_card1' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            // Anggota 2
            'name2' => 'required',
            'nim2' => 'required',
            'college2' => 'required',
            'phone_number2' => 'required',
            'instagram2' => 'required',
            'id_mole2' => 'required',
            'id_card2' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            // Anggota 3
            'name3' => 'required',
            'nim3' => 'required',
            'college3' => 'required',
            'phone_number3' => 'required',
            'instagram3' => 'required',
            'id_mole3' => 'required',
            'id_card3' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            // Anggota 4
            'name4' => 'required',
            'nim4' => 'required',
            'college4' => 'required',
            'phone_number4' => 'required',
            'instagram4' => 'required',
            'id_mole4' => 'required',
            'id_card4' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            // Anggota 5
            'name5' => 'required',
            'nim5' => 'required',
            'college5' => 'required',
            'phone_number5' => 'required',
            'instagram5' => 'required',
            'id_mole5' => 'required',
            'id_card5' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            // Anggota 6
            'name6' => 'nullable',
            'nim6' => 'nullable',
            'college6' => 'nullable',
            'phone_number6' => 'nullable',
            'instagram6' => 'nullable',
            'id_mole6' => 'nullable',
            'id_card6' => 'nullable|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',

            // Payment
            'proof' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            'payment_method' => 'required',
        ];
    }

}
