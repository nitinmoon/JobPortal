@extends('frontend.layouts.app')

@section('title', 'Company Job Post')

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
                                <h5 class="font-weight-700 float-start text-uppercase page-heading">{{ isset($jobDetails->id) ? 'Edit Post Job' : 'Post A Job' }}</h5>
                                <a href="{{ route('companyProfile') }}" class="site-button right-arrow button-sm float-end"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                            <form id="jobForm" action="{{ route('addUpdateJob') }}" method="POST">
                                @csrf
                                <input type="hidden" name="jobId" value="{{ isset($jobDetails->id) ? $jobDetails->id : '0' }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input type="text" class="form-control" name="job_title" placeholder="Enter Job Title" value="{{ isset($jobDetails->job_title) ? $jobDetails->job_title : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <select class="form-control select2" name="designation_id" id="designation_id" data-error="#error_designation_id" data-live-search="true">
                                                <option value="">Select Designation</option>
                                                @foreach($designations as $designation)
                                                <option value="{{ $designation->id }}" {{ isset($jobDetails->designation_id) && $jobDetails->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_designation_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Category</label>
                                            <select class="form-control select2" name="job_category_id" id="job_category_id" data-error="#error_job_category_id" data-live-search="true">
                                                <option value="">Select Job Category</option>
                                                @foreach($jobCategories as $jobCategory)
                                                <option value="{{ $jobCategory->id }}" {{ isset($jobDetails->job_category_id) && $jobDetails->job_category_id == $jobCategory->id ? 'selected' : '' }}>{{ $jobCategory->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_job_category_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <select class="form-control select2" name="job_type_id" id="job_type_id" data-error="#error_job_type_id" data-live-search="true">
                                                <option value="">Select Job Type</option>
                                                @foreach($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}" {{ isset($jobDetails->job_type_id) && $jobDetails->job_type_id == $jobType->id ? 'selected' : '' }}>{{ $jobType->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_job_type_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Work Type</label>
                                            <select class="form-control select2" name="work_type_id" id="work_type_id" data-error="#error_work_type_id" data-live-search="true">
                                                <option value="">Select Work Type</option>
                                                @foreach(getJobWorkType() as $workType)
                                                <option value="{{ $workType->id }}" {{ isset($jobDetails->work_type_id) && $jobDetails->work_type_id == $workType->id ? 'selected' : '' }}>{{ $workType->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_work_type_id"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Tags</label>
                                            <select class="form-control job_tags-select" multiple="multiple" name="job_tags[]" id="job_tags" data-error="#error_job_tags" style="width:100% !important;">
                                                @if (isset($tags))
                                                <option value="">Select Tags</option>
                                                @foreach($tags as $tag)
                                                <option value="{{ $skill->id }}" {{ isset($skill->id) && $skill->id == $location->id ? 'selected' : '' }}>{{ $skill->location }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span class="error" id="error_job_tags"></span>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Skills <i class="text-warning">(Enter / Select your skills)</i></label>
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
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <select class="form-control select2" name="experience" id="experience" data-error="#error_experience" data-live-search="true">
                                                <option value="">Select Experience</option>
                                                @foreach($experienceOptions as $experience)
                                                <option value="{{ $experience }}" {{ isset($jobDetails->experience) && $jobDetails->experience == $experience ? 'selected' : '' }}>{{ $experience }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_experience"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Salary Range <i class="text-warning">(₹ / P.A.)</i></label>
                                            <select class="form-control select2" name="salary_range" id="salary_range" data-error="#error_salary_range" data-live-search="true">
                                                <option value="">Select Experience</option>
                                                @foreach($salaryRangeOptions as $range)
                                                <option value="{{ $range }}" {{ isset($jobDetails->salary_range) && $jobDetails->salary_range == $range ? 'selected' : '' }}>{{ $range }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_salary_range"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-4 col-md-4">
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
                                    </div> -->
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Vacancy</label>
                                            <input type="text" name="vacancy" class="form-control" placeholder="Enter No. of Vacancy" value="{{ isset($jobDetails->vacancy) ? $jobDetails->vacancy : '' }}">
                                            <span class="error" id="error_vacancy"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Deadline</label>
                                            <input type="date" name="deadline" class="form-control" placeholder="Enter Deadline" min="{{ date('Y-m-d') }}" value="{{ isset($jobDetails->deadline) ? $jobDetails->deadline : '' }}">
                                            <span class="error" id="error_deadline"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Gender </label>
                                            <select class="form-control" name="gender" data-error="#error_gender">
                                                <option value="">Select Gender</option>
                                                @foreach($genders as $gender)
                                                <option value="{{ $gender }}" {{ isset($jobDetails->gender) && $jobDetails->gender == $gender ? 'selected' : '' }}>{{ getJobGender($gender) }}</option>
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
                                                <option value="{{ $level }}" {{ isset($jobDetails->english_level) && $jobDetails->english_level == $level ? 'selected' : '' }}>{{ englishLevel($level) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_english_level"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Description</label>
                                            <textarea class="form-control basic-example" name="job_description" tabindex="18">
                                                {!! isset($jobDetails->job_description) ? $jobDetails->job_description : '' !!}
                                            </textarea>
                                            <span class="error" id="error_job_description"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Responsibility</label>
                                            <textarea class="form-control basic-example" name="job_responsibility" tabindex="18">
                                                {!! isset($jobDetails->job_responsibility) ? $jobDetails->job_responsibility : '' !!}
                                            </textarea>
                                            <span class="error" id="error_job_responsibility"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Educational Requirements</label>
                                            <textarea class="form-control basic-example" name="educational_requirements" tabindex="18">
                                                {!! isset($jobDetails->educational_requirements) ? $jobDetails->educational_requirements : '' !!}
                                            </textarea>
                                            <span class="error" id="error_educational_requirements"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Other Benefits <i class="text-warning">(Facilities)</i></label>
                                            <textarea class="form-control basic-example" name="other_benefits" tabindex="18">
                                                {!! isset($jobDetails->other_benefits) ? $jobDetails->other_benefits : '' !!}
                                            </textarea>
                                            <span class="error" id="error_other_benefits"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control selectpicker" name="country_id" id="country_id" data-error="#error_country_id" data-live-search="true">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $row)
                                                <option value="{{ $row->id }}" {{ (isset($jobDetails->country_id) && $jobDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_country_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select class="form-control selectpicker" name="state_id" id="state_id" data-error="#error_state_id" data-live-search="true">
                                                @if(isset($states))
                                                @if(count($states) > 0)
                                                @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ isset($jobDetails->state_id) && ($state->id == $jobDetails->state_id) ? 'selected' : '' }}>{{$state->name}}</option>
                                                @endforeach
                                                @else
                                                <option value="">Select State</option>
                                                @endif
                                                @else
                                                <option value="">Select State</option>
                                                @endif
                                            </select>
                                            <span class="error" id="error_state_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control selectpicker" name="city_id" id="city_id" data-error="#error_city_id" data-live-search="true">
                                                @if(isset($cities))
                                                @if(count($states) > 0)
                                                @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ isset($jobDetails->city_id) && ($city->id == $jobDetails->city_id) ? 'selected' : '' }}>{{$city->name}}</option>
                                                @endforeach
                                                @else
                                                <option value="">Select City</option>
                                                @endif
                                                @else
                                                <option value="">Select City</option>
                                                @endif
                                            </select>
                                            <span class="error" id="error_city_id"></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="site-button m-b30"> {{ isset($jobDetails->id) ? 'Update' : 'Submit' }}</button>
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
        let pageHeading = $('.page-heading').html();
        $('#postJobText').html(pageHeading);
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

        $(".skills-select, .job_tags-select").select2({
            tags: true,
            placeholder: " Enter / Select your skills",
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