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
            <div class="card shadow-sm rounded">
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="text-muted"><i class="bi bi-file-earmark-text me-1"></i> Title</h6>
                            <p class="fw-medium">{{ $jobDetails->job_title }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted"><i class="bi bi-person-badge-fill me-1"></i> Designation</h6>
                            <p class="fw-medium">{{ optional($jobDetails->designation)->name ?? '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted"><i class="bi bi-award-fill me-1"></i> Experience</h6>
                            <p class="fw-medium">{{ $jobDetails->experience }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted"><i class="bi bi-cash-coin me-1"></i> Salary</h6>
                            <p class="fw-medium">{{ $jobDetails->salary_range }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted"><i class="bi bi-people-fill me-1"></i> Vacancies</h6>
                            <p class="fw-medium">{{ $jobDetails->vacancy }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted"><i class="bi bi-calendar-event me-1"></i> Deadline</h6>
                            <p class="fw-medium">{{ \Carbon\Carbon::parse($jobDetails->deadline)->format('F j, Y') }}</p>
                        </div>
                        <div class="col-md-12">
                            <h6 class="text-muted"><i class="bi bi-tags-fill me-1"></i> Skills</h6>
                            @php
                            $skillIds = explode(',', $jobDetails->skills);
                            $skillNames = \App\Models\Skill::whereIn('id', $skillIds)->pluck('name');
                            @endphp
                            @foreach($skillNames as $skill)
                            <span class="badge bg-primary rounded-pill me-1">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="mb-4">
                        <h6 class="text-dark"><i class="bi bi-file-earmark-text-fill me-2 text-primary"></i>Job Description</h6>
                        <div>{!! $jobDetails->job_description !!}</div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-dark"><i class="bi bi-list-check me-2 text-success"></i>Responsibilities</h6>
                        <div>{!! $jobDetails->job_responsibility !!}</div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-dark"><i class="bi bi-mortarboard me-2 text-warning"></i>Educational Requirements</h6>
                        <div>{!! $jobDetails->educational_requirements !!}</div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-dark"><i class="bi bi-gift me-2 text-info"></i>Other Benefits</h6>
                        <div>{!! $jobDetails->other_benefits !!}</div>
                    </div>

                    @if($jobDetails->upload_file)
                    <div class="mb-4">
                        <h5 class="text-dark"><i class="bi bi-paperclip me-2 text-danger"></i>Attached File</h5>
                        <div class="input-group w-50">
                            <input type="text" class="form-control" value="{{ $jobDetails->upload_file }}" readonly>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#fileModal">
                                <i class="bi bi-eye-fill me-1"></i> View
                            </button>
                        </div>
                    </div>

                    <!-- File Modal -->
                    <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="bi bi-file-earmark-pdf me-2"></i>Uploaded File</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="{{ asset('path/to/job_files/' . $jobDetails->upload_file) }}"
                                        width="100%" height="600px" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Modal -->
                <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">View Uploaded File</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{ asset('path/to/job_files/' . $jobDetails->upload_file) }}" width="100%" height="600px" style="border:0;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card">
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
                                    <li>
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
                            {{ !empty($jobDetails->country_id) ? $jobDetails->country->name : '' }}
                        </h6>
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
            </div> -->
    </div>
    </div>
</section>

@endsection
@section('script')

@endsection