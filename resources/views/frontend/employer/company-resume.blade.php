@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="page-content">
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full bg-white p-t50 p-b20">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 m-b30">
                        <div class="sticky-top">
                            @include('frontend.employer.sidebar')
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 m-b30">
                        <div class="job-bx submit-resume">
                            <div class="job-bx-title clearfix">
                                <h5 class="font-weight-700 float-start text-uppercase">Resume</h5>
                                <a href="{{ route('companyManageJobs') }}" class="site-button right-arrow button-sm float-end"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                            <div class="d-none bg-secondary text-white text-center" id="resumeError">Resume Not Found!</div>
                            <ul id="resume-job-list" class="post-job-bx browse-job-grid post-resume row">
                            </ul>
                            <div class="pagination-bx float-end m-t30">
                                <ul id="pagination" class="pagination">
                                </ul>
                            </div>
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
<script>
    $(function() {
        const jobsPerPage = 10;
        let currentPage = 1;
        let allJobs = [];

        // Fetch jobs data from Laravel API
        $.ajax({
            url: "{{ route('getCandidateResumes') }}",
            method: 'GET',
            success: function(data) {
                if(data.jobsCount != 0) {
                    allJobs = data.jobs;
                    jobsCount = data.jobsCount;
                    $('#jobCount').html(jobsCount);
                    renderJobs(currentPage);
                    $('#resumeError').addClass('d-none');
                } else {
                    $('#resumeError').removeClass('d-none');
                }
            },
            error: function() {
                $('#resume-job-list').html('<p>Error loading data</p>');
            }
        });

        function renderJobs(page) {
            $('#resume-job-list').empty();

            const start = (page - 1) * jobsPerPage;
            const end = start + jobsPerPage;
            const paginatedJobs = allJobs.slice(start, end);
            paginatedJobs.forEach(job => {
                const skillHtml = Array.isArray(job.skills)
                ? job.skills.map(skill => `<a href="javascript:void(0);"><span>${skill}</span></a>`).join('')
                : '';
                $('#resume-job-list').append(`
                    <li class="col-lg-6 col-md-6">
                        <div class="post-bx">
                            <div class="d-flex m-b20">
                                <div class="job-post-info">
                                    <h5 class="m-b0">
                                        <a href="candidate-profile/${job.candidate_id}">${job.candidate_name}</a>
                                    </h5>
                                    <p class="m-b5 font-13">
                                        <a href="javascript:void(0);" class="text-primary">${job.job_title}</a> at ${job.company_name ?? ''}
                                    </p>
                                    <ul>
                                        <li><i class="fas fa-map-marker-alt"></i> ${job.location ?? 'N/A'}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="job-time m-t15 m-b10">
                                ${skillHtml}
                            </div>
                            <a href="${job.resume_url}" class="job-links">
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                    </li>
                `);
            });

            renderPagination();
        }

        function renderPagination() {
            $('#pagination').empty();
            const totalPages = Math.ceil(allJobs.length / jobsPerPage);

            // Prev button
            $('#pagination').append(`
                <li class="previous ${currentPage === 1 ? 'disabled' : ''}">
                    <a href="javascript:void(0);"><i class="ti-arrow-left"></i> Prev</a>
                </li>
            `);

            // Page number buttons
            for (let i = 1; i <= totalPages; i++) {
                $('#pagination').append(`
                <li class="${i === currentPage ? 'active' : ''}">
                    <a href="javascript:void(0);">${i}</a>
                </li>
            `);
            }

            // Next button
            $('#pagination').append(`
                <li class="next ${currentPage === totalPages ? 'disabled' : ''}">
                    <a href="javascript:void(0);">Next <i class="ti-arrow-right"></i></a>
                </li>
            `);
        }

        // Pagination click handler
        $('#pagination').on('click', 'li', function() {
            if ($(this).hasClass('disabled') || $(this).hasClass('active')) return;

            if ($(this).hasClass('previous')) {
                if (currentPage > 1) {
                    currentPage--;
                    renderJobs(currentPage);
                }
            } else if ($(this).hasClass('next')) {
                const totalPages = Math.ceil(allJobs.length / jobsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderJobs(currentPage);
                }
            } else {
                // Page number
                const page = parseInt($(this).text());
                currentPage = page;
                renderJobs(currentPage);
            }
        });
    });
</script>
@endsection