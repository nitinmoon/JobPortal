<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Services\JobCategoryService;
use App\Services\JobService;

class HomeController extends Controller
{
    private $jobService;
    private $jobCategoryService;

    public function __construct(
        JobService $jobService,
        JobCategoryService $jobCategoryService,
    ) {
        $this->jobService = $jobService;
        $this->jobCategoryService = $jobCategoryService;
    }

    /**
     * **********************************
     * Method is used to view home page
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function index()
    {
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        $jobs = $this->jobService->getAllJobs();
        return view('frontend.home', compact('jobs', 'jobCategories'));
    }
}
