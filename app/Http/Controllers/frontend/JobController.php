<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    private $jobService;

    public function __construct(
        JobService $jobService
    ) {
        $this->jobService = $jobService;
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
        // $jobCategories = $this->jobCategoryService->getAllJobCategory();
        return view('frontend.job.index');
    }

    public function getJobsData()
    {
        $jobs = $this->jobService->getAllJobs();
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
