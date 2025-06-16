<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDetail extends Model
{
    use HasFactory;

    protected $table= 'candidate_details';

    protected $fillable = [
        'candidate_id',
        'designation_id',
        'job_category_id',
        'job_type_id',
        'work_type_id',
        'current_salary',
        'expected_salary',
        'shift',
        'experience',
        'marital_status',
        'education',
        'skills',
        'resume_headline',
        'description',
        'profile_summary',
        'languages',
        'resume_file',
        'availability_to_join',
        'status',
        'created_by',
        'updated_by',
    ];

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function workType()
    {
        return $this->belongsTo(WorkType::class, 'work_type_id');
    }
}
