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
                                <h5 class="font-weight-700 float-start text-uppercase">Company Profile</h5>
                                <a href="{{ route('myProfile') }}" class="site-button right-arrow button-sm float-end">Back</a>
                            </div>
                            <form id="companyProfileForm" class="row g-3 mt-2" action="{{ route('updateCompanyProfile') }}" method="post">
                                @csrf
                                <div class="row m-b30">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" name="company_name" value="{{ isset($employerDetails->company_name) ? $employerDetails->company_name : '' }}" placeholder="Enter Company Name">
                                            <span class="error" id="error_company_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Company Website</label>
                                            <input type="text" class="form-control" name="company_website" value="{{ isset($employerDetails->company_website) ? $employerDetails->company_website : '' }}" placeholder="Enter Company Website">
                                            <span class="error" id="error_company_website"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Company Contact Person</label>
                                            <input type="text" class="form-control" name="company_contact_person" value="{{ isset($employerDetails->company_contact_person) ? $employerDetails->company_contact_person : '' }}" placeholder="Enter Company contact person">
                                            <span class="error" id="error_company_contact_person"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Company Contact Email</label>
                                            <input type="text" class="form-control" name="company_contact_email" value="{{ isset($employerDetails->company_contact_email) ? $employerDetails->company_contact_email : '' }}" placeholder="Enter Company Contact Email">
                                            <span class="error" id="error_company_contact_email"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Company Contact Phone</label>
                                            <input type="text" class="form-control" id="company_contact_no" name="company_contact_no" maxlength="10" value="{{ isset($employerDetails->company_contact_no) ? $employerDetails->company_contact_no : '' }}" placeholder="Enter Company Contact Phone">
                                            <span class="error" id="error_company_contact_no"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Job Category</label>
                                            <select class="form-control select2" name="job_category_id" id="job_category_id" data-error="#error_job_category_id">
                                                <option value="">Select</option>
                                                @foreach($jobCategories as $category)
                                                <option value="{{ $category->id }}" {{ isset($employerDetails->job_category_id) && $employerDetails->job_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_job_category_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Foundation Date</label>
                                            <input type="date" class="form-control" name="foundation_date" placeholder="Enter Foundation Date" value="{{ isset($employerDetails->foundation_date) ? $employerDetails->foundation_date : '' }}" min="1940-01-01" max="">
                                            <span class="error" id="error_foundation_date"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>No Of Employee</label>
                                            <input type="text" id="no_of_employees" class="form-control" name="no_of_employees" value="{{ isset($employerDetails->no_of_employees) ? $employerDetails->no_of_employees : '' }}" placeholder="Enter No Of Employee">
                                            <span class="error" id="error_no_of_employees"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>GST Number</label>
                                            <input type="text" class="form-control" name="gst_no" value="{{ isset($employerDetails->gst_no) ? $employerDetails->gst_no : '' }}" placeholder="Enter GST Number" value="">
                                            <span class="error" id="error_gst_no"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Company Description</label>
                                            <textarea class="form-control basic-example" name="company_description" placeholder="Company Description">{!! isset($employerDetails->company_description) ? $employerDetails->company_description : '' !!}</textarea>
                                            <span class="error" id="error_company_description"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Company Address -->
                                <div class="job-bx-title clearfix">
                                    <h5 class="font-weight-700 float-start text-uppercase">Company Address</h5>
                                </div>
                                <div class="row m-b30">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Contry</label>
                                            <select class="form-control selectpicker" name="country_id" id="country_id" data-error="#error_country_id" data-live-search="true">
                                                <option value="">Select</option>
                                                @foreach($countries as $row)
                                                <option value="{{ $row->id }}" {{ (isset($employerDetails->country_id) && $employerDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_country_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select class="form-control selectpicker" name="state_id" id="state_id" data-error="#error_state_id" data-live-search="true">
                                                @if(isset($employerDetails->id))
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
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control selectpicker" name="city_id" id="city_id" data-error="#error_city_id" data-live-search="true">
                                                @if(isset($employerDetails->id))
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
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Zip</label>
                                            <input type="text" class="form-control" name="zip" id="zip" maxlength="6" value="{{ isset($employerDetails->zip) ? $employerDetails->zip : '' }}" placeholder="Enter Zip">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Company Address</label>
                                            <textarea class="form-control" placeholder="New york city" name="company_address">{{ isset($employerDetails->company_address) ? $employerDetails->company_address : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d57784.32772205062!2d75.85546240000001!3d25.151897599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1545138498580" style="border:0; width: 100%; height:300px;" allowfullscreen></iframe>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="employerId" id="employerId" value="{{ isset($employerDetails->id) ? $employerDetails->id : '0' }}">
                                        <button type="submit" class="site-button m-b30">Update</button>
                                    </div>
                                </div>
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
<script src="{{ asset('frontend/assets/js/custom-js/profile.js') }}"></script>
<script>
    $(function() {
        tinymce.init({
            selector: 'textarea.basic-example',
            height: 200,
            menubar: false,
            plugins: "advlist autolink lists link image charmap print preview anchor','searchreplace visualblocks code fullscreen','insertdatetime media table paste code help wordcount",
            toolbar: 'formatselect | undo redo | numlist bullist | bold italic | alignleft aligncenter | alignright alignjustify'
        });

        $('#country_id').on('changed.bs.select', function() {
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
                success: function(data) {
                    $.each(data.state, function(index, value) {
                        $('#state_id').append(`<option value="${value['id']}">${value['name']}</option>`);
                    });

                    $('#state_id').selectpicker('refresh');
                    $('#city_id').selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    console.error("Error loading states:", error);
                }
            });
        });

        $("#state_id").change(function() {
            var stateId = $(this).val();

            $("#city_id").empty();

            $.ajax({
                url: "{{ route('getCity') }}",
                dataType: "json",
                data: {
                    stateId: stateId
                },
                success: function(data) {
                    console.log(data);
                    var $option = "<option value=''>Select City</option>";

                    $.each(data.city, function(index, value) {
                        $option += "<option value='" + value['id'] + "'>" + value['name'] + "</option>";
                    });

                    $("#city_id").append($option);

                    $('#city_id').selectpicker('refresh');
                }
            });
        });
    });
</script>
@endsection