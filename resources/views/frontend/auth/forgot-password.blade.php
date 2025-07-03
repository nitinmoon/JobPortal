@extends('frontend.layouts.app')

@php $title = $roleId == App\Models\Constants\UserRoleConstants::EMPLOYER ? 'Employer' : 'Candidate'; @endphp

@section('title', $title.' Forgot Password')

@section('content')
<div class="page-content">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle bg-pt" style="background-image:url('{{ asset("frontend/assets/images/banner/bnr2.jpg") }}');">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">{{ $title }} Forgot Password</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $title }} Forgot Password</li>
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
                        <form id="forgot-form" action="{{ route('sendResetPasswordLink') }}" method="POST">
                            @csrf
                            <h4 class="font-weight-700">FORGET PASSWORD ?</h4>
                            <p class="font-weight-600">Enter your username, we will mail you password reset link! </p>
                            @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="font-weight-700">E-MAIL *</label>
                                <input name="email" class="form-control" placeholder="abc@example.com" type="email">
                                <span class="error" id="error_email"></span>
                            </div>
                            <div class="text-left">
                                <a class="site-button outline gray button-lg" href="{{ $roleId == App\Models\Constants\UserRoleConstants::EMPLOYER ? route('employerLogin') : route('candidateLogin') }}">Back</a>
                                <button type="submit" class="site-button float-end button-lg">Email Password Reset Link</button>
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
<script src="{{ asset('frontend/assets/js/custom-js/forgot-password.js') }}"></script>
@endsection
