@extends('backend.layouts.app')
@section('title', 'My Profile')
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom-css/candidate-profile.css') }}">
<style>
  .iti {
    width: 100%;
  }
  .iti__flag-container {
    z-index: 4;
  }
  .sm-btn {
      border-radius: 3px;
      font-size: 12px;
      padding: 0px 3px;
  }
</style>
@endsection
@section('content')
<div class="pagetitle">
  <h1>My Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"> My Profile</li>
    </ol>
  </nav>
</div>
<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center justify-content-center">
          <form action="{{ route('updateAdminProfileImage') }}" method="POST" enctype="multipart/form-data" id="updateProfileImg">
            @csrf
            <div class="text-center mt-2">
              <input type="hidden" id="defaultImg" value="{{ asset(config('constants.DEFAULT_PROFILE')) }}">
              <div class="profile-wrapper position-relative d-inline-block text-center">
                  <img id="profilePreview" src="{{ !empty(Auth::user()->profile_photo) ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents(config('constants.PROFILE_PATH') . '/' . Auth::user()->profile_photo)) : asset(config('constants.DEFAULT_PROFILE')) }}" 
                      alt="Profile Image"
                      class="rounded-circle profile-img">
                  <div class="mt-2 d-flex justify-content-center gap-2">
                      <label class="btn btn-outline-primary btn-sm mb-0 sm-btn btn-upload">
                          <i class="fa fa-upload"></i> Upload
                          <input type="file" name="profile_photo" id="profileImageInput" data-error="#error_profile_photo" accept="image/*" class="d-none">
                      </label>

                      <button type="button" id="removeProfileImage" class="btn btn-sm btn-outline-danger sm-btn btn-remove">
                          <i class="fa fa-times"></i> Remove
                      </button>
                  </div>
                  <input type="hidden" name="remove_image" id="remove_profile_photo" value="0">
                  <span class="error" id="error_profile_photo"></span>
              </div><br>  
              <button type="submit" id="updateProfileBtn" class="btn btn-primary mt-3 d-none">Update</button>
            </div>
            <div class="col-md-12 text-center mt-2">
              <h2>{{ isset(auth()->user()->first_name) ? getTitle(auth()->user()->title).' '.auth()->user()->first_name.' '.auth()->user()->middle_name.' '.auth()->user()->last_name : '--' }}</h2>
              <h3>{{ isset(auth()->user()->role_id) ? auth()->user()->role->name : '--' }}</h3>
            </div>
          </form>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>
            @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::SUPER_ADMIN || auth()->user()->role_id == App\Models\Constants\UserRoleConstants::SUB_ADMIN)
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li>
            @endif
          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Profile Details</h5>
              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->first_name) ? getTitle(auth()->user()->title).' '.auth()->user()->first_name.' '.auth()->user()->middle_name.' '.auth()->user()->last_name : '--' }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->email) ? auth()->user()->email : '--' }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone</div>
                <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->phone) ? auth()->user()->country_code .' '. auth()->user()->phone : '--' }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">DOB</div>
                <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->dob) ? date('d M Y', strtotime(auth()->user()->dob)) : '--' }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Gender</div>
                <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->gender) ? getUserGender(auth()->user()->gender) : '--' }}</div>
              </div>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
              <form action="{{ route('updateAdminProfile') }}" id="adminProfileForm" method="post">
                @csrf
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="row">
                      <div class="col-md-3 col-lg-3">
                        <select class="form-select js-example-basic-single" name="title" data-error="#error_title" style="width: 100%;">
                          <option value="">Select</option>
                          @foreach($title as $row)
                          <option value="{{ $row }}" {{ isset(auth()->user()->title) && ($row == auth()->user()->title) ? 'selected' : '' }}>{{ getTitle($row) }}</option>
                          @endforeach
                        </select>
                        <span class="error" id="error_title"></span>
                      </div>
                      <div class="col-md-3 col-lg-3">
                        <input name="first_name" type="text" class="form-control" id="first_name" value="{{ isset(auth()->user()->first_name) ? auth()->user()->first_name : '' }}">
                        <span class="error" id="error_first_name"></span>
                      </div>
                      <div class="col-md-3 col-lg-3">
                        <input name="middle_name" type="text" class="form-control" id="middle_name" value="{{ isset(auth()->user()->middle_name) ? auth()->user()->middle_name : '' }}">
                        <span class="error" id="error_middle_name"></span>
                      </div>
                      <div class="col-md-3 col-lg-3">
                        <input name="last_name" type="text" class="form-control" id="last_name" value="{{ isset(auth()->user()->last_name) ? auth()->user()->last_name : '' }}">
                        <span class="error" id="error_last_name"></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-lg-9 col-md-8">
                    <input name="email" type="email" class="form-control" id="email" value="{{ isset(auth()->user()->email) ? auth()->user()->email : '' }}" readonly>
                    <span class="error" id="error_email"></span>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                  <div class="col-lg-9 col-md-8">
                      <input type="tel" id="phone" name="phone_visible" class="form-control" placeholder="Enter number" value="{{ isset(auth()->user()->phone) ? auth()->user()->phone : '' }}">
                      <input type="hidden" name="phone" id="phone_hidden" value="{{ isset(auth()->user()->phone) ? auth()->user()->phone : '' }}">
                      <input type="hidden" name="country_code" id="country_code" value="{{ isset(auth()->user()->country_code) ? auth()->user()->country_code : '' }}">
                      <span class="error text-danger" id="error_phone"></span>
                    <!-- <input name="phone" type="text" class="form-control" id="phone" maxlength="10" value="{{ isset(auth()->user()->phone) ? auth()->user()->phone : '' }}">
                    <span class="error" id="error_phone"></span> -->
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                  <div class="col-lg-9 col-md-8">
                    <input type="date" class="form-control" name="dob" placeholder="Enter Dob" value="{{ isset(auth()->user()->dob) ? auth()->user()->dob : '' }}" max="{{ date('Y-m-d', strtotime('-18 year', time())) }}">
                    <span class="error" id="error_dob"></span>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                  <div class="col-lg-9 col-md-8">
                    <select class="form-select js-example-basic-single" name="gender" data-error="#error_gender" style="width:50%">
                      <option value="">Select</option>
                      @foreach($gender as $row)
                      <option value="{{ $row }}" {{ isset(auth()->user()->gender) && ($row == auth()->user()->gender) ? 'selected' : '' }}>{{ getUserGender($row) }}</option>
                      @endforeach
                    </select>
                    <span class="error" id="error_gender"></span>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary adminSubmitBtn">Update</button>
                </div>
              </form>
            </div>
            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form id="change-password-action" action="{{ route('changePassword') }}" method="post">
                @csrf
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-5 col-lg-5 col-form-label">Current Password <span class="text-danger">*</span></label>
                  <div class="col-md-7 col-lg-7">
                    <input name="current_password" type="password" class="form-control" id="current_password">
                  </div>
                  <span class="error" id="error_current_password"></span>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-5 col-lg-5 col-form-label">New Password <span class="text-danger">*</span></label>
                  <div class="col-md-7 col-lg-7">
                    <input name="password" type="password" class="form-control" id="password">
                  </div>
                  <span class="error" id="error_password"></span>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-5 col-lg-5 col-form-label">Re-enter New Password <span class="text-danger">*</span></label>
                  <div class="col-md-7 col-lg-7">
                    <input name="confirm_password" type="password" class="form-control" id="confirm_password">
                  </div>
                  <span class="error" id="error_confirm_password"></span>
                </div>

                <div class="text-center">
                  <button type="submit" id="changePasswordBtn" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->
            </div>
          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/my-profile.js') }}"></script>
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

     $('#profileImageInput').change(function() {
        const [file] = this.files;
        if (file) {
            $('#profilePreview').attr('src', URL.createObjectURL(file));
            $('#updateProfileBtn').removeClass('d-none');
        }
    });

    $('#removeProfileImage').click(function () {
        $('#remove_profile_photo').val(1);
        var defaultImg = $('#defaultImg').val();
        $('#profilePreview').attr('src', defaultImg);
        if ($('#removeImageFlag').length === 0) {
            $('<input>').attr({
                type: 'hidden',
                id: 'removeImageFlag',
                name: 'remove_image',
                value: '1'
            }).appendTo('#updateCandidateProfile');
        }
        $('#profileImageInput').val('');
        $('#updateProfileBtn').removeClass('d-none');
    });
  });
</script>
@endsection