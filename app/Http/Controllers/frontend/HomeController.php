<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Services\JobCategoryService;

class HomeController extends Controller
{
    private $jobCategoryService;

    public function __construct(
        JobCategoryService $jobCategoryService,
    ) {
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
        return view('frontend.home', compact('jobCategories'));
    }
}
