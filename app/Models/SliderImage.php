<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SliderImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'slider_images';

    protected $fillable = [
        'title',
        'image',
        'status',
        'created_by',
        'updated_by'
    ];
}
