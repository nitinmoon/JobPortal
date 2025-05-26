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
        'current_salary',
        'expected_salary',
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
}
