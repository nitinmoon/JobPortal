@extends('backend.layouts.app')
@section('title', 'Candidate Form')
@section('content')
<div class="pagetitle">
  <h1>{{ trans('candidate.candidates') }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('employerDashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('candidates') }}">{{ trans('candidate.candidates') }}</a></li>
      <li class="breadcrumb-item active"> {{ trans('candidate.candidate') }}</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body mt-2">
          <form id="job-form" class="row g-3 mt-2" action="{{ route('addUpdateJob') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3">
                  <label for="title" class="form-label">Title</label>
                  <select class="form-select js-example-basic-single" name="title" data-error="#error_title">
                    <option value="">Select</option>
                    @foreach($title as $row)
                    <option value="{{ $row }}">{{ $row }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_title"></span>
                </div>
                <div class="col-md-3">
                  <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="">
                  <span class="error" id="error_first_name"></span>
                </div>
                <div class="col-md-3">
                  <label for="middle_name" class="form-label">Middle name<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name" value="">
                  <span class="error" id="error_middle_name"></span>
                </div>
                <div class="col-md-3">
                  <label for="last_name" class="form-label">Last name<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="">
                  <span class="error" id="error_last_name"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="">
                    <span class="error" id="error_email"></span>
                </div>
                <div class="col-md-3">
                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone" value="">
                    <span class="error" id="error_phone"></span>
                </div>
                <div class="col-md-3">
                    <label for="dob" class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="dob" placeholder="Enter Dob" value="">
                    <span class="error" id="error_dob"></span>
                </div>
                <div class="col-md-3">
                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                    <select class="form-select js-example-basic-single" name="gender" data-error="#error_gender">
                        <option value="">Select</option>
                        @foreach($gender as $row)
                        <option value="{{ $row }}" >{{ getGender($row) }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_gender"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="gender" class="form-label">Education <span class="text-danger">*</span></label>
                    <select class="select2 form-control" id="education" name="education" data-placeholder="Select Education" style="width:100%">
                        <option value="">Select</option>
                        @foreach (educationArray() as $education)
                        <option value="{{ $education }}" >{{ $education }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail5" class="form-label">Skills <span class="text-danger">*</span></label>
                    <select class="form-select js-example-basic-single" data-error="#error_skills" multiple="multiple" name="skills[]" data-placeholder="Select">
                        <option value="">Select</option>
                        @foreach($skills as $row)
                        <option value="{{ $row->id }}" {{ (isset($jobDetails->skills) && $jobDetails->skills != '' && in_array($row->id, explode(',', $jobDetails->skills))) ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_skills"></span>
                </div>
                <div class="col-md-3">
                    <label for="upload_resume" class="form-label">Upload Resume <span class="text-danger location">*</span></label>
                    <input type="file" class="form-control" id="resume_file" name="resume_file" value="">
                    <input type="hidden" id="resumeFile" value="{{ isset($candidateDetails->resume_file) && $candidateDetails->resume_file != null ? $candidateDetails->resume_file : '' }}">
                    <span class="error" id="error_resume_file"></span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="experience" class="form-label">Experience <span class="text-danger location">*</span></label>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Years" name="year_experience" id="yearExperience" maxlength="2" value="{{ isset($candidateDetails->experience) && $candidateDetails->experience != null ? explode('-', $candidateDetails->experience)[0] : '' }}">
                </div>
                <div class="col-md-3 mt-2">
                    Years
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Months" name="month_experience" id="monthExperience" maxlength="2" value="{{ isset($candidateDetails->experience) && $candidateDetails->experience != null ? explode('-', $candidateDetails->experience)[1] : '' }}">
                </div>
                <div class="col-md-3 mt-2">
                    Months
                </div>
            </div>
            <div class="row">
                <label for="experience" class="form-label">Address <span class="text-danger location">*</span></label>
                <div class="col-md-12">
                    <label for="dob" class="form-label">Address</label>
                    <textarea class="form-control" name="address" placeholder="Enter Address"></textarea>
                    <span class="error" id="error_dob"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label class="labels">Zip Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter zip code" name="zip" id="zip" maxlength="6" value="{{ isset($candidateDetails->zip) && $candidateDetails->zip != null ? $candidateDetails->zip : '' }}">
                </div>
                <div class="col-md-3">
                    <label for="country_id" class="form-label">Country <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="country_id" id="country_id" data-error="#error_country_id">
                        <option value="">Select</option>
                        @foreach($countries as $row)
                        <option value="{{ $row->id }}" {{ (isset($candidateDetails->country_id) && $candidateDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_country_id"></span>
                </div>
                <div class="col-md-3">
                    <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="state_id" id="state_id" data-error="#error_state_id">
                        @if(isset($candidateDetails->id))
                        @if(count($states) > 0)
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ isset($candidateDetails->state_id) && ($state->id == $candidateDetails->state_id) ? 'selected' : '' }}>{{$state->name}}</option>
                        @endforeach
                        @else
                        <option value="">Select</option>
                        @endif
                        @else
                        <option value="">Select</option>
                        @endif
                    </select>
                    <span class="error" id="error_state_id"></span>
                </div>
                <div class="col-md-3">
                    <label for="city_id" class="form-label">City <span class="text-danger">*</span></label><br>
                    <select class="form-select select2" name="city_id" id="city_id" data-error="#error_city_id">
                        @if(isset($candidateDetails->id))
                        @if(count($states) > 0)
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ isset($candidateDetails->city_id) && ($city->id == $candidateDetails->city_id) ? 'selected' : '' }}>{{$city->name}}</option>
                        @endforeach
                        @else
                        <option value="">Select</option>
                        @endif
                        @else
                        <option value="">Select</option>
                        @endif
                    </select>
                    <span class="error" id="error_city_id"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt">
                  <input type="hidden" name="jobId" value="{{ isset($jobDetails->id) ? $jobDetails->id : 0 }}" />
                  <button type="submit" class="btn btn-primary">{{ isset($jobDetails->id) ? 'Update' : 'Save' }}</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/jobs.js') }}"></script>
<script>
$(function() {
  $('.js-example-basic-single').select2();
  $('#country_id').change(function() {
    var countryId = $(this).val();
    $("#state_id").empty();
    $("#city_id").empty();
    $.ajax({
      url: "{{ route('getState') }}",
      dataType: 'json',
      data: {
        countryId: countryId
      },
      delay: 250,
      success: function(data) {
        $("#state_id").empty();
        $.each(data, function(key, value) {
          var id, text, $option;
          $option += "<option value=''>Select State</option>";
          for (var i = 0; i < value.length; i++) {
            $option += "<option value ='" + value[i]['id'] + "'>" + value[i]['name'] + "</option>";
          }
          $("#state_id").append($option);
        });
        var $option;
        $option += "<option value=''>Select City</option>";
        $("#city_id").append($option);
      }
    });
  });

  $("#state_id").change(function() {
    var stateId = $(this).val();
    $("#city_id").empty();
    $.ajax({
      url: "{{ route('getCity') }}",
      dataType: 'json',
      data: {
        stateId: stateId
      },
      delay: 250,
      success: function(data) {
        $("#city_id").empty();
        $.each(data, function(key, value) {
          var id, text, $option;
          $option += "<option value=''>Select City</option>";
          for (var i = 0; i < value.length; i++) {
            $option += "<option value ='" + value[i]['id'] + "'>" + value[i]['name'] + "</option>";
          }
          $("#city_id").append($option);
        });
      }
    });
  });
});
</script>
@endsection