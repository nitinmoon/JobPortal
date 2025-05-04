@extends('backend.layouts.auth')
@section('title', 'Login')

@section('content')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
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
                                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                                </div>
                                <form class="row g-3" id="reset-form" action="{{ route('updateResetPassword') }}">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Username</label>
                                        <input type="email" name="email" class="form-control login-input" value="{{ $email }}" placeholder="abc@example.com">
                                        <span class="error" id="error_email"></span>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control login-input" id="r_user_password" placeholder="Password" />
                                        <span class="error" id="error_password"></span>
                                    </div>
                                    <div class="col-12">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control login-input" name="confirm_password" placeholder="Confirm Password" />
                                        <span class="error" id="error_confirm_password"></span>
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <button class="btn btn-primary w-100" id="submit" type="submit">Reset Password</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0"><a href="{{ route('adminLogin') }}">Back to Login</a></p>
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