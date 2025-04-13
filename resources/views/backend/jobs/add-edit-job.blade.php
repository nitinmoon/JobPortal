@extends('backend.layouts.app')
@php $title = isset($jobDetails->id) ? 'Edit Job' : 'Add Job'; @endphp
@section('title', $title)
@section('content')
<div class="pagetitle">
  <h1>{{ $title }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('employerDashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('jobs') }}">Jobs</a></li>
      <li class="breadcrumb-item active">{{ $title }}</li>
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
            <div class="col-md-6">
              <label for="job_title" class="form-label">Job Title<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="job_title" placeholder="Enter Job Title" tabindex="1" value="{{ isset($jobDetails->job_title) ? $jobDetails->job_title : '' }}">
              <span class="error" id="error_job_title"></span>
            </div>
            <div class="col-md-6">
              <label for="designation_id" class="form-label">Designation</label>
              <select class="form-select js-example-basic-single" name="designation_id" tabindex="2" data-error="#error_designation_id">
                <option value="">Select</option>
                @foreach($designation as $row)
                <option value="{{ $row->id }}" {{ (isset($jobDetails->designation_id) && $jobDetails->designation_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                @endforeach
              </select>
              <span class="error" id="error_designation_id"></span>
            </div>
            <div class="col-md-6">
              <label for="job_category_id" class="form-label">Job Category<span class="text-danger">*</span></label>
              <select class="form-select js-example-basic-single" name="job_category_id" tabindex="3" data-error="#error_job_category_id">
                <option value="">Select</option>
                @foreach($jobCategory as $row)
                <option value="{{ $row->id }}" {{ (isset($jobDetails->job_category_id) && $jobDetails->job_category_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                @endforeach
              </select>
              <span class="error" id="error_job_category_id"></span>
            </div>
            <div class="col-md-6">
              <label for="job_type_id" class="form-label">Job Type<span class="text-danger">*</span></label>
              <select class="form-select js-example-basic-single" name="job_type_id" tabindex="4" data-error="#error_job_type_id">
                <option value="">Select</option>
                @foreach($jobType as $row)
                <option value="{{ $row->id }}" {{ (isset($jobDetails->job_type_id) && $jobDetails->job_type_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                @endforeach
              </select>
              <span class="error" id="error_job_type_id"></span>
            </div>
            <div class="col-md-6">
              <label for="work_type_id" class="form-label">Job Work Type</label>
              <select class="form-select js-example-basic-single" name="work_type_id" id="work_type_id" tabindex="5" data-error="#error_work_type_id">
                <option value="">Select</option>
                @foreach($jobWorkType as $row)
                <option value="{{ $row->id }}" {{ (isset($jobDetails->work_type_id) && $jobDetails->work_type_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                @endforeach
              </select>
              <span class="error" id="error_work_type_id"></span>
            </div>
            <div class="col-md-6">
              <label for="country_id" class="form-label">Country<span class="text-danger location">*</span></label>
              <select class="form-select js-example-basic-single" name="country_id" id="country_id" tabindex="6" data-error="#error_country_id">
                <option value="">Select</option>
                @foreach($countries as $row)
                <option value="{{ $row->id }}" {{ (isset($jobDetails->country_id) && $jobDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                @endforeach
              </select>
              <span class="error" id="error_country_id"></span>
            </div>
            <div class="col-md-6">
              <label for="inputPassword5" class="form-label">State<span class="text-danger location">*</span></label>
              <select class="form-select js-example-basic-single" name="state_id" id="state_id" tabindex="7" data-error="#error_state_id">
                @if(isset($jobDetails->id))
                @if(count($states) > 0)
                @foreach ($states as $state)
                <option value="{{ $state->id }}" {{ isset($jobDetails->state_id) && ($state->id == $jobDetails->state_id) ? 'selected' : '' }}>{{$state->name}}</option>
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
            <div class="col-md-6">
              <label for="city_id" class="form-label">City<span class="text-danger location">*</span></label>
              <select class="form-select js-example-basic-single" name="city_id" id="city_id" tabindex="8" data-error="#error_city_id">
                @if(isset($jobDetails->id))
                @if(count($states) > 0)
                @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ isset($jobDetails->city_id) && ($city->id == $jobDetails->city_id) ? 'selected' : '' }}>{{$city->name}}</option>
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
            <div class="col-md-6">
              <label for="experience" class="form-label">Experience<span class="text-danger">*</span></label><br>
              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check experience" name="experience" id="btnradio1" autocomplete="off" value="Fresher & Experienced" tabindex="9" data-error="#error_experience" {{ isset($jobDetails->experience) && $jobDetails->experience == 'Fresher & Experienced' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="btnradio1">Any</label>

                <input type="radio" class="btn-check experience" name="experience" id="btnradio2" autocomplete="off" value="Experienced" tabindex="10" data-error="#error_experience" {{ isset($jobDetails->experience) && ($jobDetails->experience != 'Fresher & Experienced' && $jobDetails->experience != 'Fresher') ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="btnradio2">Experienced Only</label>

                <input type="radio" class="btn-check experience" name="experience" id="btnradio3" autocomplete="off" value="Fresher" tabindex="11" data-error="#error_experience" {{ isset($jobDetails->experience) && $jobDetails->experience == 'Fresher' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary" for="btnradio3">Fresher Only</label>
              </div><br>
              <span class="badge bg-success mt-3 p-2 d-none" id="FresherExpSpan"><i class="bi bi-exclamation-octagon me-1"></i> Both fresher & experienced candidates will be able to apply</span>
              <div class="row mt-3 d-none" id="experienceDiv">
                <div class="col-md-4">
                  <input type="text" class="form-control" name="year_experience" id="yearExperience" maxlength="2" max="50" data-error="#error_experience" value="{{ isset($jobDetails->experience) && ($jobDetails->experience != 'Fresher & Experienced' && $jobDetails->experience != 'Fresher') ? explode('-', $jobDetails->experience)[0] : '' }}">
                </div>
                <div class="col-md-2 mt-2">
                  Years
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="month_experience" id="monthExperience" maxlength="2" max="11" data-error="#error_experience" value="{{ isset($jobDetails->experience) && ($jobDetails->experience != 'Fresher & Experienced' && $jobDetails->experience != 'Fresher') ? explode('-', $jobDetails->experience)[1] : '' }}">
                </div>
                <div class="col-md-2 mt-2">
                  Months
                </div>
              </div>
              <span class="badge bg-success mt-3 p-2 d-none" id="FresherSpan"><i class="bi bi-exclamation-octagon me-1"></i> Only fresher candidates will be able to apply</span>
              <span class="error" id="error_experience"></span>
            </div>
            <div class="col-md-6">
              <label for="salary_range" class="form-label">Fixed Salary <span id="yearlySalary"></span> </label>
              <!-- <select class="form-select js-example-basic-single" name="salary_range" data-error="#error_salary_range">
                <option value="">Select</option>
                @for($i = 1; $i < 30; $i++)
                @php $val=$i." - ".$i+1;
                @endphp
                <option value=" {{ $i }} - {{ $i+1 }}" {{ (isset($jobDetails->salary_range) && $jobDetails->salary_range == $val) ? 'selected' : '' }}>{{ $i }} - {{ $i+1 }}</option>
                @endfor
                <option value="30 +" {{ (isset($jobDetails->salary_range) && $jobDetails->salary_range == '30 +') ? 'selected' : '' }}>30 +</option>
              </select> -->
              <div class="input-group mb-3">
                <span class="input-group-text">₹</span>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="salary_range" id="salary_range" tabindex="12" data-error="#error_salary_range" max="100000"  value="{{ isset($jobDetails->salary_range) ? $jobDetails->salary_range : '' }}">
                <span class="input-group-text">/ Month</span>
              </div>
              <span class="error" id="error_salary_range"></span>
            </div>
            <div class="col-md-6">
              <label for="vacancy" class="form-label">Vacancy<span class="text-danger">*</span></label>
              <input type="number" min="1" max="500" maxlength="3"  class="form-control" name="vacancy" placeholder="Enter Vacancy" tabindex="13" value="{{ isset($jobDetails->vacancy) ? $jobDetails->vacancy : '' }}">
              <span class="error" id="error_vacancy"></span>
            </div>
            <div class="col-md-6">
              <label for="deadline" class="form-label">Deadline </label>
              <input type="date" class="form-control" name="deadline" min="{{ date('Y-m-d') }}" placeholder="Select Deadline" tabindex="14" value="{{ isset($jobDetails->deadline) ? $jobDetails->deadline : '' }}">
              <span class="error" id="error_deadline"></span>
            </div>
            <div class="col-md-6">
              <label for="gender" class="form-label">Gender </label>
              <select class="form-select js-example-basic-single" name="gender" data-error="#error_gender" tabindex="15">
                <option value="">Select</option>
                @foreach($gender as $row)
                <option value="{{ $row }}" {{ (isset($jobDetails->gender) && $jobDetails->gender == $row) ? 'selected' : '' }}>{{ getGender($row) }}</option>
                @endforeach
              </select>
              <span class="error" id="error_gender"></span>
            </div>
            <div class="col-md-6">
              <label for="english_level" class="form-label">English Level </label>
              <select class="form-select js-example-basic-single" name="english_level" data-error="#error_english_level" tabindex="16">
                <option value="">Select</option>
                @foreach($englishLevel as $row)
                <option value="{{ $row }}" {{ (isset($jobDetails->english_level) && $jobDetails->english_level == $row) ? 'selected' : '' }}>{{ englishLevel($row) }}</option>
                @endforeach
              </select>
              <span class="error" id="error_english_level"></span>
            </div>
            <div class="col-md-12">
              <label for="inputEmail5" class="form-label">Skills</label>
              <select class="form-select js-example-basic-single" data-error="#error_skills" multiple="multiple" name="skills[]" data-placeholder="Select" tabindex="17">
                <option value="">Select</option>
                @foreach($skills as $row)
                <option value="{{ $row->id }}" {{ (isset($jobDetails->skills) && $jobDetails->skills != '' && in_array($row->id, explode(',', $jobDetails->skills))) ? 'selected' : '' }}>{{ $row->name }}</option>
                @endforeach
              </select>
              <span class="error" id="error_skills"></span>
            </div>
            <div class="col-md-6">
              <label for="job_description" class="form-label">Job Description<span class="text-danger">*</span></label>
              <textarea class="basic-example" name="job_description" tabindex="18">{{ isset($jobDetails->job_description) ?  $jobDetails->job_description  : '' }}</textarea>
              <span class="error" id="error_job_description"></span>
            </div>
            <div class="col-md-6">
              <label for="job_responsibility" class="form-label">Job Responsibility </label>
              <textarea class="basic-example" name="job_responsibility" tabindex="19">{{ isset($jobDetails->job_responsibility) ?  $jobDetails->job_responsibility  : '' }}</textarea>
              <span class="error" id="error_job_responsibility"></span>
            </div>
            <div class="col-md-6">
              <label for="educational_requirements" class="form-label">Educational Requirements </label>
              <textarea class="basic-example" name="educational_requirements" tabindex="20">{{ isset($jobDetails->educational_requirements) ?  $jobDetails->educational_requirements  : '' }}</textarea>
              <span class="error" id="error_educational_requirements"></span>
            </div>
            <div class="col-md-6">
              <label for="other_benefits" class="form-label">Other Benefits</label>
              <textarea class="basic-example" name="other_benefits" tabindex="21">{{ isset($jobDetails->other_benefits) ?  $jobDetails->other_benefits  : '' }}</textarea>
              <span class="error" id="error_other_benefits"></span>
            </div>
            <div class="col-md-12 mt">
              <input type="hidden" name="jobId" id="jobId" value="{{ isset($jobDetails->id) ? $jobDetails->id : 0 }}" />
              <button type="submit" class="btn btn-primary" tabindex="22">{{ isset($jobDetails->id) ? 'Update' : 'Save' }}</button>
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
  $("#work_type_id").change(function() {

    var work_type_id = $("#work_type_id").val();
    if (work_type_id == 1) {
      $(".location").html('');
      $("#country_id").val('').trigger('change');
      $("#state_id").val('').trigger('change');
      $("#city_id").val('').trigger('change');
    } else {
      $(".location").html('*');
    }
  });

  tinymce.init({
    selector: 'textarea.basic-example',
    height: 200,
    menubar: false,
    plugins: "advlist autolink lists link image charmap print preview anchor','searchreplace visualblocks code fullscreen','insertdatetime media table paste code help wordcount",
    toolbar: 'formatselect | undo redo | numlist bullist | bold italic | alignleft aligncenter | alignright alignjustify'
  });

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
</script>
@endsection