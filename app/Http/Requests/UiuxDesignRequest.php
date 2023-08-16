<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UiuxDesignRequest extends FormRequest
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
            'email' => 'required|email|unique:uiux_designs,email',
            'college' => 'required',

            // Anggota 1
            'name1' => 'required',
            'nim1' => 'required',
            'phone_number1' => 'required',
            'instagram1' => 'required',
            'id_card1' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            // Anggota 2
            'name2' => 'nullable',
            'nim2' => 'nullable',
            'phone_number2' => 'nullable',
            'instagram2' => 'nullable',
            'id_card2' => 'nullable|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            // Anggota 3
            'name3' => 'nullable',
            'nim3' => 'nullable',
            'phone_number3' => 'nullable',
            'instagram3' => 'nullable',
            'id_card3' => 'nullable|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',

            // Payment
            'proof' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:2048',
            'payment_method' => 'required',
        ];
    }
}