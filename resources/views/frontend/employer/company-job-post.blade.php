@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="page-content">
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full bg-white p-t50 p-b20">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 m-b30">
                        <div class="sticky-top">
                            @include('frontend.employer.sidebar')
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 m-b30">
                        <div class="job-bx submit-resume">
                            <div class="job-bx-title clearfix">
                                <h5 class="font-weight-700 float-start text-uppercase">Post A Job</h5>
                                <a href="{{ route('companyProfile') }}" class="site-button right-arrow button-sm float-end">Back</a>
                            </div>
                            <form id="jobForm" action="{{ route('addUpdateJob') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jobId" value="0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input type="text" class="form-control" name="job_title" placeholder="Enter Job Title">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <select class="form-control select2" name="designation_id" id="designation_id" data-error="#error_designation_id">
                                                <option value="">Select</option>
                                                @foreach($designations as $designation)
                                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_designation_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Category</label>
                                            <select class="form-control select2" name="job_category_id" id="job_category_id" data-error="#error_job_category_id">
                                                <option value="">Select</option>
                                                @foreach($jobCategories as $jobCategory)
                                                <option value="{{ $jobCategory->id }}">{{ $jobCategory->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_job_category_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <select class="form-control select2" name="job_type_id" id="job_type_id" data-error="#error_job_type_id">
                                                <option value="">Select</option>
                                                @foreach($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_job_type_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Work Type</label>
                                            <select class="form-control select2" name="work_type_id" id="work_type_id" data-error="#error_work_type_id">
                                                <option value="">Select</option>
                                                @foreach(getJobWorkType() as $workType)
                                                <option value="{{ $workType->id }}">{{ $workType->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_work_type_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Tags</label>
                                            <input type="text" name="job_tags" value="" class="form-control tags_input" />
                                            <span class="error" id="error_job_tags"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <select name="experience" id="experience" data-error="#error_experience">
                                                <option value="0 - 1 Years">0 - 1 Years</option>
                                                <option value="1 - 3 Years">1 - 3 Years</option>
                                                <option value="3 - 5 Years">3 - 5 Years</option>
                                                <option value="5 - 7 Years">5 - 7 Years</option>
                                                <option value="Above 7+">Above 7+</option>
                                            </select>
                                            <span class="error" id="error_experience"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Minimum Salary ($):</label>
                                            <input type="text" class="form-control" name="min_salary" placeholder="e.g. 10000">
                                            <span class="error" id="error_min_salary"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Maximum Salary ($):</label>
                                            <input type="text" class="form-control" name="max_salary" placeholder="e.g. 20000">
                                            <span class="error" id="error_max_salary"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Vacancy</label>
                                            <input type="text" name="vacancy" class="form-control" placeholder="Enter No of vacancy">
                                            <span class="error" id="error_vacancy"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Skills</label>
                                            <select class="form-control skills-select" multiple="multiple" name="skills[]" id="skills" data-error="#error_skills" style="width:100% !important;">
                                                @if (isset($skills))
                                                <option value="">Select skills</option>
                                                @foreach($skills as $skill)
                                                <option value="{{ $skill->id }}" {{ isset($skill->id) && $skill->id == $location->id ? 'selected' : '' }}>{{ $skill->location }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span class="error" id="error_skills"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Deadline</label>
                                            <input type="date" name="deadline" class="form-control" placeholder="Enter Deadline">
                                            <span class="error" id="error_deadline"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Gender </label>
                                            <select class="form-control" name="gender" data-error="#error_gender">
                                                <option value="">Select</option>
                                                @foreach($genders as $gender)
                                                <option value="{{ $gender }}">{{ getGender($gender) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_gender"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>English Level</label>
                                            <select class="form-control" name="english_level" data-error="#error_english_level">
                                                <option value="">Select</option>
                                                @foreach($englishLevels as $level)
                                                <option value="{{ $level }}">{{ englishLevel($level) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_english_level"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Description</label>
                                            <textarea class="form-control basic-example" name="job_description" tabindex="18"></textarea>
                                            <span class="error" id="error_job_description"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Responsibility</label>
                                            <textarea class="form-control basic-example" name="job_responsibility" tabindex="18"></textarea>
                                            <span class="error" id="error_job_responsibility"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Educational Requirements</label>
                                            <textarea class="form-control basic-example" name="educational_requirements" tabindex="18"></textarea>
                                            <span class="error" id="error_educational_requirements"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Other Benefits</label>
                                            <textarea class="form-control basic-example" name="other_benefits" tabindex="18"></textarea>
                                            <span class="error" id="error_other_benefits"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control selectpicker" name="country_id" id="country_id" data-error="#error_country_id">
                                                <option value="">Select</option>
                                                @foreach($countries as $row)
                                                <option value="{{ $row->id }}" {{ (isset($employerDetails->country_id) && $employerDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_country_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select class="form-control selectpicker" name="state_id" id="state_id" data-error="#error_state_id">
                                                @if(isset($states))
                                                @if(count($states) > 0)
                                                @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ isset($employerDetails->state_id) && ($state->id == $employerDetails->state_id) ? 'selected' : '' }}>{{$state->name}}</option>
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
                                            <label>City</label>
                                            <select class="form-control selectpicker" name="city_id" id="city_id" data-error="#error_city_id">
                                                @if(isset($cities))
                                                @if(count($states) > 0)
                                                @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ isset($employerDetails->city_id) && ($city->id == $employerDetails->city_id) ? 'selected' : '' }}>{{$city->name}}</option>
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
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Upload File</label>
                                            <div class="custom-file">
                                                <p class="m-a0">
                                                    <i class="fa fa-upload"></i>
                                                    Upload File
                                                </p>
                                                <input type="file" class="site-button form-control" name="upload_file" id="customFile">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="site-button m-b30">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('frontend/assets/js/custom-js/job.js') }}"></script>
<script>
    $(function() {
        $('#country_id').on('changed.bs.select', function () {
            var countryId = $(this).val();

            $('#state_id').empty().append('<option value="">Select State</option>');
            $('#city_id').empty().append('<option value="">Select City</option>');

            $.ajax({
                url: "{{ route('getState') }}",
                type: "GET",
                dataType: "json",
                data: {
                    countryId: countryId
                },
                success: function (data) {
                    $.each(data.state, function (index, value) {
                        $('#state_id').append(`<option value="${value['id']}">${value['name']}</option>`);
                    });

                    $('#state_id').selectpicker('refresh');
                    $('#city_id').selectpicker('refresh');
                },
                error: function (xhr, status, error) {
                    console.error("Error loading states:", error);
                }
            });
        });

        $("#state_id").change(function () {
            var stateId = $(this).val();

            $("#city_id").empty();

            $.ajax({
                url: "{{ route('getCity') }}",
                dataType: "json",
                data: {
                    stateId: stateId
                },
                success: function (data) {
                    console.log(data);
                    var $option = "<option value=''>Select City</option>";

                    $.each(data.city, function (index, value) {
                        $option += "<option value='" + value['id'] + "'>" + value['name'] + "</option>";
                    });

                    $("#city_id").append($option);

                    $('#city_id').selectpicker('refresh');
                }
            });
        });

        $(".skills-select").select2({
            tags: true,
        });

        tinymce.init({
            selector: 'textarea.basic-example',
            height: 200,
            menubar: false,
            plugins: "advlist autolink lists link image charmap print preview anchor','searchreplace visualblocks code fullscreen','insertdatetime media table paste code help wordcount",
            toolbar: 'formatselect | undo redo | numlist bullist | bold italic | alignleft aligncenter | alignright alignjustify'
        });
    });
</script>
@endsection