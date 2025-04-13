<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|max:12|same:confirm_password',
            'confirm_password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.exists' => 'Email does not exist'
        ];
    }
}
