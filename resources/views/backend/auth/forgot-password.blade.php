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
                            <a href="{{ route('adminLogin') }}" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Admin Logo">
                                <span class="d-lg-block">Job Portal</span>
                            </a>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                                    <p class="text-center small">Enter your username, we will mail you password reset link!</p>
                                </div>
                                @if (\Session::has('error'))
                                <div class="alert alert-danger">
                                    {!! \Session::get('error') !!}
                                </div>
                                @endif
                                <form class="row g-3" id="forgot-form" action="{{ route('sendResetPasswordLink') }}">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Username</label>
                                        <input type="email" name="email" class="form-control login-input" placeholder="abc@example.com">
                                        <span class="error" id="error_email"></span>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" id="submit" type="submit">Email Password Reset Link</button>
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