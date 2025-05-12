<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'jobs';

    protected $fillable = [
        'job_title',
        'employer_id',
        'designation_id',
        'job_category_id',
        'job_type_id',
        'work_type_id',
        'experience',
        'salary_range',
        'job_description',
        'job_responsibility',
        'educational_requirements',
        'other_benefits',
        'vacancy',
        'skills',
        'deadline',
        'gender',
        'english_level',
        'country_id',
        'state_id',
        'city_id',
        'upload_file',
        'job_status',
        'status',
        'created_by',
        'updated_by',
    ];

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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function workType()
    {
        return $this->belongsTo(WorkType::class, 'work_type_id');
    }
}
