<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AddUpdateEmployerInputRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = User::find($this->employerId);
        return [
            'title' => 'required',
            'first_name' => 'required|max:50',
            'middle_name' => 'max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.(isset($user->id) ? $user->id  : ''),
            'phone' => 'required|digits:10|numeric',
            'gender' => 'required',
            'dob' => 'required',
            'company_name' => 'required|max:200',
            'company_website' => 'required|url',
            'job_category_id' => 'required',
            'foundation_date' => 'required',
            'no_of_employees' => 'required|max:50',
            'gst_no' => 'required|max:20',
            'company_address' => 'required',
            'zip' =>'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required'
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
            'dob.required' => 'DOB is required',
            'company_name.required' => 'Company name is required',
            'company_name.max' => 'Company name not be greater than 50 characters',
            'company_website.required' => 'Company name is required',
            'company_website.url' => 'Enter valid company website url',
            'company_address.required' => 'Company address is required',
            'zip.required' =>'Zip is required',
            'country_id.required' => 'Country is required',
            'state_id.required' => 'State is required',
            'city_id.required' => 'City is required',
        ];
    }
}
