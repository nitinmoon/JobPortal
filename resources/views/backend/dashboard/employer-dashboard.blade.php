@extends('backend.layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
</div>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Candidates Applied <span>| Total</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalApplyJobCount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Candidates Applied <span>| Today</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $todayApplyJobCount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Application Sent</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-send"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $applicationSentCount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Resume Viewed</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-display"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $resumeViewedCount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Shortlisted</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $shortlistedCount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Applied Job Candidates List <span>| Today</span></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="border">
                                        <tr class="border">
                                            <th class="border">Sr.No</th>
                                            <th class="border">Candidate Name</th>
                                            <th class="border">Candidate Contacts</th>
                                            <th class="border">Job Category</th>
                                            <th class="border">Job Type</th>
                                            <th class="border">Job Title</th>
                                            <th class="border">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($todaysCandidateJobList) > 0)
                                        @foreach($todaysCandidateJobList as $key => $row)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $row->candidate->first_name. " ". $row->candidate->last_name }}</td>
                                            <td><a href="mailto:{{ $row->candidate->email }}"><i class="bi bi-envelope"></i> {{ $row->candidate->email }}</a><br>
                                                <a href="tel:{{ $row->candidate->phone }}"><i class="bi bi-telephone"></i> {{ $row->candidate->phone }}</a>
                                            </td>
                                            <td>{{ $row->job->jobCategory->name }}</td>
                                            <td>{{ $row->job->jobType->name }}</td>
                                            <td>{{ $row->job->job_title }}</td>
                                            <td><span class="badge bg-{{ getJobAppliedBadgeColor($row->status) }}">{{ getJobAppliedStatusName($row->status) }}</span></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="text-center">
                                            <td colspan="7">No Data Found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection