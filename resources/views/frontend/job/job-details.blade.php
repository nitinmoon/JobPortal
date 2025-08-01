@extends('frontend.layouts.app')

@section('title', 'Job Details')
@section('style')
<style>
    .job-info-box ol {
        margin-left: 25px !important;
    }
</style>
@endsection
@section('content')
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">{{ !empty($jobDetails->job_title) ? $jobDetails->job_title : '--' }}</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('jobs') }}">Jobs</a></li>
                        <li>{{ !empty($jobDetails->job_title) ? $jobDetails->job_title : '--' }}</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- contact area -->
    <div class="content-block">
        <!-- Job Detail -->
        <div class="section-full content-inner-1 mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="sticky-top">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="m-b30">
                                        <img src="{{ asset('frontend/assets/images/blog/grid/pic1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="widget bg-white p-lr20 p-t20  widget_getintuch radius-sm">
                                        <h4 class="text-black font-weight-700 p-t10 m-b15">Job Details</h4>
                                        <ul>
                                            <li><i class="ti-shield"></i><strong class="font-weight-700 text-black">Company</strong><span class="text-black-light"> {{ isset($jobDetails->employer->company_name) ? $jobDetails->employer->company_name : '--' }} </span></li>
                                            <li><i class="ti-location-pin"></i><strong class="font-weight-700 text-black">Address</strong><span class="text-black-light"> {{ isset($jobDetails->employer->company_address) ? $jobDetails->employer->company_address.', '.$jobDetails->employer->city->name.', '.$jobDetails->employer->state->name.', '.$jobDetails->employer->country->name.' - '.$jobDetails->employer->zip : '--' }} </span></li>
                                            <li><i class="ti-money"></i><strong class="font-weight-700 text-black">Salary</strong> {{ !empty($jobDetails->salary_range) ? $jobDetails->salary_range.' P.A.' : '--' }}</li>
                                            <li><i class="ti-shield"></i><strong class="font-weight-700 text-black">Experience</strong>{{ !empty($jobDetails->experience) ? $jobDetails->experience.' Experience' : '--' }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="job-info-box" style="padding-left: 20px;">
                            <h3 class="m-t0 m-b10 font-weight-700 title-head" style="margin-left: -1rem !important;">{{ !empty($jobDetails->job_title) ? $jobDetails->job_title : '--' }}</h3>
                            <ul class="job-info">
                                <li><strong>Category:</strong> {{ !empty($jobDetails->jobCategory->name) ? $jobDetails->jobCategory->name : '--' }}</li>
                                <li><strong>Deadline:</strong> {{ isset($jobDetails->deadline) ? date('d M Y', strtotime($jobDetails->deadline)) : '--' }}</li>
                                <li><i class="ti-location-pin text-black m-r5"></i> {{ isset($jobDetails->country_id) ? $jobDetails->country->name : '--' }} </li>
                            </ul>
                            <h5 class="font-weight-600 mt-5" style="margin-left: -1rem !important;">Job Description</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0" style="margin-left: -1rem !important;"></div>
                            <p style="white-space: normal; padding-left: 15px !important;">{!! !empty($jobDetails->job_description) ? $jobDetails->job_description : '--' !!}</p>
                            <h5 class="font-weight-600" style="margin-left: -1rem !important;">Job Responsibility</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0" style="margin-left: -1rem !important;"></div>
                            <p style="white-space: normal; padding-left: 15px !important;">{!! !empty($jobDetails->job_responsibility) ? $jobDetails->job_responsibility : '--' !!}</p>
                            <h5 class="font-weight-600" style="margin-left: -1rem !important;">Educational Requirements</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0" style="margin-left: -1rem !important;"></div>
                            <p style="white-space: normal; padding-left: 15px !important;">{!! !empty($jobDetails->educational_requirements) ? $jobDetails->educational_requirements : '--' !!}</p>
                            <h5 class="font-weight-600" style="margin-left: -1rem !important;">Other Benefits (Facilities)</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0" style="margin-left: -1rem !important;"></div>
                            <p style="white-space: normal; padding-left: 15px !important;">{!! !empty($jobDetails->other_benefits) ? $jobDetails->other_benefits : '--' !!}</p>
                            @if(!empty(Auth::user()))
                                @if(isCandidateApplyJob(auth()->user()->id, $jobDetails->id) == '')
                                    @if(auth()->user()->role_id == '3')
                                    <a href="{{ empty(Auth::user()) ? route('candidateLogin') : route('candidateProfile', ['flag'=> 'apply-job', 'jobId'=> base64_encode($jobDetails->id)]) }}" class="site-button">Apply This Job</a>
                                    @endif
                                @else
                                    <span class="bg-success p-2 text-white">You have already applied!</span>
                                @endif
                            @else
                            <a href="{{ empty(Auth::user()) ? route('candidateLogin') : route('candidateProfile', ['flag'=> 'apply-job', 'jobId'=> base64_encode($jobDetails->id)]) }}" class="site-button">Apply This Job</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Detail -->
    </div>
</div>
@endsection