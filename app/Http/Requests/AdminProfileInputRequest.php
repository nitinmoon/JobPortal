<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileInputRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required',
            'first_name' => 'required|max:50',
            'middle_name' => 'max:50',
            'last_name' => 'required|max:50',
            'phone' => 'required|digits:10|numeric',
            'gender' => 'required',
            'dob' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Required',
            'first_name.required' => 'First name is required',
            'first_name.max' => 'First name not be greater than 50 characters',
            'middle_name.max' => 'Middle name not be greater than 50 characters',
            'last_name.required' => 'Last name is required',
            'last_name.max' => 'Last name not be greater than 50 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'Email already exists',
            'phone.required' => 'Phone number is required',
            'phone.digits' => 'Phone number must be 10 digit long',
            'phone.numeric' => 'Phone number must be digits',
            'gender.required' => 'Gender is required',
            'dob.required' => 'DOB is required'
        ];
    }
}
