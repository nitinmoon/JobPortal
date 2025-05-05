@extends('frontend.layouts.app')

@section('title', 'Candidate Profile')
@section('style')
<style>
    .profile-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-wrapper img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }

    .upload-link {
        position: absolute;
        top: 10px;
        /* bottom: 10px; */
        /* right: 10px; */
        background: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        padding: 8px;
        cursor: pointer;
        color: #fff;
    }

    .upload-link input[type="file"] {
        display: none;
    }
</style>
@endsection
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
                                <h5 class="font-weight-700 float-start text-uppercase">Change Password</h5>
                                <a href="{{ route('companyResume') }}" class="site-button right-arrow button-sm float-end">Back</a>
                            </div>
                            <form id="change-password-action" action="{{ route('changeCandidatePassword') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input name="current_password" type="password" class="form-control" id="current_password">
                                        </div>
                                        <span class="error" id="error_current_password"></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>New Password </label>
                                            <input name="password" type="password" class="form-control" id="password">
                                        </div>
                                        <span class="error" id="error_password"></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input name="confirm_password" type="password" class="form-control" id="confirm_password">
                                        </div>
                                        <span class="error" id="error_confirm_password"></span>
                                    </div>
                                    <div class="col-lg-12 m-b10">
                                        <button type="submit" id="changePasswordBtn" class="site-button">Update Password</button>
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
<script src="{{ asset('backend/assets/js/custom-js/my-profile.js') }}"></script>
@endsection