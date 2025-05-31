@extends('frontend.layouts.app')

@section('title', 'Jobs')

@section('content')
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Browse Jobs</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Browse Jobs</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- Filters Search -->
    <div class="section-full browse-job-find">
        <div class="container">
            <div class="find-job-bx">
                <form class="dezPlaceAni">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Job Title, Keywords, or Phrase</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label>City, State or ZIP</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select>
                                    <option>Select Sector</option>
                                    <option>Construction</option>
                                    <option>Corodinator</option>
                                    <option>Employer</option>
                                    <option>Financial Career</option>
                                    <option>Information Technology</option>
                                    <option>Marketing</option>
                                    <option>Quality check</option>
                                    <option>Real Estate</option>
                                    <option>Sales</option>
                                    <option>Supporting</option>
                                    <option>Teaching</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <button type="submit" class="site-button btn-block">Find Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Filters Search END -->
    <!-- contact area -->
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full browse-job p-b50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-5 m-b30">
                        <aside id="accordion1" class="sticky-top sidebar-filter">
                            <h6 class="title"><i class="fa fa-sliders m-r5"></i> Refined By <a href="javascript:void(0);" class="font-12 float-end">Reset All</a></h6>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#companies">
                                            Companies
                                        </a>
                                    </h6>
                                </div>
                                <div id="companies" class="acod-body collapse show">
                                    <div class="acod-content">
                                        <div class="form-check">
                                            <input class="form-check-input" id="companies1" type="checkbox" name="checkbox-companies">
                                            <label class="form-check-label" for="companies1">Job Mirror Consultancy <span>(50)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="companies2" type="checkbox" name="checkbox-companies">
                                            <label class="form-check-label" for="companies2">Engineering Group <span>(80)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="companies3" type="checkbox" name="checkbox-companies">
                                            <label class="form-check-label" for="companies3">Electric Co. <span>(235)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="companies4" type="checkbox" name="checkbox-companies">
                                            <label class="form-check-label" for="companies4">Telecom industry <span>(568)</span></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="companies5" type="checkbox" name="checkbox-companies">
                                            <label class="form-check-label" for="companies5">Safety/ Health <span>(798)</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#experience" class="collapsed">
                                            Experience
                                        </a>
                                    </h6>
                                </div>
                                <div id="experience" class="acod-body collapse">
                                    <div class="acod-content">
                                        <div class="form-check">
                                            <input class="form-check-input" id="one-years" type="radio" name="radio-years">
                                            <label class="form-check-label" for="one-years">0-1 Years <span>(120)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="two-years" type="radio" name="radio-years">
                                            <label class="form-check-label" for="two-years">1-2 Years <span>(300)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="three-years" type="radio" name="radio-years">
                                            <label class="form-check-label" for="three-years">2-3 Years <span>(235)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="four-years" type="radio" name="radio-years">
                                            <label class="form-check-label" for="four-years">3-4 Years <span>(568)</span></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="five-years" type="radio" name="radio-years">
                                            <label class="form-check-label" for="five-years">4-5 Years <span>(798)</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#salary" class="collapsed">
                                            Salary
                                        </a>
                                    </h6>
                                </div>
                                <div id="salary" class="acod-body collapse">
                                    <div class="acod-content">
                                        <div class="form-check">
                                            <input class="form-check-input" id="salary-op1" type="radio" name="radio-currency">
                                            <label class="form-check-label" for="salary-op1">0-1 lacs <span>(120)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="salary-op2" type="radio" name="radio-currency">
                                            <label class="form-check-label" for="salary-op2">1-2 lacs <span>(300)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="salary-op3" type="radio" name="radio-currency">
                                            <label class="form-check-label" for="salary-op3">2-3 lacs <span>(235)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="salary-op4" type="radio" name="radio-currency">
                                            <label class="form-check-label" for="salary-op4">3-4 lacs <span>(568)</span></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="salary-op5" type="radio" name="radio-currency">
                                            <label class="form-check-label" for="salary-op5">4-5 lacs <span>(798)</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#job-function" class="collapsed">
                                            Job Function
                                        </a>
                                    </h6>
                                </div>
                                <div id="job-function" class="acod-body collapse">
                                    <div class="acod-content">
                                        <div class="form-check">
                                            <input class="form-check-input" id="function-services-1" type="radio" name="radio-function">
                                            <label class="form-check-label" for="function-services-1">Production Management <span>(120)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="function-services-2" type="radio" name="radio-function">
                                            <label class="form-check-label" for="function-services-2">Design Engineering <span>(300)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="function-services-3" type="radio" name="radio-function">
                                            <label class="form-check-label" for="function-services-3">Safety/ Health <span>(235)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="function-services-4" type="radio" name="radio-function">
                                            <label class="form-check-label" for="function-services-4">Engineering <span>(568)</span></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="function-services-5" type="radio" name="radio-function">
                                            <label class="form-check-label" for="function-services-5">Product Development <span>(798)</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#industry" class="collapsed">
                                            Industry
                                        </a>
                                    </h6>
                                </div>
                                <div id="industry" class="acod-body collapse">
                                    <div class="acod-content">
                                        <div class="form-check">
                                            <input class="form-check-input" id="industry1" type="radio" name="radio-industry">
                                            <label class="form-check-label" for="industry1">Telecom <span>(5)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="industry2" type="radio" name="radio-industry">
                                            <label class="form-check-label" for="industry2">Consulting Services <span>(10)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="industry3" type="radio" name="radio-industry">
                                            <label class="form-check-label" for="industry3">Engineering/Projects <span>(15)</span> </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="industry4" type="radio" name="radio-industry">
                                            <label class="form-check-label" for="industry4">Manufacturing/Industrial <span>(12)</span></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" id="industry5" type="radio" name="radio-industry">
                                            <label class="form-check-label" for="industry5">Architecture/Interior Design <span>(8)</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
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
                        <ul id="job-list" class="post-job-bx">
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
<script>
    $(function() {
        const jobsPerPage = 10;
        let currentPage = 1;
        let allJobs = [];

        // Fetch jobs data from Laravel API
        $.ajax({
            url: "{{ route('getJobsData') }}",
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

            // Append job items
            paginatedJobs.forEach(job => {
                $('#job-list').append(`
                    <li>
                        <div class="post-bx">
                            <div class="d-flex m-b30">
                                <div class="job-post-company">
                                    <a href="${job.jobDetailsRoute}"><span>
                                            <img alt="" src="${job.company_logo_image}" />
                                        </span></a>
                                </div>
                                <div class="job-post-info">
                                    <h4><a href="${job.jobDetailsRoute}">${job.job_title}</a></h4>
                                    <ul>
                                        <li><i class="fas fa-map-marker-alt"></i> ${job.company_address}</li>
                                        <li><i class="far fa-bookmark"></i> ${job.jobType}</li>
                                        <li><i class="far fa-clock"></i> Published ${job.time} ago</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="job-time me-auto">
                                    <a href="javascript:void(0);"><span>${job.workType}</span></a>
                                </div>
                                <div class="salary-bx">
                                    <span>${job.salary_range}</span>
                                </div>
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
    });
</script>
@endsection