    @extends('frontend.layouts.app')

    @section('title', 'Candidate Profile')

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
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            <div class="job-bx-title clearfix">
                                <h5 class="font-weight-700 float-start text-uppercase"><span id="jobCount"></span> Jobs Found</h5>
                                <div class="float-end">
                                    <span class="select-title">Sort by freshness</span>
                                    <select>
                                        <option>Last 2 Months</option>
                                        <option>Last Months</option>
                                        <option>Last Weeks</option>
                                        <option>Last 3 Days</option>
                                    </select>
                                    <div class="float-end p-tb5 p-r10">
                                        <a href="browse-job-filter-list.html" class="p-lr5"><i class="fa fa-th-list"></i></a>
                                        <a href="browse-job-filter-grid.html" class="p-lr5"><i class="fa fa-th"></i></a>
                                    </div>
                                </div>
                            </div>
                            <ul id="applied-job-list" class="post-job-bx">
                            </ul>
                            <div class="pagination-bx float-end m-t30">
                                <ul id="pagination" class="pagination">
                                </ul>
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
    <script src="{{ asset('frontend/assets/js/custom-js/profile.js') }}"></script>
    <script>
        $(function() {
            const jobsPerPage = 10;
            let currentPage = 1;
            let allJobs = [];

            // Fetch jobs data from Laravel API
            $.ajax({
                url: "{{ route('getAppliedJobsData') }}",
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    allJobs = data.jobs;
                    jobsCount = data.jobsCount;
                    $('#jobCount').html(jobsCount);
                    renderJobs(currentPage);
                },
                error: function() {
                    $('#applied-job-list').html('<p>Error loading data</p>');
                }
            });

            function renderJobs(page) {
                $('#applied-job-list').empty();

                const start = (page - 1) * jobsPerPage;
                const end = start + jobsPerPage;
                const paginatedJobs = allJobs.slice(start, end);
                // Append job items
                if(jobsCount != 0) {
                paginatedJobs.forEach(job => {
                    $('#applied-job-list').append(`
                    <li>
                        <div class="post-bx">
                            <div class="job-post-info m-a0">
                                <h4><a href="${job.jobDetailsRoute}">${job.job_title}</a></h4>
                                <ul>
                                    <li><a href="company-profile.html">@${job.company}</a></li>
                                    <li><i class="fas fa-map-marker-alt"></i>${job.company_address}</li>
                                    <li><i class="far fa-money-bill-alt"></i> ${job.salary_range}</li>
                                </ul>
                                <div class="job-time m-t15 m-b10">
                                    ${job.skills}
                                </div>
                                <div class="posted-info clearfix">
                                    <p class="m-tb0 text-primary float-start"><span class="text-black m-r10">Applied On:</span> ${job.date}</p>
                                </div>
                            </div>
                        </div>
                    </li>
            `);
                });
                } else {
                        $('#applied-job-list').html('<span class="badge bg-warning">No applied jobs found!</span>');
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