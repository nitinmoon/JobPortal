<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'work_types';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by'
    ];
}
