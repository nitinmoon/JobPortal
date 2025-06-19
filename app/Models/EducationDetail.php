<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'education',
        'college',
        'university',
        'year_of_passing',
        'percentage',
        'created_by',
        'updated_by'
    ];
}
