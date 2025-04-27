@extends('frontend.layouts.app')

@php $title = $roleId == App\Models\Constants\UserRoleConstants::EMPLOYER ? 'Employer' : 'Candidate'; @endphp

@section('title', $title.' Login')

@section('content')
<div class="page-content">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle bg-pt" style="background-image:url('{{ asset("frontend/assets/images/banner/bnr2.jpg") }}');">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">{{ $title }} Login</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $title }} Login</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- contact area -->
    <div class="section-full content-inner-2 shop-account bg-white">
        <!-- Product -->
        <div class="container">
            <div class="max-w500 m-auto bg-white m-b30">
                <div class="p-a30 card browse-job radius-sm">
                    <div class="tab-content nav">
                        <form id="loginForm" class="tab-pane active col-12 p-a0" action="{{ route('checkLogin') }}" method="POST">
                            @csrf
                            <h4 class="font-weight-700">{{ strtoupper($title) }} LOGIN</h4>
                            <p class="font-weight-600">Don't have an account? <a href="{{ $roleId == App\Models\Constants\UserRoleConstants::EMPLOYER ? route('employerRegister') : route('candidateRegister') }}">Sign Up</a></p>
                            <div class="form-group">
                                <label class="font-weight-700">Email *</label>
                                <input type="email" class="form-control login-input" name="email" placeholder="Enter Email Address" autocomplete="username" required>
                                <span class="error" id="error_email"></span>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-700">Password *</label>
                                <input type="password" class="form-control login-input" name="password" placeholder="Enter Password" autocomplete="current-password" required>
                                <span class="error" id="error_password"></span>
                            </div>
                            <!-- <div class="form-group"> -->
                                <!-- Google Recaptcha -->
                                <!-- <div class="g-recaptcha mt-4" data-callback="recaptchaCallback" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                <span id="captchaError" class="error"></span> -->
                            <!-- </div> -->
                            <div class="text-left">
                                <button type="submit" class="site-button m-r5 button-lg" id="loginSubmitBtn">login</button>
                                <a data-bs-toggle="tab" href="#forgot-password" class="m-l5 m-t15 forget-pass float-end"><i class="fa fa-unlock-alt"></i> Forgot Password</a>
                            </div>
                        </form>
                        <form id="forgot-password" class="tab-pane fade  col-12 p-a0">
                            <h4 class="font-weight-700">FORGET PASSWORD ?</h4>
                            <p class="font-weight-600">We will send you an email to reset your password. </p>
                            <div class="form-group">
                                <label class="font-weight-700">E-MAIL *</label>
                                <input name="dzName" required="" class="form-control" placeholder="Your Email Address" type="email">
                            </div>
                            <div class="text-left">
                                <a class="site-button outline gray button-lg" data-bs-toggle="tab" href="#login">Back</a>
                                <button class="site-button float-end button-lg">Submit</button>
                            </div>
                        </form>
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
<script src="{{ asset('frontend/assets/js/custom-js/login.js') }}"></script>
@endsection
