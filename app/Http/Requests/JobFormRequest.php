<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobFormRequest extends FormRequest
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
            'job_title' => 'required',
            'job_category_id' => 'required',
            'job_type_id' => 'required',
            'country_id' => ['required_if:work_type_id,2,work_type_id,3'],
            'state_id' => ['required_if:work_type_id,2,work_type_id,3'],
            'city_id' => ['required_if:work_type_id,2,work_type_id,3'],
            'experience' => 'required',
            'vacancy' => 'required',
            'job_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'job_title.required' => 'Please enter job title.',
            'job_category_id.required' => 'Please select job category.',
            'job_type_id.required' => 'Please select job type.',
            'country_id.required_if' => 'Please select country.',
            'state_id.required_if' => 'Please select state.',
            'city_id.required_if' => 'Please select city.',
            'experience.required' => 'Please select experience.',
            'vacancy.required' => 'Please enter vacancy.',
            'job_description.required' => 'Please enter description.'
        ];
    }
}
