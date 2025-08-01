@extends('backend.layouts.app')
@section('title', 'Employer Form')
@section('style')
<style>
  .iti {
    width: 100%;
  }
  .iti__flag-container {
    z-index: 4;
  }
</style>
@endsection
@section('content')
<div class="pagetitle">
  <h1>{{ isset($employerDetails->id) ? 'Edit' : 'Add' }} {{ trans('employer.employer') }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('employers') }}">{{ trans('employer.employers') }}</a></li>
      <li class="breadcrumb-item active">{{ isset($employerDetails->id) ? 'Edit' : 'Add' }} {{ trans('employer.employer') }}</li>
    </ol>
  </nav>
</div>
<section class="section dashboard">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body mt-2">
          <form id="employer-form" class="row g-3 mt-2" action="{{ route('addUpdateEmployer') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3">
                  <label for="title" class="form-label">Title</label>
                  <select class="form-select js-example-basic-single" name="title" data-error="#error_title">
                    <option value="">Select</option>
                    @foreach($title as $row)
                    <option value="{{ $row }}" {{ isset($employerDetails->employer->title) && ($row == $employerDetails->employer->title) ? 'selected' : '' }}>{{ getTitle($row) }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_title"></span>
                </div>
                <div class="col-md-3">
                  <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{ isset($employerDetails->employer->first_name) ? $employerDetails->employer->first_name : '' }}">
                  <span class="error" id="error_first_name"></span>
                </div>
                <div class="col-md-3">
                  <label for="middle_name" class="form-label">Middle name</label>
                  <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name" value="{{ isset($employerDetails->employer->middle_name) ? $employerDetails->employer->middle_name : '' }}">
                  <span class="error" id="error_middle_name"></span>
                </div>
                <div class="col-md-3">
                  <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ isset($employerDetails->employer->last_name) ? $employerDetails->employer->last_name : '' }}">
                  <span class="error" id="error_last_name"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ isset($employerDetails->employer->email) ? $employerDetails->employer->email : '' }}">
                    <span class="error" id="error_email"></span>
                </div>
                <div class="form-group col-md-6">
                      <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                      <input type="tel" id="phone" name="phone_visible" class="form-control" placeholder="Enter number" value="{{ isset($employerDetails->employer->phone) ? $employerDetails->employer->phone : '' }}">
                      <input type="hidden" name="phone" id="phone_hidden" value="{{ isset($employerDetails->employer->phone) ? $employerDetails->employer->phone : '' }}">
                      <input type="hidden" name="country_code" id="country_code" value="{{ isset($employerDetails->employer->country_code) ? $employerDetails->employer->country_code : '' }}">
                      <span class="error text-danger" id="error_phone"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="dob" class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="dob" placeholder="Enter Dob" value="{{ isset($employerDetails->employer->dob) ? $employerDetails->employer->dob : '' }}" min="1940-01-01" max="{{ date('Y-m-d', strtotime('-18 year', time())) }}">
                    <span class="error" id="error_dob"></span>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                    <select class="form-select js-example-basic-single" name="gender" data-error="#error_gender">
                        <option value="">Select</option>
                        @foreach($gender as $row)
                        <option value="{{ $row }}" {{ isset($employerDetails->employer->gender) && ($row == $employerDetails->employer->gender) ? 'selected' : '' }}>{{ getUserGender($row) }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_gender"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" value="{{ isset($employerDetails->company_name) ? $employerDetails->company_name : '' }}">
                  <span class="error" id="error_company_name"></span>
                </div>
                <div class="col-md-6">
                  <label for="company_website" class="form-label">Company Website <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="company_website" placeholder="Enter Company Website" value="{{ isset($employerDetails->company_website) ? $employerDetails->company_website : '' }}">
                  <span class="error" id="error_company_website"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="company_contact_person" class="form-label">Company Contact Person</label>
                  <input type="text" class="form-control" name="company_contact_person" placeholder="Enter Contact Person" value="{{ isset($employerDetails->company_contact_person) ? $employerDetails->company_contact_person : '' }}">
                  <span class="error" id="error_company_contact_person"></span>
                </div>
                <div class="col-md-6">
                  <label for="company_contact_email" class="form-label">Company Contact Email</label>
                  <input type="email" class="form-control" name="company_contact_email" placeholder="Enter Contact Email" value="{{ isset($employerDetails->company_contact_email) ? $employerDetails->company_contact_email : '' }}">
                  <span class="error" id="error_company_contact_email"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="company_contact_no" class="form-label">Company Contact No</label>
                  <input type="text" class="form-control" id="company_contact_no" name="company_contact_no" maxlength="10" placeholder="Enter Company Contact No" value="{{ isset($employerDetails->company_contact_no) ? $employerDetails->company_contact_no : '' }}">
                  <span class="error" id="error_company_contact_no"></span>
                </div>
                <div class="col-md-6">
                    <label for="job_category_id" class="form-label">Job Category <span class="text-danger">*</span></label>
                    <select class="form-select" name="job_category_id" data-error="#error_job_category_id">
                        <option value="">Select</option>
                        @foreach($jobCategories as $category)
                        <option value="{{ $category->id }}" {{ isset($employerDetails->job_category_id) && ($category->id == $employerDetails->job_category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_job_category_id"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="foundation_date" class="form-label">Foundation Date </label>
                    <input type="date" class="form-control" name="foundation_date" placeholder="Enter Foundation Date" max="{{ date('Y-m-d') }}" value="{{ isset($employerDetails->foundation_date) ? $employerDetails->foundation_date : '' }}">
                    <span class="error" id="error_foundation_date"></span>
                </div>
                <div class="col-md-3">
                    <label for="no_of_employees" class="form-label">No Of Employees </label>
                    <input type="text" class="form-control" id="no_of_employees" name="no_of_employees" placeholder="Enter No Of Employees" value="{{ isset($employerDetails->no_of_employees) ? $employerDetails->no_of_employees : '' }}">
                    <span class="error" id="error_no_of_employees"></span>
                </div>
                <div class="col-md-6">
                    <label for="gst_no" class="form-label">GST Number </label>
                    <input type="text" class="form-control" name="gst_no" placeholder="Enter GST Number" value="{{ isset($employerDetails->gst_no) ? $employerDetails->gst_no : '' }}">
                    <span class="error" id="error_gst_no"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="company_description" class="form-label">Company Description <span class="text-danger">*</span></label>
                    <textarea class="basic-example" id="company_description" name="company_description" data-error="#error_company_description">{!! isset($employerDetails->company_description) ? $employerDetails->company_description : '' !!}</textarea>
                    <span class="error" id="error_company_description"></span>
                </div>
                <!-- <div class="col-md-6">
                   <div class="row">
                    <div class="col-md-6">
                        <label for="company_logo" class="form-label">Company Logo</label>
                        <input type="file" class="form-control" id="company_logo" name="company_logo" value="" onchange="addLoadFile(event)">
                        <span class="error" id="error_company_logo"></span>
                    </div>
                    <div class="col-md-1">
                        <button type="button" id="close" class="btn btn-danger btn-sm px-2 uploadBtn d-none" style="margin-top:23px;margin-left:-15px;"><i class="bi bi-x-circle"></i></button>
                    </div>
                    <div class="col-md-5">
                        <img class="d-none" src="" alt="" id="logoPreview" width="200" height="150">
                    </div>
                   </div>
                </div> -->
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="company_address" class="form-label">Company Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="company_address" placeholder="Enter Company Address">{{ isset($employerDetails->company_address) ? $employerDetails->company_address : '' }}</textarea>
                    <span class="error" id="error_company_address"></span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter zip code" name="zip" id="zip" maxlength="6" value="{{ isset($employerDetails->zip) && $employerDetails->zip != null ? $employerDetails->zip : '' }}">
                </div>
                <div class="col-md-3">
                    <label for="country_id" class="form-label">Country <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="country_id" id="country_id" data-error="#error_country_id">
                        <option value="">Select</option>
                        @foreach($countries as $row)
                        <option value="{{ $row->id }}" {{ (isset($employerDetails->country_id) && $employerDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_country_id"></span>
                </div>
                <div class="col-md-3">
                    <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="state_id" id="state_id" data-error="#error_state_id">
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
                <div class="col-md-3">
                    <label for="city_id" class="form-label">City <span class="text-danger">*</span></label><br>
                    <select class="form-select select2" name="city_id" id="city_id" data-error="#error_city_id">
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
            <hr>
            <div class="row mt-3">
                <div class="col-md-12">
                  <input type="hidden" name="employerId" value="{{ isset($employerDetails->employer->id) ? $employerDetails->employer->id : 0 }}" />
                  <button type="submit" class="btn btn-primary submitBtn">{{ isset($employerDetails->id) ? 'Update' : 'Save' }}</button>
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
<script src="{{ asset('backend/assets/js/custom-js/employer.js') }}"></script>
<script>
  const input = document.querySelector("#phone");
  const errorSpan = document.querySelector("#error_phone");
  const hiddenPhoneInput = document.querySelector("#phone_hidden");
  const countryCodeInput = document.querySelector("#country_code");
  const form = input.closest('form');

  const iti = window.intlTelInput(input, {
    separateDialCode: true,
    preferredCountries: ["in", "us", "gb"],
    initialCountry: "auto",
    nationalMode: false,
    formatOnDisplay: false,
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
  });

  // If you are pre-filling from database
  const storedCountryCode = countryCodeInput.value.replace('+', '');
  const allCountries = window.intlTelInputGlobals.getCountryData();

  let matchedCountry = allCountries.find(c => c.dialCode === storedCountryCode);
  if (matchedCountry) {
    iti.setCountry(matchedCountry.iso2);
  }

  function updatePhoneInputs() {
    const selectedCountry = iti.getSelectedCountryData();
    const nationalNumber = input.value.replace(/\s/g, '').trim();
    const countryCode = '+' + selectedCountry.dialCode;

    hiddenPhoneInput.value = nationalNumber;
    countryCodeInput.value = countryCode;
  }

  input.addEventListener('blur', updatePhoneInputs);
  input.addEventListener('change', updatePhoneInputs);
  input.addEventListener('keyup', updatePhoneInputs);
  input.addEventListener('countrychange', updatePhoneInputs);

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
$(function() {
  $('.js-example-basic-single').select2();

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
});
function addLoadFile(event) {
    $("#error_company_logo").html("");
    $('.submitBtn').prop('disabled', false);
    // $('#addClose').removeClass('d-none');
    // $('#addPreviewDiv').removeClass('d-none');
    var fileInput = document.getElementById('company_logo');
    var fileName = fileInput.files[0].name;
    var fileExtension = fileName.split('.').pop();
    if ( /\.(jpeg|png|jpg)$/i.test(fileName) === false ) {
        $("#error_company_logo").html("Allow only jpg | jpeg | png format");
        $('.submitBtn').prop('disabled', true);
        return false;
    }
        $('#logoPreview').removeClass('d-none');
        var image = document.getElementById("logoPreview");
        image.src = URL.createObjectURL(event.target.files[0]);
    if (event.target.files[0].size >= 2097152) {
        $("#error_company_logo").html("File size must be less than 2 MB");
        $('.submitBtn').prop('disabled', true);
        return false;
    }
    // if($('#checkAprrovalFlag').val() == Number(2)) {
    //     $('#saveApprovalBtn').prop('disabled', true);
    // }
}
</script>
@endsection