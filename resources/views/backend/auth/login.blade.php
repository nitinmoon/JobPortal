@extends('backend.layouts.auth')
@section('title', 'Login')

@section('content')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="{{ route('home') }}">
                                <img class="admin-login-logo" src="{{ asset('frontend/assets/images/logo.png') }}" alt="">
                            </a>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center p-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                    @if (\Session::has('error'))
                                    <div class="alert alert-danger">
                                        {!! \Session::get('error') !!}
                                    </div>
                                    @endif
                                </div>
                                <form class="row g-3" id="login-form" action="{{ route('checkAdminLogin') }}">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Username</label>
                                        <input type="email" name="email" class="form-control login-input" placeholder="abc@example.com">
                                        <span class="error" id="error_email"></span>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control login-input" placeholder="******">
                                        <span class="error" id="error_password"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <!-- Google Recaptcha -->
                                        <div class="g-recaptcha mt-2" data-callback="recaptchaCallback" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                        <span id="captchaError" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn w-100 btnOrg text-white" type="submit">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0"><a href="{{ route('forgotPassword') }}">Forgot password?</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="credits">
                            <small>© <?= date('Y') ?> <b>Job Portal</b> - All rights reserved!</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection