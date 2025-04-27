<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployerDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'employer_details';

    protected $fillable = [
        'employer_id',
        'company_name',
        'company_logo',
        'company_website',
        'company_description',
        'company_contact_person',
        'company_contact_email',
        'company_contact_no',
        'job_category_id',
        'foundation_date',
        'no_of_employees',
        'gst_no',
        'company_address',
        'country_id',
        'state_id',
        'city_id',
        'zip',
        'created_by',
        'updated_by'
    ];
}
