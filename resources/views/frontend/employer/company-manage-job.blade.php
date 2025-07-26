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
                                <h5 class="font-weight-700 float-start text-uppercase">Manage jobs</h5>
                                <div class="float-end">
                                    <span class="select-title">Sort by freshness</span>
                                    <select>
                                        <option>All</option>
                                        <option>None</option>
                                        <option>Read</option>
                                        <option>Unread</option>
                                        <option>Starred</option>
                                        <option>Unstarred</option>
                                    </select>
                                </div>
                            </div>
                            <table class="table-job-bx cv-manager company-manage-job">
                                <thead>
                                    <tr>
                                        <th class="feature">Sr No.</th>
                                        <th>Job Title</th>
                                        <th>Applications</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="job-list">
                                </tbody>
                            </table>
                            <div class="pagination-bx m-t30 float-end">
                                <ul id="pagination" class="pagination">
                                </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info" id="exampleModalLong" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="logo-img">
                                                <img alt="" src="images/logo/icon2.png">
                                            </div>
                                            <h5 class="modal-title">Company Name</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <li><strong>Job Title :</strong>
                                                    <p> Web Developer – PHP, HTML, CSS </p>
                                                </li>
                                                <li><strong>Experience :</strong>
                                                    <p>5 Year 3 Months</p>
                                                </li>
                                                <li><strong>Deseription :</strong>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since.</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
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
<script src="{{ asset('backend/assets/js/custom-js/jobs.js') }}"></script>
<script>
    $(function() {
        const jobsPerPage = 10;
        let currentPage = 1;
        let allJobs = [];

        // Fetch jobs data from Laravel API
        $.ajax({
            url: "{{ route('getEmployerJobs') }}",
            method: 'GET',
            success: function(data) {
                allJobs = data.jobs;
                jobsCount = data.jobsCount;
                $('#jobCount').html(jobsCount);
                renderJobs(currentPage);
            },
            error: function() {
                $('#job-list').html('<p>Error loading data</p>');
            }
        });

        function renderJobs(page) {
            $('#job-list').empty();

            const start = (page - 1) * jobsPerPage;
            const end = start + jobsPerPage;
            const paginatedJobs = allJobs.slice(start, end);
            console.log(paginatedJobs);
            if (paginatedJobs != '') {
            paginatedJobs.forEach(job => {
                const viewJobRoute = "{{ route('jobDetails', ':id') }}";
                const editJobRoute = "{{ route('companyJobPost', ':id') }}";
                const deleteJobRoute = "{{ route('deleteJob', ':id') }}";
                const restoreJobRoute = "{{ route('restoreJob', ':id') }}";
                let actionButtons = '';
                if (job.deleted_at === null) {
                    actionButtons = `
                        <a href="${viewJobRoute.replace(':id', btoa(job.id))}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="${editJobRoute.replace(':id', btoa(job.id))}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a class="deleteJob" href="javascript:void(0);" data-url="${deleteJobRoute.replace(':id', job.id)}">
                            <i class="ti-trash"></i>
                        </a>
                    `;
                } else {
                    actionButtons = `
                        <a class="restoreJob" href="javascript:void(0);" data-url="${restoreJobRoute.replace(':id', job.id)}">
                            <i class="bi bi-box-arrow-up"></i>
                        </a>
                    `;
                }
                $('#job-list').append(`
                    <tr>
                        <td class="feature">
                            ${job.id}
                        </td>
                        <td class="job-name">
                            <a href="javascript:void(0);">${job.job_title}</a>
                            <ul class="job-post-info">
                                <li><i class="fas fa-map-marker-alt"></i> ${job.company_address}</li>
                                <li><i class="far fa-bookmark"></i> ${job.jobType}</li>
                                <li><i class="fa fa-filter"></i> ${job.job_category}</li>
                            </ul>
                        </td>
                        <td class="application text-primary">(${job.jobApplicantCount}) Applications</td>
                        <td class="expired ${job.jobStatusColor}">${job.jobStatus}</td>
                        <td class="job-links">
                            ${actionButtons}
                        </td>
                    </tr>
                `);
            });
        } else {
            $('#job-list').append(`<tr>
                        <td class="feature text-center" colspan="5">
                            No jobs found!
                        </td>
                    </tr>`);
        }

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