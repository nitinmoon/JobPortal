@extends('frontend.layouts.app')

@section('title', 'Jobs')

@section('content')
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle">
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
                            <div class="form-group {{ isset($_GET['job_title']) && $_GET['job_title'] != '' ? 'focused' : '' }}">
                                <label>Job Title, Keywords, or Phrase</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="job_title" placeholder="" value="{{ isset($_GET['job_title']) ? $_GET['job_title'] : '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group {{ isset($_GET['location']) && $_GET['location'] != '' ? 'focused' : '' }}">
                                <label>City, State or Country</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="location" placeholder="" value="{{ isset($_GET['location']) ? $_GET['location'] : '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <span id="error_location" class="error"></span>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select id="job_category_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Select Category</option>
                                    @foreach($jobCategories as $jobCategory)
                                    <option value="{{ $jobCategory->id }}" {{ isset($_GET['job_category_id']) && base64_decode($_GET['job_category_id']) == $jobCategory->id ? 'selected' : '' }}>{{ $jobCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <button type="button" class="site-button btn-block" id="findJobBtn">Find Job</button>
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
                            <h6 class="title"><i class="fa fa-sliders m-r5"></i> Refined By <a href="javascript:void(0);" class="font-12 float-end" id="resetAll">Reset All</a></h6>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#jobCategories">
                                            Job Categories
                                        </a>
                                    </h6>
                                </div>
                                <div id="jobCategories" class="acod-body collapse show">
                                    <div class="acod-content">
                                        @foreach($jobCategories as $jobCategory)
                                        <div class="form-check">
                                            <input class="form-check-input job_category" id="job_category_{{ $jobCategory->id }}" type="checkbox" name="job_category[]" value="{{ $jobCategory->id }}" {{ isset($_GET['job_category_id']) && base64_decode($_GET['job_category_id']) == $jobCategory->id ? 'checked' : '' }}>
                                            <label class="form-check-label" for="job_category_{{ $jobCategory->id }}">
                                                {{ $jobCategory->name }}
                                                <!-- <span>(50)</span> -->
                                            </label>
                                        </div>
                                        @endforeach
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
                                        @foreach($experienceOptions as $key => $experience)
                                        <div class="form-check">
                                            <input class="form-check-input experience" id="experience_{{ $key }}" type="radio" name="experience" value="{{ $experience }}">
                                            <label class="form-check-label" for="experience_{{ $key }}">
                                                {{ $experience }}
                                                <!-- <span>(120)</span> -->
                                            </label>
                                        </div>
                                        @endforeach
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
                                        @foreach($salaryRangeOptions as $key => $salaryRange)
                                        <div class="form-check">
                                            <input class="form-check-input salary_range" id="salary_range_{{ $key }}" type="radio" name="salary_range" value="{{ $salaryRange }}">
                                            <label class="form-check-label" for="salary_range_{{ $key }}">
                                                {{ $salaryRange }}
                                                <!-- <span>(120)</span> -->
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#jobType" class="collapsed">
                                            Job Type
                                        </a>
                                    </h6>
                                </div>
                                <div id="jobType" class="acod-body collapse">
                                    <div class="acod-content">
                                        @foreach($jobTypes as $jobType)
                                        <div class="form-check">
                                            <input class="form-check-input job_type" id="job_type_{{ $jobType->id }}" type="radio" name="job_type" value="{{ $jobType->id }}">
                                            <label class="form-check-label" for="job_type_{{ $jobType->id }}">
                                                {{ $jobType->name }}
                                                <!-- <span>(120)</span> -->
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title">
                                        <a data-bs-toggle="collapse" href="#workType" class="collapsed">
                                            Work Type
                                        </a>
                                    </h6>
                                </div>
                                <div id="workType" class="acod-body collapse">
                                    <div class="acod-content">
                                        @foreach(getJobWorkType() as $workType)
                                        <div class="form-check">
                                            <input class="form-check-input work_type" id="work_type_{{ $workType->id }}" type="radio" name="work_type" value="{{ $workType->id }}">
                                            <label class="form-check-label" for="work_type_{{ $workType->id }}">
                                                {{ $workType->name }}
                                                <!-- <span>(120)</span> -->
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="job-bx-title clearfix">
                            <h5 class="font-weight-700 float-start text-uppercase"><span id="jobCount"></span> Jobs Found</h5>
                            <!-- <div class="float-end">
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
                            </div> -->
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
        $('#findJobBtn').click(function() {
            var job_title = $('#job_title').val();
            var place = $('#location').val();
            var job_category_id = $('#job_category_id').val();
            if(job_title == '' && place == '' && job_category_id == '') {
                $('#error_location').html('Please select at least one filter');
                return false;
            }
            getAllJobs();
        });

        $('.job_category').click(function() {
            getAllJobs();
        });

        $('.experience').click(function() {
            getAllJobs();
        });

        $('.salary_range').click(function() {
            getAllJobs();
        });

        $('.job_type').click(function() {
            getAllJobs();
        });

        $('.work_type').click(function() {
            getAllJobs();
        });

        $('#job_title, #location, #job_category_id').change(function() {
            $('#error_location').html('');
        });

        $('#resetAll').click(function() {
            $('input[type="checkbox"]').prop('checked', false);
            $('input[name="experience"]').prop('checked', false);
            $('input[name="salary_range"]').prop('checked', false);
            $('input[name="job_type"]').prop('checked', false);
            $('input[name="work_type"]').prop('checked', false);
            getAllJobs();
        });

        getAllJobs();

        const jobsPerPage = 10;
        let currentPage = 1;
        let allJobs = [];

        function getAllJobs() {

            var job_category = $('input[name="job_category[]"]:checked').map(function() {
                return this.value;
            }).get();

            // Fetch jobs data from Laravel API
            $.ajax({
                url: "{{ route('getJobsData') }}",
                method: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'job_title' : $('#job_title').val(),
                    'location' : $('#location').val(),
                    'job_category_id' : $('#job_category_id').val(),
                    'job_category' : job_category,
                    'experience' : $('input[name="experience"]:checked').val(),
                    'salary_range' : $('input[name="salary_range"]:checked').val(),
                    'job_type' : $('input[name="job_type"]:checked').val(),
                    'work_type' : $('input[name="work_type"]:checked').val()
                },
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
        }

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
                                        <li><i class="far fa-clock"></i> Published ${job.time}</li>
                                        <li><i class="far fa-clock"></i> Deadline: ${job.deadline}</li>
                                    </ul>
                                </div>
                                </div>
                                <div class="d-flex">
                                <div class="job-time me-auto">
                                <a href="javascript:void(0);"><span>${job.workType}</span></a>&emsp;
                                <a href="${job.jobDetailsRoute}" class="site-button style-3 viewJobBtn">View Job</a>
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