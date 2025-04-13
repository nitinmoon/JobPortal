<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminChangePasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
                'current_password' => 'required|max:12',
                'password' => 'required|min:6|max:12',
                'confirm_password' => 'required|min:6|max:12|same:password',
            ];
    }

    public function messages()
    {
            return [
                'current_password.required' => 'Current password is required',
                'password.required' => 'Password is required',
                'confirm_password.required' => 'Confirm password is required',
                'confirm_password.same' => 'Confirm password should match with new password'
            ];
    }
}
