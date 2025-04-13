<div class="search-area">
    <div class="search-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('findJobFilter')}}" class="row d-md-flex justify-content-between" id="findJobForm" method="post">
                            @csrf
                            <div class="col-lg-3">
                                <input type="text" name="job_title" id="jobTitleFilter" placeholder="Job Title" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Job Title'">
                            </div>
                            <div class="col-lg-3">
                                <select class="select2 search-area" name="job_category_id"  id="jobCategoryFilter" data-error="#error_job_category_id">
                                    <option value="">Job Category</option>
                                    @foreach($jobCategories as $jobCategory)
                                    <option value="{{ $jobCategory->id }}">{{ $jobCategory->name }}</option>
                                    @endforeach
                                </select>
                                <span class="error" id="error_job_category_id"></span>
                            </div>
                            <div class="col-lg-3">
                                <input type="hidden" id="currentLocationId" value="">
                                <input type="hidden" id="currentLocationName" value="">
                                <select class="select2 search-area" name="job_location_id" id="jobLocationFilter" data-error="#error_job_location_id">
                                    <option value="">Job Location</option>
                                </select>
                                <span class="error" id="error_job_location_id"></span>
                            </div>
                            <div class="col-lg-3 text-center">
                                <button type="submit" class="template-btn">find job</button>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <span class="error" id="error_find_filter"></span>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>