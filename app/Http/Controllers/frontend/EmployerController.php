<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\DesignationService;
use App\Services\EmployerService;
use App\Services\JobCategoryService;
use App\Services\JobTypeService;
use App\Services\StateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployerController extends Controller
{
    private $employerService;
    private $countryService;
    private $stateService;
    private $cityService;
    private $jobCategoryService;
    private $designationService;
    private $jobTypeService;

    public function __construct(
        EmployerService $employerService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService,
        JobCategoryService $jobCategoryService,
        DesignationService $designationService,
        JobTypeService $jobTypeService
    ) {
        $this->employerService = $employerService;
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
        $userDetails = $this->employerService->getUserDetails(auth()->user()->id);
        $title = getEnum('users', 'title');
        $genders = getEnum('users', 'gender');
        $states = [];
        $cities = [];
        if (isset($userDetails->country_id) && $userDetails->country_id != '') {
            $states = $this->stateService->getState($userDetails->country_id);
        }
        if (isset($userDetails->state_id) && $userDetails->state_id != '') {
            $cities = $this->cityService->getCity($userDetails->state_id);
        }
        $countries = $this->countryService->getAllCountry();
        return view(
            'frontend.employer.my-profile',
            compact(
                'title',
                'genders',
                'countries',
                'userDetails',
                'states',
                'cities'
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
        $employerDetails = $this->employerService->getEmployerDetails(auth()->user()->id);
        $states = [];
        $cities = [];
        if (isset($employerDetails->country_id) && $employerDetails->country_id != '') {
            $states = $this->stateService->getState($employerDetails->country_id);
        }
        if (isset($employerDetails->state_id) && $employerDetails->state_id != '') {
            $cities = $this->cityService->getCity($employerDetails->state_id);
        }
        $countries = $this->countryService->getAllCountry();
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        return view(
            'frontend.employer.company-profile',
            compact(
                'countries',
                'jobCategories',
                'employerDetails',
                'states',
                'cities'
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
        $genders = getEnum('users', 'gender');
        $englishLevels = getEnum('jobs', 'english_level');
        return view(
            'frontend.employer.company-job-post',
            compact(
                'countries',
                'genders',
                'englishLevels'
            )
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

    /**
     * ********************************
     * method use to update my profile
     * --------------------------------
     * @param int $authId
     * @return jsonResponse
     * ********************************
     */
    public function updateProfile(Request $request)
    {
        try {
            $inputArray = $this->validateMyProfileInput($request);
            $this->employerService->updateMyProfile($inputArray);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Profile updated successfully!",
                    'redirectRoute' => route('companyProfile')
                ]
            );
        } catch (Exception $exception) {
            Log::channel('exceptionLog')->error("Exception: ".$exception->getMessage().' in '.$exception->getFile().' StackTrace:'.$exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }

    /**
     ******************************************
     * Function use to validate my profile input
     * ----------------------------------------
     * @param object $request
     * @return object request
     ******************************************
     */
    private function validateMyProfileInput(Request $request)
    {
        return $request->only(
            [
                'userId',
                'title',
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'phone',
                'dob',
                'gender',
                'address',
                'zip',
                'country_id',
                'state_id',
                'city_id',
            ]
        );
    }

    /**
     * **************************************
     * method use to update company profile
     * --------------------------------------
     * @param int $authId
     * @return jsonResponse
     * **************************************
     */
    public function updateCompanyProfile(Request $request)
    {
        try {
            $inputArray = $this->validateCompanyProfileInput($request);
            $this->employerService->updateCompanyProfile($inputArray);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Company profile updated successfully!",
                    'redirectRoute' => route('companyJobPost')
                ]
            );
        } catch (Exception $exception) {
            Log::channel('exceptionLog')->error("Exception: ".$exception->getMessage().' in '.$exception->getFile().' StackTrace:'.$exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }

    /**
     ******************************************
     * Function use to validate my profile input
     * ----------------------------------------
     * @param object $request
     * @return object request
     ******************************************
     */
    private function validateCompanyProfileInput(Request $request)
    {
        return $request->only(
            [
                'employerId',
                'company_name',
                'company_website',
                'company_contact_person',
                'company_contact_email',
                'company_contact_no',
                'job_category_id',
                'foundation_date',
                'no_of_employees',
                'gst_number',
                'company_description',
                'company_address',
                'zip',
                'country_id',
                'state_id',
                'city_id',
            ]
        );
    }
}
