<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobFormRequest;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\DesignationService;
use App\Services\JobCategoryService;
use App\Services\JobService;
use App\Services\JobTypeService;
use App\Services\StateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployerController extends Controller
{
    private $jobService;
    private $countryService;
    private $stateService;
    private $cityService;
    private $jobCategoryService;
    private $designationService;
    private $jobTypeService;

    public function __construct(
        JobService $jobService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService,
        JobCategoryService $jobCategoryService,
        DesignationService $designationService,
        JobTypeService $jobTypeService
    ) {
        $this->jobService = $jobService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
        $this->jobCategoryService = $jobCategoryService;
        $this->designationService = $designationService;
        $this->jobTypeService = $jobTypeService;
    }

    /**
     * ****************************
     * method use to view profile
     * ----------------------------
     * @param int $authId
     * @return jsonResponse
     * ****************************
     */
    public function myProfile()
    {
        $title = getEnum('users', 'title');
        $genders = getEnum('users', 'gender');
        $states = [];
        $cities = [];
        $countries = $this->countryService->getAllCountry();
        return view(
            'frontend.employer.my-profile',
            compact(
                'title',
                'genders',
                'countries'
            )
        );
    }

    /**
     * ************************************
     * method use to view company profile
     * ------------------------------------
     * @param int $authId
     * @return jsonResponse
     * ************************************
     */
    public function companyProfile()
    {
        $states = [];
        $cities = [];
        $countries = $this->countryService->getAllCountry();
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        return view(
            'frontend.employer.company-profile',
            compact(
                'countries',
                'jobCategories'
            )
        );
    }

    /**
     * ************************************
     * method use to view copany job post
     * ------------------------------------
     * @param int $authId
     * @return jsonResponse
     * ************************************
     */
    public function companyJobPost()
    {
        $states = [];
        $cities = [];
        $countries = $this->countryService->getAllCountry();
        $designations = $this->designationService->getAllDesignations();
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        $jobTypes = $this->jobTypeService->getAllJobTypes();
        $genders = getEnum('users', 'gender');
        $englishLevels = getEnum('jobs', 'english_level');
        return view(
            'frontend.employer.company-job-post',
            compact(
                'countries',
                'designations',
                'jobCategories',
                'jobTypes',
                'genders',
                'englishLevels'
            )
        );
    }

    /**
     * **************************************
     * Method is used to view add job form
     * --------------------------------------
     * @return view
     * **************************************
     */
    public function addUpdateJob(JobFormRequest $request)
    {
        try {
            $inputArray = $this->validateJobInput($request);
            $this->jobService->addUpdateJob($inputArray);
            $msg = $inputArray['jobId'] == 0 ? 'Job added successfully!' : 'Job updated successfully!';
            saveActivityLog('Job', $msg);
            return response()->json(
                [
                    'status' => true,
                    'msg' => $msg,
                    'redirectRoute' => route('jobs')
                ]
            );
        } catch (Exception $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }

    /**
     *********************************************
     * Function use to validate job  input
     * -------------------------------------------
     * @param object $request
     * @return object request
     * @description input ('name', 'jobTypeId')
     *********************************************
     */
    private function validateJobInput(Request $request)
    {
        return $request->only(
            [
                'jobId',
                'job_title',
                'designation_id',
                'job_category_id',
                'job_type_id',
                'work_type_id',
                'country_id',
                'state_id',
                'city_id',
                'experience',
                'year_experience',
                'month_experience',
                'salary_range',
                'vacancy',
                'deadline',
                'gender',
                'english_level',
                'skills',
                'job_description',
                'job_responsibility',
                'educational_requirements',
                'other_benefits'
            ]
        );
    }

    /**
     * ***************************************
     * method use to view copany transactions
     * ---------------------------------------
     * @param int $authId
     * @return jsonResponse
     * ***************************************
     */
    public function companyTransactions()
    {
        return view('frontend.employer.transaction');
    }

    /**
     * ***************************************
     * method use to view copany transactions
     * ---------------------------------------
     * @param int $authId
     * @return jsonResponse
     * ***************************************
     */
    public function companyManageJobs()
    {
        return view('frontend.employer.company-manage-job');
    }

    /**
     * ***************************************
     * method use to view copany transactions
     * ---------------------------------------
     * @param int $authId
     * @return jsonResponse
     * ***************************************
     */
    public function companyResume()
    {
        return view('frontend.employer.company-resume');
    }

    /**
     * ***************************************
     * method use to view copany transactions
     * ---------------------------------------
     * @param int $authId
     * @return jsonResponse
     * ***************************************
     */
    public function employerChangePassword()
    {
        return view('frontend.employer.change-password');
    }
}
