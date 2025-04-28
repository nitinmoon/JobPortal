<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUpdateEmployerInputRequest;
use App\Http\Requests\EmployerProfileInputRequest;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\EmployerService;
use App\Services\StateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Constants\UserRoleConstants;
use App\Services\DesignationService;
use App\Services\JobCategoryService;
use App\Services\JobTypeService;

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
     * ***********************************
     * function used to employer logout
     * -----------------------------------
     * @return redirect
     * ***********************************
     */
    public function employerLogout()
    {
        Auth::logout();
        return redirect(route('employerLogin'));
    }

    /**
     * **************************************
     * Method is used to view employer list
     * --------------------------------------
     * @param object $request
     * @return view
     * **************************************
     */
    public function index(Request $request)
    {
        if (auth()->user()->role_id != UserRoleConstants::SUPER_ADMIN) {
            return back();
        }
        if ($request->ajax()) {
            return $this->employerService->employerAjaxDatatable($request);
        }
        $jobType = getJobType();
        return view('backend.employer.index', compact('jobType'));
    }

    /**
     * *******************************
     * Method use to delete employer
     * -------------------------------
     * @param int $employerId
     * @return jsonResponse
     * *******************************
     */
    public function deleteEmployer($employerId)
    {
        try {
            $this->employerService->deleteEmployer($employerId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => trans('candidate.delete_msg')
                ]
            );
        } catch (Exception  $exception) {
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
     * ****************************
     * method to restore employer
     * ----------------------------
     * @param int $employerId
     * @return jsonResponse
     * *******************************
     */
    public function restoreEmployer($employerId)
    {
        try {
            $this->employerService->restoreEmployer($employerId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => trans('employer.restore_msg')
                ]
            );
        } catch (Exception  $exception) {
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
     * ******************************************
     * Function used to change employer status
     * ------------------------------------------
     * @param object $request
     * @return jsonResponse
     * ******************************************
     */
    public function changeEmployerStatus(Request $request)
    {
        try {
            $this->employerService->changeEmployerStatus($request);
            $msg = $request->status == 1 ?  'Status active successfully!' : 'Status inactive successfully!';
            // saveActivityLog('Job', $msg);
            return response()->json(
                [
                    'status' => true,
                    'msg' => $msg
                ]
            );
        } catch (Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json([
                'status' => false,
                'msg' => $exception->getMessage()
            ]);
        }
    }

    /**
     * *****************************
     * method use to view employer
     * -----------------------------
     * @param int $employerId
     * @return jsonResponse
     * ******************************
     */
    public function viewEmployer($employerId)
    {
        $userDetails = $this->employerService->getUserDetails(base64_decode($employerId));
        $employerDetails = $this->employerService->getEmployerDetails(base64_decode($employerId));
        return view(
            'backend.employer.view-employer',
            compact(
                'employerDetails',
                'userDetails'
            )
        );
    }

    /**
     * ******************************************
     * Method is used to view add employer form
     * ------------------------------------------
     * @return view
     * ******************************************
     */
    public function addEmployer()
    {
        $title = getEnum('users', 'title');
        $gender = getEnum('users', 'gender');
        $skills =  getSkills();
        $states = [];
        $cities = [];
        // if (isset($candidateDetails->country_id) && $candidateDetails->country_id != '') {
        //     $states = $this->stateService->getState($candidateDetails->country_id);
        // }
        // if (isset($candidateDetails->state_id) && $candidateDetails->state_id != '') {
        //     $cities = $this->cityService->getCity($candidateDetails->state_id);
        // }
        $countries = $this->countryService->getAllCountry();
        return view('backend.employer.add-edit-employer', compact('title', 'gender', 'skills', 'countries'));
    }

    /**
     * **********************************
     * method use to add update employer
     * ----------------------------------
     * @param object $request
     * @return jsonResponse
     * **********************************
     */
    public function addUpdateEmployer(AddUpdateEmployerInputRequest $request)
    {
        // try {
        $inputArray = $this->validateEmployerInput($request);
        $this->employerService->addUpdateEmployer($inputArray);
        $msg = $inputArray['employerId'] == 0 ? 'Employer added successfully!' : 'Employer updated successfully!';
        return response()->json(
            [
                'status' => true,
                'msg' => $msg,
                'redirectRoute' => route('employers')
            ]
        );
        // } catch (Exception  $exception) {
        //     Log::channel('exceptionLog')->error("Exception: ".$exception->getMessage().' in '.$exception->getFile().' StackTrace:'.$exception->getTraceAsString());
        //     return response()->json(
        //         [
        //             'status' => false,
        //             'msg' => $exception->getMessage()
        //         ]
        //     );
        // }
    }

    /**
     ******************************************
     * Function use to validate employer input
     * ----------------------------------------
     * @param object $request
     * @return object request
     ******************************************
     */
    private function validateEmployerInput(Request $request)
    {
        return $request->only(
            [
                'employerId',
                'title',
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'phone',
                'dob',
                'gender',
                'company_address',
                'zip',
                'country_id',
                'state_id',
                'city_id',
                'company_name',
                'company_contact_person',
                'company_contact_email',
                'company_contact_no',
                'company_description',
                'company_logo',
                'foundation_date',
                'no_of_employees',
                'gst_no'
            ]
        );
    }

    /**
     * **************************************
     * Method is used to view edit employer
     * --------------------------------------
     * @return view
     * **************************************
     */
    public function editEmployer($employerId)
    {
        $employerDetails = $this->employerService->getEmployerDetails(base64_decode($employerId));
        $countries = $this->countryService->getAllCountry();
        $states = [];
        $cities = [];
        if (isset($employerDetails->country_id) && $employerDetails->country_id != '') {
            $states = $this->stateService->getState($employerDetails->country_id);
        }
        if (isset($employerDetails->state_id) && $employerDetails->state_id != '') {
            $cities = $this->cityService->getCity($employerDetails->state_id);
        }
        $gender = getEnum('users', 'gender');
        $title = getEnum('users', 'title');
        return view('backend.employer.add-edit-employer', compact(
            'employerDetails',
            'countries',
            'states',
            'cities',
            'gender',
            'title',
        ));
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
     * ****************************
     * method use to view profile
     * ----------------------------
     * @param int $authId
     * @return jsonResponse
     * ****************************
     */
    // public function myProfile()
    // {
    //     if (auth()->user()->role_id == UserRoleConstants::USER_ROLE_CANDIDATE) {
    //         return back();
    //     }
    //     $employerDetails = $this->employerService->getEmployerDetails(auth()->user()->id);
    //     // dd($employerDetails);
    //     $title = getEnum('users', 'title');
    //     $gender = getEnum('users', 'gender');
    //     $countries = $this->countryService->getAllCountry();
    //     $states = [];
    //     $cities = [];
    //     if (isset($employerDetails->country_id) && $employerDetails->country_id != '') {
    //         $states = $this->stateService->getState($employerDetails->country_id);
    //     }
    //     if (isset($employerDetails->state_id) && $employerDetails->state_id != '') {
    //         $cities = $this->cityService->getCity($employerDetails->state_id);
    //     }
    //     return view(
    //         'backend.profile.my-profile',
    //         compact(
    //             'employerDetails',
    //             'title',
    //             'gender',
    //             'countries',
    //             'states',
    //             'cities',
    //         )
    //     );
    // }

    // public function updateEmployerProfile(EmployerProfileInputRequest $request)
    // {
    //     try {
    //         $inputArray = $this->validateEmployerProfileInput($request);
    //         $this->employerService->updateEmployerProfile($inputArray);
    //         return response()->json(
    //             [
    //                 'status' => true,
    //                 'msg' => 'Profile updated successfully!'
    //             ]
    //         );
    //     } catch (Exception $exception) {
    //         Log::channel('exceptionLog')->error("Exception: ".$exception->getMessage().' in '.$exception->getFile().' StackTrace:'.$exception->getTraceAsString());
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'msg' => $exception->getMessage()
    //             ]
    //         );
    //     }
    // }

    /**
     ******************************************
     * Function use to validate employer input
     * ----------------------------------------
     * @param object $request
     * @return object request
     ******************************************
     */
    // private function validateEmployerProfileInput(Request $request)
    // {
    //     return $request->only(
    //         ['employerId', 'title', 'first_name', 'middle_name', 'last_name', 'email', 'phone', 'dob', 'gender', 'company_address',
    //          'zip', 'country_id', 'state_id', 'city_id', 'company_name', 'company_description', 'company_contact_person', 'company_contact_email',
    //           'company_contact_no', 'company_logo', 'foundation_date', 'no_of_employees', 'gst_no']
    //     );
    // }

    /**
     * *********************************************
     * method used to complete search of candidates
     * ---------------------------------------------
     *
     * @param  request
     * @return jsonResponse
     * ***************************************
     */
    public function autoCompleteSearchEmployer(Request $request)
    {
        $users = [];
        $searchString = $request->only(['q']);
        if (isset($searchString['q']) && trim($searchString['q']) != '') {
            $users = $this->employerService->autoCompleteSearchEmployer($searchString['q']);
        } else {
            $users = $this->employerService->autoCompleteSearchEmployer();
        }
        return response()->json($users);
    }
}
