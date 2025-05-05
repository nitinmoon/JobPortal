@extends('backend.layouts.app')
@section('title', 'View Job Details')
@section('content')
    <div class="pagetitle">
        <h1>View Job Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('jobsList') }}">Jobs</a></li>
                <li class="breadcrumb-item active">View Job Details</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2">
                            <div class="single-job mb-4 d-lg-flex justify-content-between">
                                <div class="job-text">
                                    <h6>{{ isset($jobDetails->job_title) ? $jobDetails->job_title : '--' }}</h6>
                                    <ul class="mt-4">
                                        <li>
                                            <h5><i class="fa fa-map-marker"></i> <strong>Work Type :</strong>
                                               {{ !empty($jobDetails->work_type_id) ? $jobDetails->workType->name : '' }}
                                            </h5>
                                        </li>
                                        <li >
                                            <h5><i class="fa fa-pie-chart"></i> <strong>Job Category :</strong>
                                                {{ !empty($jobDetails->job_category_id) ? $jobDetails->jobCategory->name : '--' }}
                                            </h5>
                                        </li>
                                        <li>
                                            <h5><strong>Experience :</strong>
                                            @if (isset($jobDetails->experience) && $jobDetails->experience == 'Fresher & Experienced' || isset($jobDetails->experience) && $jobDetails->experience == 'Fresher')
                                            @if (isset($jobDetails->experience) && $jobDetails->experience == 'Fresher & Experienced')
                                                @php $experience = 'Both fresher & experienced candidates will be able to apply'; @endphp
                                            @else
                                                @php $experience = 'Only fresher candidates will be able to apply'; @endphp
                                            @endif
                                            @else
                                                @php
                                                $experience = explode('-', $jobDetails->experience)[0].' Years '. explode('-', $jobDetails->experience)[1].' Months';
                                                @endphp
                                            @endif
                                                {{ $experience }}
                                            </h5>
                                        </li>
                                        <li>
                                            <h5><strong>Deadline :</strong>
                                                {{ !empty($jobDetails->deadline) ? date('M d, Y', strtotime($jobDetails->deadline)) : '--' }}
                                            </h5>
                                        </li>
                                        <li>
                                            <h5><strong>Salary :</strong>
                                                {{ !empty($jobDetails->salary_range) ? $jobDetails->salary_range.' / Month' : '' }}
                                            </h5>
                                        </li>
                                        <li>
                                            <h5><strong>Gender :</strong>
                                                {{ isset($jobDetails->gender) ? getGender($jobDetails->gender) : '' }}
                                            </h5>
                                        </li>

                                    </ul>
                                </div>
                                <div class="job-btn align-self-center">
                                    <a href="javascript:void(0);"
                                        class="third-btn disable-click {{ getJobTypeBadgeColor($jobDetails->jobType->name) }}">{{ !empty($jobDetails->job_type_id) ? $jobDetails->jobType->name : '--' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-12 single-content2 py-4">
                            <h6>{{ isset($jobDetails->designation_id) ? $jobDetails->designation->name : '--' }} <br>
                                {{ !empty($jobDetails->city_id) ? $jobDetails->city->name : '' }},
                                {{ !empty($jobDetails->state_id) ? $jobDetails->state->name : '' }},
                                {{ !empty($jobDetails->country_id) ? $jobDetails->country->name : '' }}</h6>
                            <p>{!! !empty($jobDetails->job_description) ? $jobDetails->job_description : '--' !!}</p>
                        </div>
                        <div class="col-md-4 single-content2 py-4">
                            <h6>Vacancy</h6>
                            <span class="ml-4">{{ !empty($jobDetails->vacancy) ? $jobDetails->vacancy : '--' }}</span>
                        </div>

                        <div class="col-md-12 single-content2 py-4 ">
                            <h6>Job responsibility</h6>
                            <p>{!! !empty($jobDetails->job_responsibility) ? $jobDetails->job_responsibility : '--' !!}</p>
                        </div>
                        <div class="col-md-12 single-content2 py-4 ">
                            <h6>Educational Requirements</h6>
                            <p>{!! isset($jobDetails->educational_requirements) ? $jobDetails->educational_requirements : '--' !!}</p>
                            @if (count(explode(',', $jobDetails->skills)) > 0)
                                <p>
                                    <strong>Skills Required:</strong>
                                    @foreach ($skills as $skill)
                                        {!! isset($jobDetails->skills) &&
                                        $jobDetails->skills != '' &&
                                        in_array($skill->id, explode(',', $jobDetails->skills))
                                            ? '<span class="badge badge-primary p-2">' . $skill->name . '</span>'
                                            : '' !!}
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <div class="col-md-12 single-content2 py-4 ">
                            <h6>Employment Status</h6>
                            <span>{{ !empty($jobDetails->job_type_id) ? $jobDetails->jobType->name : '--' }}</span>
                        </div>
                        <div class="col-md-12 single-content2 py-4 ">
                            <h6>Other Benefits</h6>
                            {!! $jobDetails->other_benefits !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

@endsection
