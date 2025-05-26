<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;
    protected $table= 'apply_jobs';

    protected $fillable = [
        'job_id',
        'candidate_id',
        'employer_id',
        'status'
    ];

     public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
