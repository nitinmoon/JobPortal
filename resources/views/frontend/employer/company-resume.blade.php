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
                    <li class="col-lg-6 col-md-6 mb-3">
                        <div class="post-bx p-3" style="background-color:#f8f9ff; border-radius:8px;">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="m-b0">
                                        <a href="candidate-profile/${job.candidate_id}">${job.candidate_name}</a>
                                    </h5>
                                    <p class="m-b5 font-13">
                                        <a href="javascript:void(0);" class="text-primary">${job.job_title}</a> at ${job.company_name ?? ''}
                                    </p>
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-map-marker-alt me-1"></i> ${job.location ?? 'N/A'}</li>
                                    </ul>
                                </div>
                                <div class="d-flex flex-column align-items-end gap-2">
                                    <select class="form-select form-select-sm change-apply-job-status" data-id="${job.id}" style="min-width: 120px; font-size:11px !important;">
                                        <option value="1" ${job.status == 1 ? 'selected' : ''}>Application Sent</option>
                                        <option value="2" ${job.status == 2 ? 'selected' : ''}>Resume Viewed</option>
                                        <option value="3" ${job.status == 3 ? 'selected' : ''}>Shortlisted</option>
                                        <option value="4" ${job.status == 4 ? 'selected' : ''}>Hired</option>
                                    </select>
                                    <a href="${job.resume_url}" class="btn btn-warning btn-sm" title="Download Resume">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="job-time m-t10">
                                ${skillHtml}
                            </div>
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

        //Change Apply Job Status
        $(document).on('change', '.change-apply-job-status', function (e) {
            e.preventDefault();
            const applyJobId = $(this).data('id');
            const newStatus = $(this).val();
            Swal.fire({
                title: 'Change Status!',
                text: "Are you sure you want to change it?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('changeApplyJobStatus') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: applyJobId,
                            status: newStatus
                        },
                        beforeSend: function () {
                            $("#preloader").show();
                        },
                        success: function (res) {
                            if (res.status == true) {
                                Toast.create({
                                    title: "Success!",
                                    message: res.msg,
                                    status: TOAST_STATUS.SUCCESS,
                                    timeout: 5000
                                });
                                location.reload();
                            } else {
                                Toast.create({
                                    title: "Error!",
                                    message: res.msg,
                                    status: TOAST_STATUS.DANGER,
                                    timeout: 5000
                                });
                            }
                        },
                        complete: function () {
                            $("#preloader").hide();
                        }
                    });
                }
            })
        });
    });
</script>
@endsection