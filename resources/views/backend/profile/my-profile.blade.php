@extends('backend.layouts.app')
@section('title', 'My Profile')
@section('style')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/custom-css/candidate-profile.css') }}">
@endsection

@section('content')
<div class="pagetitle">
  <h1>My Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('employerDashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"> My Profile</li>
    </ol>
  </nav>
</div>
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <form action="{{ route('updateAdminProfileImage', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" id="updateProfileImg">
              @csrf
                <div class="profile-photo">
                    <label class="file_label" for="file">
                        <span class="cprofile glyphicon glyphicon-camera"></span>
                        <p class="cCamera"><i class="fa fa-camera"></i></p><br>
                        <span class="cprofile">Change Profile</span>
                    </label>
                    <input id="file" type="file" name="profile_photo" accept="image/jpg, image/jpeg, image/png" id="profile_photo"  onchange="loadProfile(event)"/>
                    <img src="{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="your image" id="output" width="200" />
                </div>
                <a class="profileEditBtn"><i class="bi bi-pencil-square"></i></a>
                <div class="col-md-12 text-center mt-2">
                    <button type="submit" id="upload_img" class="btn btn-info btn-sm d-none p-2"><i class="bi bi-upload" aria-hidden="true"></i></button>
                    <button type="button" id="close" class="btn btn-danger btn-sm d-none p-2"><i class="bi bi-x" aria-hidden="true"></i></button>
                    <span id="imageUplaoderro" class="badge bg-danger mt-3"></span>
                </div>
                <!-- <img src="{{ !empty($employerDetails->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="Profile" class="rounded-circle"> -->
                <h2>{{ isset(auth()->user()->first_name) ? getTitle(auth()->user()->title).' '.auth()->user()->first_name.' '.auth()->user()->middle_name.' '.auth()->user()->last_name : '--' }}</h2>
                <h3>{{ isset(auth()->user()->role_id) ? auth()->user()->role->name : '--' }}</h3>
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
                @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::SUPER_ADMIN)
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
                    <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->phone) ? auth()->user()->phone : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">DOB</div>
                    <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->dob) ? date('d M y', strtotime(auth()->user()->dob)) : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{ isset(auth()->user()->gender) ? getUserGender(auth()->user()->gender) : '--' }}</div>
                  </div>
                  @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::USER_ROLE_EMPLOYER)
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->company_address) ? $employerDetails->company_address : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Zip Code</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->zip) ? $employerDetails->zip : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->country_id) ? $employerDetails->country->name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->state_id) ? $employerDetails->state->name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">City</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->city_id) ? $employerDetails->city->name : '--' }}</div>
                  </div>
                  @endif
                  @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::USER_ROLE_EMPLOYER)
                  <hr>
                  <h5 class="card-title">Company Details</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company name</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->company_name) ? $employerDetails->company_name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company Description</div>
                    <div class="col-lg-9 col-md-8">{!! isset($employerDetails->company_description) ? $employerDetails->company_description : '--' !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Contact Person</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->company_contact_person) ? $employerDetails->company_contact_person : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Contact Email</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->company_contact_email) ? $employerDetails->company_contact_email : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->company_contact_no) ? $employerDetails->company_contact_no : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Foundation Date</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->foundation_date) ? date('d M y', strtotime($employerDetails->foundation_date)) : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">No. Of Employees</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->no_of_employees) ? $employerDetails->no_of_employees : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">GST Number</div>
                    <div class="col-lg-9 col-md-8">{{ isset($employerDetails->gst_no) ? $employerDetails->gst_no : '--' }}</div>
                  </div>
                  @endif
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::SUPER_ADMIN)
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
                        <input name="phone" type="text" class="form-control" id="phone" maxlength="10" value="{{ isset(auth()->user()->phone) ? auth()->user()->phone : '' }}">
                        <span class="error" id="error_phone"></span>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="date" class="form-control" name="dob" placeholder="Enter Dob" value="{{ isset(auth()->user()->dob) ? auth()->user()->dob : '' }}">
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
                  @elseif(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::USER_ROLE_EMPLOYER)
                  <form action="{{ route('updateEmployerProfile') }}" id="employerProfileForm" method="post">
                    @csrf
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row">
                          <div class="col-md-3 col-lg-3">
                            <select class="form-select js-example-basic-single" name="title" data-error="#error_title" style="width: 100%;">
                              <option value="">Select</option>
                              @foreach($title as $row)
                              <option value="{{ $row }}" {{ isset($employerDetails->employer->title) && ($row == $employerDetails->employer->title) ? 'selected' : '' }}>{{ getTitle($row) }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-3 col-lg-3">
                            <input name="first_name" type="text" class="form-control" id="first_name" value="{{ isset(auth()->user()->first_name) ? auth()->user()->first_name : '' }}">
                          </div>
                          <div class="col-md-3 col-lg-3">
                            <input name="middle_name" type="text" class="form-control" id="middle_name" value="{{ isset(auth()->user()->middle_name) ? auth()->user()->middle_name : '' }}">
                          </div>
                          <div class="col-md-3 col-lg-3">
                            <input name="last_name" type="text" class="form-control" id="last_name" value="{{ isset(auth()->user()->last_name) ? auth()->user()->last_name : '' }}">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-lg-9 col-md-8">
                        <input name="email" type="email" class="form-control" id="email" value="{{ isset(auth()->user()->email) ? auth()->user()->email : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-lg-9 col-md-8">
                        <input name="phone" type="text" class="form-control" id="phone" maxlength="10" value="{{ isset(auth()->user()->phone) ? auth()->user()->phone : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="date" class="form-control" name="dob" placeholder="Enter Dob" value="{{ isset(auth()->user()->dob) ? auth()->user()->dob : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-lg-9 col-md-8">
                        <select class="form-select js-example-basic-single" name="gender" data-error="#error_gender" style="width: 100%;">
                          <option value="">Select</option>
                          @foreach($gender as $row)
                          <option value="{{ $row }}" {{ isset(auth()->user()->gender) && ($row == auth()->user()->gender) ? 'selected' : '' }}>{{ getUserGender($row) }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Company Address</label>
                      <div class="col-lg-9 col-md-8">
                        <textarea class="form-control" name="company_address" placeholder="Enter Company Address">{{ isset($employerDetails->company_address) ? $employerDetails->company_address : '' }}</textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Zip Code</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="text" class="form-control" placeholder="Enter zip code" name="zip" id="zip" maxlength="6" value="{{ isset($employerDetails->zip) ? $employerDetails->zip : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-lg-9 col-md-8">
                        <select class="form-select select2" name="country_id" id="country_id" data-error="#error_country_id">
                          <option value="">Select</option>
                          @foreach($countries as $row)
                          <option value="{{ $row->id }}" {{ isset($employerDetails->country_id) && $employerDetails->country_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">State</label>
                      <div class="col-lg-9 col-md-8">
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
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">City</label>
                      <div class="col-lg-9 col-md-8">
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
                      </div>
                    </div>
                    <hr>
                    <h5 class="card-title">Company Details</h5>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Company Name</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" value="{{ isset($employerDetails->company_name) ? $employerDetails->company_name : '' }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Company Description</label>
                      <div class="col-lg-9 col-md-8">
                        <textarea class="basic-example" id="company_description" name="company_description" data-error="#error_company_description">{!! isset($employerDetails->company_description) ? $employerDetails->company_description : '' !!}</textarea>
                        <span class="error" id="error_company_description"></span>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Contact Person</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="text" class="form-control" name="company_contact_person" placeholder="Enter Contact Person" value="{{ isset($employerDetails->company_contact_person) ? $employerDetails->company_contact_person : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Contact Email</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="email" class="form-control" name="company_contact_email" placeholder="Enter Contact Email" value="{{ isset($employerDetails->company_contact_email) ? $employerDetails->company_contact_email : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="text" class="form-control" maxlength="10" id="company_contact_no" name="company_contact_no" placeholder="Enter Company Contact No" value="{{ isset($employerDetails->company_contact_no) ? $employerDetails->company_contact_no : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Foundation Date</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="date" class="form-control" name="foundation_date" placeholder="Enter Foundation Date" max="{{ date('Y-m-d') }}" value="{{ isset($employerDetails->foundation_date) ? $employerDetails->foundation_date : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">No. Of Employees</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="text" class="form-control" id="no_of_employees" name="no_of_employees" placeholder="Enter No Of Employees" value="{{ isset($employerDetails->no_of_employees) ? $employerDetails->no_of_employees : '' }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">GST Number</label>
                      <div class="col-lg-9 col-md-8">
                        <input type="text" class="form-control" name="gst_no" placeholder="Enter GST Number" value="{{ isset($employerDetails->gst_no) ? $employerDetails->gst_no : '' }}">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    @endif
                  </form><!-- End Profile Edit Form -->
                </div>
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form id="change-password-action" action="{{ route('changePassword') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password <span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current_password" type="password" class="form-control" id="current_password">
                      </div>
                      <span class="error" id="error_current_password"></span>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password <span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password">
                      </div>
                      <span class="error" id="error_password"></span>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password <span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
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
$(function() {
  $('.js-example-basic-single').select2();

  $("#close").click(function(){
      $('#output').attr('src', "{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}");
      $("#select_img").removeClass('d-none');
      $("#upload_img").addClass('d-none');
      $("#close").addClass('d-none');
  });

  $('#country_id').change(function () {
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
            success: function (data) {
                $("#state_id").empty();
                $.each(data, function (key, value) {
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

    $("#state_id").change(function () {
        var stateId = $(this).val();
        $("#city_id").empty();
        $.ajax({
            url: "{{ route('getCity') }}",
            dataType: 'json',
            data: {
                stateId: stateId
            },
            delay: 250,
            success: function (data) {
                $("#city_id").empty();
                $.each(data, function (key, value) {
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
function loadProfile(event) {
        $("#imageUplaoderro").html("");
        var image = document.getElementById("output");
        if ( /\.(jpeg|png|jpg)$/i.test(event.target.files[0].name) === false ) {
            $("#imageUplaoderro").html("Allow only jpg | jpeg | png format");
            $("#upload_img").addClass('d-none');
            $("#close").addClass('d-none');
            $('#output').attr('src', "{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}");
            return false;
        }
        if (event.target.files[0].size >= 2097152) {
            $("#imageUplaoderro").html("Size must be less than 2 MB");
            image.src = URL.createObjectURL(event.target.files[0]);
            $("#upload_img").addClass('d-none');
            $("#close").addClass('d-none');
            $('#output').attr('src', "{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}");
            return false;
        }
        image.src = URL.createObjectURL(event.target.files[0]);
        $('#upload_img').removeClass('d-none');
        $('#close').removeClass('d-none');
    }
</script>
@endsection