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
        'job_tags',
        'experience',
        'min_salary',
        'max_salary',
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
        'status',
        'created_by',
        'updated_by',
    ];
}
