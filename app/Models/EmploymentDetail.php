<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'designation_id',
        'organization',
        'work_from',
        'work_till',
        'experience',
        'current_company',
        'job_profile',
        'created_by',
        'updated_by'
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
