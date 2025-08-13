@extends('frontend.layouts.app')

@php $jobId = isset($_GET['jobId']) ? base64_decode($_GET['jobId']) : ''; @endphp

@section('title', 'Candidate Profile')

@section('content')
<div class="page-content">
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full bg-white p-t50 p-b20">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 m-b30">
                        <div class="sticky-top">
                            @include('frontend.candidate.sidebar')
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 m-b30">
                        <div class="job-bx submit-resume">
                            <div class="job-bx-title clearfix">
                                <div class="row viewRow {{ isset($flag) && $flag == 'apply-job' ? 'd-none' : '' }}">
                                    <div class="col-md-9">
                                        <h6 class="float-start text-uppercase">Basic Information</h6>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <a class="btn btn-sm btn-primary btn-blue" id="edit-profile" title="Edit Profile">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('candidateProfile') }}" class="site-button right-arrow button-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                    </div>
                                </div>
                                <div class="row {{ isset($flag) && $flag == 'apply-job' ? '' : 'd-none' }} editRow">
                                    <div class="col-md-9">
                                        <h6 class="float-start text-uppercase">Edit Information</h6>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <a class="btn btn-sm btn-warning btn-blue" id="view-profile" title="View Profile">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('candidateProfile') }}" class="site-button right-arrow button-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive {{ isset($flag) && $flag == 'apply-job' ? 'd-none' : '' }} viewProfileRow">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Full Name: </th>
                                            <td>{{ isset($userDetails->first_name) ? getTitle($userDetails->title) .' '. $userDetails->first_name .' '. $userDetails->middle_name .' '. $userDetails->last_name : '--'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Of Birth: </th>
                                            <td>{{ isset($userDetails->dob) ? date('d-m-Y', strtotime($userDetails->dob)) : '--'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender: </th>
                                            <td>{{ isset($userDetails->gender) ? getGender($userDetails->gender) : '--'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="job-bx-title clearfix {{ isset($flag) && $flag == 'apply-job' ? 'd-none' : '' }} viewProfileRow">
                                <h6 class="float-start text-uppercase">Contact Information</h5>
                            </div>
                            <div class="table-responsive {{ isset($flag) && $flag == 'apply-job' ? 'd-none' : '' }} viewProfileRow">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Email: </th>
                                            <td>{{ isset($userDetails->email) ? $userDetails->email : '--'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone: </th>
                                            <td>{{ isset($userDetails->phone) ? $userDetails->country_code.' '.$userDetails->phone : '--'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address: </th>
                                            <td>{{ isset($userDetails->address) ? $userDetails->address .', '. $userDetails->city_name .', '. $userDetails->state_name .', '. $userDetails->country_name .' - '. $userDetails->zip: '--'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Current Address: </th>
                                            <td>{{ isset($userDetails->current_address) ? $userDetails->current_address : '--'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <form id="myProfileForm" class="row g-3 mt-2 {{ isset($flag) && $flag == 'apply-job' ? '' : 'd-none' }} editProfileRow" action="{{ route('updateCandidateProfile') }}" method="post">
                                @csrf
                                <div class="row m-b30">
                                    @if(isset($flag) && $flag == 'apply-job' && isCandidateApplyJob(auth()->user()->id, $jobId) == '')
                                    <div class="col-md-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                            </symbol>
                                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                            </symbol>
                                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </symbol>
                                        </svg>
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                <b>Please ensure all your profile details are complete before applying for this job.</b>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label>Title<span class="error">*</span></label>
                                            <select class="form-control" name="title" id="title" data-error="#error_title">
                                                <option value="">Select</option>
                                                @foreach($title as $row)
                                                <option value="{{ $row }}" {{ isset($userDetails->title) && $userDetails->title == $row ? 'selected' : '' }}>{{ getTitle($row) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_title"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label>First Name<span class="error">*</span></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ isset($userDetails->first_name) ? $userDetails->first_name : '' }}" placeholder="Enter First Name">
                                        </div>
                                        <span class="error" id="error_first_name"></span>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ isset($userDetails->middle_name) ? $userDetails->middle_name : '' }}" placeholder="Enter Middle Name">
                                        </div>
                                        <span class="error" id="error_middle_name"></span>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label>Last Name<span class="error">*</span></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ isset($userDetails->last_name) ? $userDetails->last_name : '' }}" placeholder="Enter Last Name">
                                        </div>
                                        <span class="error" id="error_last_name"></span>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Date Of Birth<span class="error">*</span></label>
                                            <input type="date" class="form-control" name="dob" id="dob" placeholder="Enter Dob" value="{{ isset($userDetails->dob) ? $userDetails->dob : '' }}" min="1940-01-01" max="{{ date('Y-m-d', strtotime('-18 year', time())) }}">
                                        </div>
                                        <span class="error" id="error_dob"></span>
                                    </div>
                                    @php
                                        use Carbon\Carbon;
                                        $age = isset($userDetails->dob) ? Carbon::parse($userDetails->dob)->age : '';
                                    @endphp
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Age:(Year)</label>
                                            <input type="text" class="form-control" id="age" value="{{ $age }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Gender<span class="error">*</span></label>
                                            <select class="form-control" name="gender" id="gender" data-error="#error_gender">
                                                <option value="">Select</option>
                                                @foreach($genders as $gender)
                                                <option value="{{ $gender }}" {{ isset($userDetails->gender) && $userDetails->gender == $gender ? 'selected' : '' }}>{{ getGender($gender) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_gender"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Contact Information -->
                                <div class="job-bx-title clearfix">
                                    <h5 class="font-weight-700 float-start text-uppercase">Contact Information</h5>
                                </div>
                                <div class="row m-b30">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Email<span class="error">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ isset($userDetails->email) ? $userDetails->email : '' }}" placeholder="Enter Email">
                                        </div>
                                        <span class="error" id="error_email"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone<span class="error">*</span></label>
                                            <input type="tel" id="phone" name="phone_visible" class="form-control" value="{{ isset($userDetails->phone) ? $userDetails->phone : '' }}" placeholder="Enter phone number">
                                            <input type="hidden" name="phone" id="phone_hidden" value="{{ isset($userDetails->phone) ? $userDetails->phone : '' }}">
                                            <input type="hidden" name="country_code" id="country_code" value="{{ isset($userDetails->country_code) ? $userDetails->country_code : '' }}">
                                        </div>
                                        <span class="error" id="error_phone"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Country<span class="error">*</span></label>
                                            <select class="form-control selectpicker" name="country_id" id="country_id" data-error="#error_country_id" data-live-search="true">
                                                <option value="">Select</option>
                                                @foreach($countries as $row)
                                                <option value="{{ $row->id }}" {{ (isset($userDetails->country_id) && $userDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_country_id"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>State<span class="error">*</span></label>
                                            <select class="form-control selectpicker" name="state_id" id="state_id" data-error="#error_state_id" data-live-search="true">
                                                @if(isset($userDetails->id))
                                                @if(count($states) > 0)
                                                @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ isset($userDetails->state_id) && ($state->id == $userDetails->state_id) ? 'selected' : '' }}>{{$state->name}}</option>
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
                                            <label>City<span class="error">*</span></label>
                                            <select class="form-control selectpicker" name="city_id" id="city_id" data-error="#error_city_id" data-live-search="true">
                                                @if(isset($userDetails->id))
                                                @if(count($states) > 0)
                                                @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ isset($userDetails->city_id) && ($city->id == $userDetails->city_id) ? 'selected' : '' }}>{{$city->name}}</option>
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
                                            <label>Zip<span class="error">*</span></label>
                                            <input type="text" name="zip" id="zip" value="{{ isset($userDetails->zip) ? $userDetails->zip : '' }}" class="form-control" placeholder="Enter Zip" maxlength="6">
                                        </div>
                                        <span class="error" id="error_zip"></span>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Address<span class="error">*</span> </label>
                                            <textarea class="form-control" placeholder="Enter Address" name="address" id="address">{{ isset($userDetails->address) ? $userDetails->address : '' }}</textarea>
                                        </div>
                                        <span class="error" id="error_address"></span>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Current Address </label>
                                            <textarea class="form-control" placeholder="Enter Address" name="current_address" id="current_address">{{ isset($userDetails->current_address) ? $userDetails->current_address : '' }}</textarea>
                                        </div>
                                        <span class="error" id="error_current_address"></span>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d57784.32772205062!2d75.85546240000001!3d25.151897599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1545138498580" style="border:0; width: 100%; height:300px;" allowfullscreen></iframe>
                                    </div> -->
                                    <div class="col-lg-6">
                                        <input type="hidden" name="userId" value="{{ isset($userDetails->id) ? $userDetails->id : 0 }}" />
                                        @if(isset($flag) && $flag == 'apply-job' && isCandidateApplyJob(auth()->user()->id, $jobId) == '')
                                        <input type="hidden" name="flag" id="flag" value="{{ isset($flag) ? $flag : '' }}">
                                        <input type="hidden" name="job_id" id="job_id" value="{{ $jobId }}">
                                        <button type="submit" class="site-button m-b30">Send Application</button>
                                        @else
                                        <button type="submit" class="site-button m-b30">Save & Next</button>
                                        @endif
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
        $('#edit-profile').click(function() {
            $('.editRow').removeClass('d-none');
            $('.editProfileRow').removeClass('d-none');
            $('.viewProfileRow').addClass('d-none');
            $('.viewRow').addClass('d-none');
            $('#myProfileText').html('Edit Profile');
        })

        $('#view-profile').click(function() {
            $('.viewRow').removeClass('d-none');
            $('.viewProfileRow').removeClass('d-none');
            $('.editRow').addClass('d-none');
            $('.editProfileRow').addClass('d-none');
            $('#myProfileText').html('My Profile');
        })

        document.getElementById('dob').addEventListener('change', function() {
            const dob = new Date(this.value);
            const today = new Date();

            if (!isNaN(dob.getTime())) {
                let age = today.getFullYear() - dob.getFullYear();
                const m = today.getMonth() - dob.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }

                document.getElementById('age').value = age + ' Year';
            } else {
                document.getElementById('age').value = '';
            }
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

        const input = document.querySelector("#phone");
        const errorSpan = document.querySelector("#error_phone");
        const hiddenPhoneInput = document.querySelector("#phone_hidden");
        const countryCodeInput = document.querySelector("#country_code");
        const form = input.closest('form');

        const iti = window.intlTelInput(input, {
            separateDialCode: true,
            preferredCountries: ["in", "us", "gb"],
            initialCountry: "auto",
            formatOnDisplay: false,
            nationalMode: false,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
        });

        const storedCountryCode = countryCodeInput.value.replace('+', '');
        const allCountries = window.intlTelInputGlobals.getCountryData();

        let matchedCountry = allCountries.find(c => c.dialCode === storedCountryCode);
        if (matchedCountry) {
            iti.setCountry(matchedCountry.iso2);
        }

        // Set initial country code
        // countryCodeInput.value = '+' + iti.getSelectedCountryData().dialCode;

        // Update hidden inputs when user changes or blurs input
        function updatePhoneInputs() {
            // const fullNumber = iti.getNumber(); // E.164 format
            const selectedCountry = iti.getSelectedCountryData();
            const nationalNumber = input.value.replace(/\s/g, '').trim(); // Raw input, without country code
            const countryCode = '+' + selectedCountry.dialCode;
            // const nationalNumber = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
            // const countryCode = '+' + iti.getSelectedCountryData().dialCode;

            hiddenPhoneInput.value = nationalNumber;
            countryCodeInput.value = countryCode;
            // hiddenPhoneInput.value = nationalNumber.replace(/\s/g, ''); // remove spaces
            // hiddenPhoneInput.value = fullNumber;
            // countryCodeInput.value = countryCode;
        }

        input.addEventListener('blur', updatePhoneInputs);
        input.addEventListener('change', updatePhoneInputs);
        input.addEventListener('keyup', updatePhoneInputs);
        input.addEventListener('countrychange', updatePhoneInputs);

        // Validate on submit
        form.addEventListener('submit', function (e) {
            updatePhoneInputs();

            if (!iti.isValidNumber()) {
                e.preventDefault();
                const error = iti.getValidationError();
                let message = "Invalid phone number.";

                switch (error) {
                    case intlTelInputUtils.validationError.TOO_SHORT:
                        message = "The number is too short.";
                        break;
                    case intlTelInputUtils.validationError.TOO_LONG:
                        message = "The number is too long.";
                        break;
                    case intlTelInputUtils.validationError.INVALID_COUNTRY_CODE:
                        message = "Invalid country code.";
                        break;
                    case intlTelInputUtils.validationError.NOT_A_NUMBER:
                        message = "Not a valid number.";
                        break;
                }

                errorSpan.textContent = message;
                input.classList.add("is-invalid");
            } else {
                errorSpan.textContent = "";
                input.classList.remove("is-invalid");
            }
        });
    });
</script>
@endsection