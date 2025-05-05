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
        $jobs = $this->jobService->getAllJobs();
        return view('frontend.job.index', compact('jobs'));
    }
}
