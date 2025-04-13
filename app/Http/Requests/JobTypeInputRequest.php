<?php

namespace App\Http\Requests;

use App\Models\JobType;
use Illuminate\Foundation\Http\FormRequest;

class JobTypeInputRequest extends FormRequest
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
        $jobType = JobType::find($this->jobTypeId);
        return [
            'name' => 'required|unique:job_types,name,'.(isset($jobType->id) ? $jobType->id  : ''),
        ];
    }

    /**
     * Get the custom messages for validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'Job type name is required',
            'name.unique' => 'Job type name has already been taken'
        ];
    }
}
