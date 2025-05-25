@extends('backend.layouts.app')
@php $title = isset($jobDetails->id) ? 'Edit Job' : 'Add Job'; @endphp
@section('title', $title)
@section('content')
<div class="pagetitle">
  <h1>{{ $title }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('jobsList') }}">Jobs</a></li>
      <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body mt-2">
          <form id="jobForm" class="row g-3 mt-2" action="{{ route('adminAddUpdateJob') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jobId" value="{{ isset($jobDetails->id) ? $jobDetails->id : 0 }}">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Employer</label>
                  <select class="form-select select2" name="employer_id" id="employer_id" data-error="#error_employer_id">
                    <option value="">Select</option>
                    @foreach($employers as $employer)
                    <option value="{{ $employer->id }}" {{ isset($jobDetails->employer_id) && $jobDetails->employer_id == $employer->id ? 'selected' : '' }}>{{ $employer->first_name.' '.$employer->last_name }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_employer_id"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Job Title</label>
                  <input type="text" class="form-control" name="job_title" value="{{ isset($jobDetails->job_title) ? $jobDetails->job_title : '' }}" placeholder="Enter Job Title">
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Designation</label>
                  <select class="form-select select2" name="designation_id" id="designation_id" data-error="#error_designation_id">
                    <option value="">Select</option>
                    @foreach($designations as $designation)
                    <option value="{{ $designation->id }}" {{ isset($jobDetails->designation_id) && $jobDetails->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_designation_id"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Job Category</label>
                  <select class="form-control select2" name="job_category_id" id="job_category_id" data-error="#error_job_category_id">
                    <option value="">Select</option>
                    @foreach($jobCategories as $jobCategory)
                    <option value="{{ $jobCategory->id }}" {{ isset($jobDetails->job_category_id) && $jobDetails->job_category_id == $jobCategory->id ? 'selected' : '' }}>{{ $jobCategory->name }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_job_category_id"></span>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Job Type</label>
                  <select class="form-control select2" name="job_type_id" id="job_type_id" data-error="#error_job_type_id">
                    <option value="">Select</option>
                    @foreach($jobTypes as $jobType)
                    <option value="{{ $jobType->id }}" {{ isset($jobDetails->job_type_id) && $jobDetails->job_type_id == $jobType->id ? 'selected' : '' }}>{{ $jobType->name }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_job_type_id"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Work Type</label>
                  <select class="form-control select2" name="work_type_id" id="work_type_id" data-error="#error_work_type_id">
                    <option value="">Select</option>
                    @foreach(getJobWorkType() as $workType)
                    <option value="{{ $workType->id }}" {{ isset($jobDetails->work_type_id) && $jobDetails->work_type_id == $workType->id ? 'selected' : '' }}>{{ $workType->name }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_work_type_id"></span>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Skills <i class="text-warning">(Enter / Select your skills)</i></label>
                  <select class="form-control skills-select" multiple="multiple" name="skills[]" id="skills" data-error="#error_skills" data-placeholder="Enter your skills" style="width:100% !important;">
                      @if (isset($skills))
                      <option value="">Select skills</option>
                      @foreach($skills as $skill)
                      <option value="{{ $skill->name }}" {{ (isset($jobDetails->skills) && $jobDetails->skills != '' && in_array($skill->id, explode(',', $jobDetails->skills))) ? 'selected' : '' }}>{{ $skill->name }}</option>
                      @endforeach
                      @endif
                  </select>
                  <span class="error" id="error_skills"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  @php
                    $experienceOptions = [
                      '0 - 1 Years',
                      '1 - 3 Years',
                      '3 - 5 Years',
                      '5 - 7 Years',
                      'Above 7+'
                    ];
                  @endphp
                  <label class="form-label">Experience</label>
                  <select class="form-control" name="experience" id="experience" data-error="#error_experience">
                    @foreach ($experienceOptions as $option)
                      <option value="{{ $option }}" {{ (isset($jobDetails->experience) && $jobDetails->experience == $option) ? 'selected' : '' }}>
                        {{ $option }}
                      </option>
                    @endforeach
                  </select>
                  <span class="error" id="error_experience"></span>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  @php
                    $salaryRangeOptions = [
                      '1 - 2 Lacs',
                      '2 - 3 Lacs',
                      '3 - 4 Lacs',
                      '4 - 5 Lacs',
                      '5 - 6 Lacs',
                      '6 - 7 Lacs',
                      '7 - 8 Lacs',
                      '8 - 9 Lacs',
                      '9 - 10 Lacs',
                      '10 - 15 Lacs',
                      'Above 15+'
                    ];
                  @endphp
                  <label class="form-label">Salary Range <i class="text-warning">(₹ / P.A.)</i></label>
                  <select class="form-control" name="salary_range" id="salary_range" data-error="#error_salary_range">
                    <option value="">Select Salary Range</option>
                      @foreach ($salaryRangeOptions as $salary)
                        <option value="{{ $salary }}" {{ (isset($jobDetails->salary_range) && $jobDetails->salary_range == $salary) ? 'selected' : '' }}>
                          {{ $salary }}
                        </option>
                      @endforeach
                  </select>
                  <span class="error" id="error_salary_range"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Vacancy</label>
                  <input type="text" name="vacancy" value="{{ isset($jobDetails->vacancy) ? $jobDetails->vacancy : '' }}" class="form-control tags_input" />
                  <span class="error" id="error_vacancy"></span>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                      <label>Deadline</label>
                      <input type="date" name="deadline" value="{{ isset($jobDetails->deadline) ? $jobDetails->deadline : '' }}" class="form-control" placeholder="Enter Deadline" min="{{ date('Y-m-d') }}">
                      <span class="error" id="error_deadline"></span>
                  </div>
              </div>
              <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                      <label>Gender </label>
                      <select class="form-control" name="gender" data-error="#error_gender">
                          <option value="">Select Gender</option>
                          @foreach($genders as $gender)
                          <option value="{{ $gender }}" {{ (isset($jobDetails->gender) && $jobDetails->gender == $gender) ? 'selected' : '' }}>{{ getJobGender($gender) }}</option>
                          @endforeach
                      </select>
                      <span class="error" id="error_gender"></span>
                  </div>
              </div>
              <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                      <label>English Level</label>
                      <select class="form-control" name="english_level" data-error="#error_english_level">
                          <option value="">Select English Level</option>
                          @foreach($englishLevels as $level)
                          <option value="{{ $level }}"  {{ (isset($jobDetails->english_level) && $jobDetails->english_level == $level) ? 'selected' : '' }}>{{ englishLevel($level) }}</option>
                          @endforeach
                      </select>
                      <span class="error" id="error_english_level"></span>
                  </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label>Job Description</label>
                      <textarea class="form-control basic-example" name="job_description" tabindex="18">{!! isset($jobDetails->job_description) ? $jobDetails->job_description : '' !!}</textarea>
                      <span class="error" id="error_job_description"></span>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label>Job Responsibility</label>
                      <textarea class="form-control basic-example" name="job_responsibility" tabindex="18">{!! isset($jobDetails->job_responsibility) ? $jobDetails->job_responsibility : '' !!}</textarea>
                      <span class="error" id="error_job_responsibility"></span>
                  </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label>Educational Requirements</label>
                      <textarea class="form-control basic-example" name="educational_requirements" tabindex="18">{!! isset($jobDetails->educational_requirements) ? $jobDetails->educational_requirements : '' !!}</textarea>
                      <span class="error" id="error_educational_requirements"></span>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label>Other Benefits <i class="text-warning">(Facilities)</i></label>
                      <textarea class="form-control basic-example" name="other_benefits" tabindex="18">{!! isset($jobDetails->other_benefits) ? $jobDetails->other_benefits : '' !!}</textarea>
                      <span class="error" id="error_other_benefits"></span>
                  </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-lg-4 col-md-4">
                <div class="form-group">
                  <label class="form-label">Country</label>
                  <select class="form-control selectpicker" name="country_id" id="country_id" data-error="#error_country_id">
                    <option value="">Select</option>
                    @foreach($countries as $row)
                    <option value="{{ $row->id }}" {{ (isset($jobDetails->country_id) && $jobDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_country_id"></span>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group">
                  <label class="form-label">State</label>
                  <select class="form-control selectpicker" name="state_id" id="state_id" data-error="#error_state_id">
                    @if(isset($states))
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
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group">
                  <label class="form-label">City</label>
                  <select class="form-control selectpicker" name="city_id" id="city_id" data-error="#error_city_id">
                    @if(isset($cities))
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
              </div>
            </div>
            <div class="row">
              <!-- <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>Upload File</label>
                  <div class="custom-file">
                      <input type="file" class="site-button form-control" name="upload_file" id="customFile">
                  </div>
                </div>
              </div> -->
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>Upload File</label>

                  @if (!empty($jobDetails->upload_file))
                    <div class="input-group mb-2">
                      <input type="text" class="form-control" value="{{ $jobDetails->upload_file }}" readonly>
                      <div class="input-group-append">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileViewModal">
                          View
                        </button>
                      </div>
                    </div>
                  @endif

                  <div class="custom-file">
                    <input type="file" class="form-control" name="upload_file" id="customFile">
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 text-end">
                  <button type="submit" class="btn btn-primary submitBtn mt-3">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@if (!empty($jobDetails->upload_file))
<!-- File View Modal -->
<div class="modal fade" id="fileViewModal" tabindex="-1" role="dialog" aria-labelledby="fileViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fileViewModalLabel">Uploaded File Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        @php
          $fileExtension = pathinfo($jobDetails->upload_file, PATHINFO_EXTENSION);
          $fileUrl = asset('uploads/files/' . $jobDetails->upload_file);
        @endphp

        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
          <img src="{{ $fileUrl }}" alt="Uploaded File" class="img-fluid">
        @elseif (in_array($fileExtension, ['pdf']))
          <embed src="{{ $fileUrl }}" type="application/pdf" width="100%" height="500px" />
        @else
          <p>File preview not available. <a href="{{ $fileUrl }}" target="_blank">Download instead</a></p>
        @endif
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/jobs.js') }}"></script>
<script>
  $(".skills-select, .job_tags-select").select2({
      tags: true,
      placeholder: " Enter / Select your skills",
  });
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