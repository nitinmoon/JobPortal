@extends('frontend.layouts.app')

@php $title = $roleId == App\Models\Constants\UserRoleConstants::EMPLOYER ? 'Employer' : 'Candidate'; @endphp

@section('title', $title.' Register')

@section('style')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/custom-css/login.css') }}">
@endsection

@section('content')
<div class="page-content">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle bg-pt" style="background-image:url('{{ asset("frontend/assets/images/banner/bnr2.jpg") }}');">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">{{ $title }} Register</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $title }} Register</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- contact area -->
    <div class="section-full content-inner browse-job bg-white shop-account">
        <!-- Product -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-b30">
                    <div class="card max-w500 radius-sm m-auto">
                        <div class="tab-content">
                            <form id="verifyEmailForm" class="tab-pane active" action="{{ route('verifyEmail') }}" method="POST">
                                @csrf
                                <h4 class="font-weight-700 m-b5">{{ strtoupper($title) }} REGISTER</h4>
                                <p class="font-weight-600">Already have an account? <a href="{{ $roleId == App\Models\Constants\UserRoleConstants::EMPLOYER ? route('employerLogin') : route('candidateLogin') }}">Login</a>.</p>
                                <div class="form-group">
                                    <label class="font-weight-700">First Name *</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-700">Last Name *</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-700">E-MAIL *</label>&emsp;&emsp;&emsp13;<span id="emailMsg"></span>
                                    <input type="email" class="form-control r-input" name="email" placeholder="Enter Email Address" autocomplete="username" required>
                                    <span class="error" id="error_email"></span>
                                </div>
                                <div class="text-left">
                                    <button type="submit" class="site-button button-lg outline outline-2" id="verifyEmailBtn">VERIFY EMAIL</button>
                                </div>
                            </form>
                            <form id="verifyOtpForm" class="tab-pane active" action="{{ route('verifyOtp') }}" method="POST">
                                @csrf
                                <div class="form-group d-none" id="otpDiv">
                                    <label class="font-weight-700">Enter OTP *</label>
                                    <div class="otp-field mb-4">
                                        <input type="number" class="otpField" />
                                        <input type="number" class="otpField" disabled />
                                        <input type="number" class="otpField" disabled />
                                        <input type="number" class="otpField" disabled />
                                        <input type="number" class="otpField" disabled />
                                        <input type="number" class="otpField" disabled />
                                    </div>
                                    <span class="error" id="otpError"></span>
                                </div>
                                <div class="text-left">
                                    <input type="hidden" class="form-control" placeholder="Enter OTP" name="otp" id="otp" maxlength="6">
                                    <button type="submit" class="site-button button-lg outline outline-2 d-none" id="submitOtpBtn">SUBMIT OTP</button>
                                </div>
                            </form>
                            <form id="registerUserForm" class="tab-pane active" action="{{ route('registerUser') }}" method="POST">
                                @csrf
                                <div class="form-group passwordDiv d-none">
                                    <label class="font-weight-700">Password *</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="new-password" required>
                                    <span class="text-danger" id="error_password"></span>
                                </div>
                                <div class="form-group passwordDiv d-none">
                                    <label class="font-weight-700">Confirm Password *</label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" autocomplete="new-password" required>
                                    <span class="text-danger" id="error_confirm_password"></span>
                                </div>
                                <div class="text-left">
                                    <input type="hidden" name="role_id" value="{{ $roleId }}">
                                    <button type="submit" class="site-button button-lg outline outline-2 d-none" id="createAccountBtn">CREATE ACCOUNT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product END -->
    </div>
    <!-- contact area  END -->
</div>
@endsection
@section('script')
<script src="{{ asset('frontend/assets/js/custom-js/register.js') }}"></script>
@endsection
