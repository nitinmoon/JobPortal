@extends('backend.layouts.app')
@section('title', 'Employer View')
@section('content')
<div class="pagetitle">
  <h1>{{ trans('employer.employers') }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('employers') }}">{{ trans('employer.employer') }}</a></li>
      <li class="breadcrumb-item active"> {{ trans('employer.view_employer') }}</li>
    </ol>
  </nav>
</div>
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ !empty($employerDetails->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="Profile" class="rounded-circle">
              <h2>{{ isset($userDetails->first_name) && $userDetails->first_name != null ? getTitle($userDetails->title) . ' ' . strip_tags(ucfirst($userDetails->first_name)) . ' ' .strip_tags(ucfirst($userDetails->last_name)) : explode('@', $userDetails->email)[0] }}</h2>
              <h3>{{ isset($userDetails->role->name) ? $userDetails->role->name : '--' }}</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basic-overview">Basic Details</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#company-overview">Company Details</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="basic-overview">
                  <h5 class="card-title">Basic Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->first_name) && $userDetails->first_name != null ? getTitle($userDetails->title) . ' ' . strip_tags(ucfirst($userDetails->first_name)) . ' ' .strip_tags(ucfirst($userDetails->last_name)) : explode('@', $userDetails->email)[0] }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->email) ? $userDetails->email : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->phone) ? $userDetails->phone : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">DOB</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->dob) ? date('d M y', strtotime($userDetails->dob)) : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->gender) ? getUserGender($userDetails->gender) : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->address) ? $userDetails->address : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Zip Code</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->zip) ? $userDetails->zip : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->country_id) ? $userDetails->country_name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->state_id) ? $userDetails->state_name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">City</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->city_id) ? $userDetails->city_name : '--' }}</div>
                  </div>
                </div>

                <div class="tab-pane fade profile-overview" id="company-overview">
                  <h5 class="card-title">Company Details</h5>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Company name</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->company_name) ? $employerDetails->company_name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Company Website</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->company_website) ? $employerDetails->company_website : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Company Contact Person</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->company_contact_person) ? $employerDetails->company_contact_person : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Company Contact Email</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->company_contact_email) ? $employerDetails->company_contact_email : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Company Contact Number</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->company_contact_no) ? $employerDetails->company_contact_no : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Job Category</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->job_category_id) ? $employerDetails->jobCategory->name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Foundation Date</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->foundation_date) ? $employerDetails->foundation_date : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">No. Of Employees</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->no_of_employees) ? $employerDetails->no_of_employees : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">GST Number</div>
                    <div class="col-lg-8 col-md-8">{{ isset($employerDetails->gst_no) ? $employerDetails->gst_no : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4 label">Company Description</div>
                    <div class="col-lg-8 col-md-8">{!! isset($employerDetails->company_description) ? $employerDetails->company_description : '--' !!}</div>
                  </div>
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
</section>
@endsection