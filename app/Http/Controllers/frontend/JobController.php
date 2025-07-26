<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Services\JobCategoryService;
use App\Services\JobService;
use App\Services\JobTypeService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    private $jobService;
    private $jobCategoryService;
    private $jobTypeService;

    public function __construct(
        JobService $jobService,
        JobCategoryService $jobCategoryService,
        JobTypeService $jobTypeService
    ) {
        $this->jobService = $jobService;
        $this->jobCategoryService = $jobCategoryService;
        $this->jobTypeService = $jobTypeService;
    }

    /**
     * **********************************
     * Method is used to view job page
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function index()
    {
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        $jobTypes = $this->jobTypeService->getAllJobTypes();
        $experienceOptions = [
            '0 - 1 Years',
            '1 - 3 Years',
            '3 - 5 Years',
            '5 - 7 Years',
            'Above 7+',
        ];
        $salaryRangeOptions = [
            '1 - 2 Lacs',
            '2 - 3 Lacs',
            '3 - 4 Lacs',
            '4 - 5 Lacs',
            '5 - 6 Lacs',
            '6 - 7 Lacs',
            '7 - 8 Lacs',
            '8 - 9 Lacs',
            '9 - 10 Lacs',
            '10 - 15 Lacs',
            'Above 15+',
        ];
        return view('frontend.job.index', compact(
            'jobCategories',
            'jobTypes',
            'experienceOptions',
            'salaryRangeOptions'
        ));
    }

    public function getJobsData(Request $request)
    {
        $jobs = $this->jobService->getAllJobs($request);
        $jobsCount = count($jobs);
        return response()->json([
            'jobs' => $jobs,
            'jobsCount' => $jobsCount
        ]);
    }

    /**
     * **********************************
     * Method is used to view job details
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function jobDetails($jobId)
    {
        $jobDetails = $this->jobService->getJobDetails(base64_decode($jobId));
        // $jobCategories = $this->jobCategoryService->getAllJobCategory();
        return view('frontend.job.job-details', compact('jobDetails'));
    }
}
