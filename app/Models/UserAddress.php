<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'user_addresses';

    protected $fillable = [
        'address',
        'country_id',
        'state_id',
        'city_id',
        'user_id'
    ];
}
