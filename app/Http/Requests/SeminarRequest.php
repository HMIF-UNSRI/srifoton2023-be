<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeminarRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:seminars,email',
            'nim' => 'required|string',
            'college' => 'required|string',
            'phone_number' => 'required|string',
            'type' => 'required|string',
            'proof' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'payment_method' => 'required|string',
        ];
    }
}
