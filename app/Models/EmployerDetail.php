<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployerDetail extends Model
{
    use HasFactory;

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

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
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

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }
}
