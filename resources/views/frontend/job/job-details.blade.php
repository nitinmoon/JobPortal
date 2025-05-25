@extends('frontend.layouts.app')

@section('title', 'Job Details')

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
                        <li><a href="index.html">Home</a></li>
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
                                            <li><i class="ti-location-pin"></i><strong class="font-weight-700 text-black">Address</strong><span class="text-black-light"> {{ isset($jobDetails->city_id) ? $jobDetails->city->name.', '.$jobDetails->state->name.', '.$jobDetails->country->name : '--' }} </span></li>
                                            <li><i class="ti-money"></i><strong class="font-weight-700 text-black">Salary</strong> $800 Monthy</li>
                                            <li><i class="ti-shield"></i><strong class="font-weight-700 text-black">Experience</strong>6 Year Experience</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="job-info-box">
                            <h3 class="m-t0 m-b10 font-weight-700 title-head">{{ !empty($jobDetails->job_title) ? $jobDetails->job_title : '--' }}</h3>
                            <ul class="job-info">
                                <li><strong>Education</strong> Web Designer</li>
                                <li><strong>Deadline:</strong> {{ isset($jobDetails->deadline) ? date('d M Y', strtotime($jobDetails->deadline)) : '--' }}</li>
                                <li><i class="ti-location-pin text-black m-r5"></i> {{ isset($jobDetails->country_id) ? $jobDetails->country->name : '--' }} </li>
                            </ul>
                            <h5 class="font-weight-600 mt-5">Job Description</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            <p>{!! !empty($jobDetails->job_description) ? $jobDetails->job_description : '--' !!}</p>
                            <h5 class="font-weight-600">Job Responsibility</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            <p>{!! !empty($jobDetails->job_responsibility) ? $jobDetails->job_responsibility : '--' !!}</p>
                            <h5 class="font-weight-600">Educational Requirements</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            {!! !empty($jobDetails->educational_requirements) ? $jobDetails->educational_requirements : '--' !!}
                            <h5 class="font-weight-600">Other Benefits (Facilities)</h5>
                            <div class="dez-divider divider-2px bg-gray-dark mb-4 mt-0"></div>
                            {!! !empty($jobDetails->other_benefits) ? $jobDetails->other_benefits : '--' !!}
                            <a href="jobs-applied-job.html" class="site-button">Apply This Job</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Detail -->
    </div>
</div>
@endsection