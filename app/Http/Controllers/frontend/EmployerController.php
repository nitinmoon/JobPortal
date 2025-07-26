<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\CompanyLogoRequest;
use App\Http\Requests\JobFormRequest;
use App\Models\Constants\UserRoleConstants;
use App\Services\ApplyJobService;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\DesignationService;
use App\Services\JobCategoryService;
use App\Services\EmployerService;
use App\Services\JobService;
use App\Services\JobTypeService;
use App\Services\LoginService;
use App\Services\SkillService;
use App\Services\StateService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class EmployerController extends Controller
{
    private $jobService;
    private $employerService;
    private $countryService;
    private $stateService;
    private $cityService;
    private $jobCategoryService;
    private $designationService;
    private $jobTypeService;
    private $loginService;
    private $userService;
    private $skillService;
    private $applyJobService;

    public function __construct(
        JobService $jobService,
        EmployerService $employerService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService,
        JobCategoryService $jobCategoryService,
        DesignationService $designationService,
        JobTypeService $jobTypeService,
        LoginService $loginService,
        UserService $userService,
        SkillService $skillService,
        ApplyJobService $applyJobService
    ) {
        $this->jobService = $jobService;
        $this->employerService = $employerService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
        $this->jobCategoryService = $jobCategoryService;
        $this->designationService = $designationService;
        $this->jobTypeService = $jobTypeService;
        $this->loginService = $loginService;
        $this->userService = $userService;
        $this->skillService = $skillService;
        $this->applyJobService = $applyJobService;
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
        if (auth()->user()->role_id != UserRoleConstants::EMPLOYER) {
            return back();
        }
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
        return view('frontend.employer.my-profile',
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
        $countries = $this->countryService->getAllCountry();
        $states = [];
        $cities = [];
        if (isset($employerDetails->country_id) && $employerDetails->country_id != '') {
            $states = $this->stateService->getState($employerDetails->country_id);
        }
        if (isset($employerDetails->state_id) && $employerDetails->state_id != '') {
            $cities = $this->cityService->getCity($employerDetails->state_id);
        }
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        return view('frontend.employer.company-profile',
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
    public function companyJobPost($jobId = '')
    {
        $jobId = base64_decode($jobId);
        $jobDetails = $this->jobService->getJobDetails($jobId);
        $countries = $this->countryService->getAllCountry();
        $states = [];
        $cities = [];
        if (isset($jobDetails->country_id) && $jobDetails->country_id != '') {
            $states = $this->stateService->getState($jobDetails->country_id);
        }
        if (isset($jobDetails->state_id) && $jobDetails->state_id != '') {
            $cities = $this->cityService->getCity($jobDetails->state_id);
        }
        $designations = $this->designationService->getAllDesignations();
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        $jobTypes = $this->jobTypeService->getAllJobTypes();
        $genders = getEnum('jobs', 'gender');
        $englishLevels = getEnum('jobs', 'english_level');
        $skills = $this->skillService->getAllSkills();
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
        return view('frontend.employer.company-job-post', compact(
            'countries',
            'states',
            'cities',
            'designations',
            'jobCategories',
            'jobTypes',
            'genders',
            'englishLevels',
            'skills',
            'jobDetails',
            'experienceOptions',
            'salaryRangeOptions'
        ));
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
        // try {
            $inputArray = $this->validateJobInput($request);
            $this->jobService->addUpdateJob($inputArray);
            $msg = $inputArray['jobId'] == 0 ? 'Job added successfully!' : 'Job updated successfully!';
            return response()->json(
                [
                    'status' => true,
                    'msg' => $msg,
                    'redirectRoute' => route('companyManageJobs')
                ]
            );
        // } catch (Exception $exception) {
        //     Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
        //     return response()->json(
        //         [
        //             'status' => false,
        //             'msg' => $exception->getMessage()
        //         ]
        //     );
        // }
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
                'salary_range',
                'vacancy',
                'deadline',
                'gender',
                'english_level',
                'skills',
                'job_description',
                'job_responsibility',
                'educational_requirements',
                'other_benefits',
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
            $this->userService->updateMyProfile($inputArray);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Profile updated successfully!",
                    'redirectRoute' => route('companyProfile')
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
                'foundation_date',
                'no_of_employees',
                'gst_no',
                'company_description',
                'company_address',
                'zip',
                'country_id',
                'state_id',
                'city_id',
            ]
        );
    }

    /**
     * *******************************
     * method used to change password
     * -------------------------------
     * @param object $request
     * *******************************
    */
    public function changeEmployerPassword(AdminChangePasswordRequest $request)
    {
        $credentials = $this->validatechangePasswordRequest($request);
        if (!Hash::check($credentials['current_password'], auth()->user()->password)) {
            return response()->json(['status' => 2, 'msg' => "Old password does not matched!"]);
        }
        $this->loginService->changePassword($credentials);
        return response()->json(['status' => 1, 'msg' => "Password updated successfully!", 'redirect_url' => route('logout')]);
    }

    /**
     * ***********************************************
     * method used to validate change password input
     *------------------------------------------------
     * @param object $request
     * @return request
     *************************************************
     */
    private function validatechangePasswordRequest(Request $request)
    {
        return $request->only(['current_password', 'password', 'confirm_password']);
    }

    /**
     * **************************************
     * method to update profile image detail
     * --------------------------------------
     * @param request
     * @param userId
     * @return redirect
     * @description input ('profile_photo')
     * @description (with success message)
     * *****************************************
     */
    public function updateCompanyLogo(CompanyLogoRequest $request)
    {
        // try {
            $inputArray = $this->validateLogoImage($request);
            $imageName  = time().'.'.$inputArray['company_logo']->extension();
            $imagepath = config('constants.COMPANY_LOGO_PATH');
            if (!file_exists($imagepath)) {
                mkdir($imagepath, 0777, true);
            }
            $inputArray['company_logo']->move(config('constants.COMPANY_LOGO_PATH'), $imageName);
            $inputArray['company_logo'] = $imageName;
            $this->employerService->updateCompanyLogo(auth()->user()->id, $inputArray);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Logo updated successfully!"
                ]
            );
        // } catch (\Exception  $exception) {
        //     return back()->withError($exception->getMessage())->withInput();
        // }
    }

    /**
     * ********************************************
     * method used to validate profile photo input
     * --------------------------------------------
     * @param request
     * @return request
     * @description input ('profile_photo')
     * *********************************************
     */
    private function validateLogoImage(Request $request)
    {
        return $request->only(['company_logo']);
    }

    /**
     * ********************************************
     * method used to validate profile photo input
     * --------------------------------------------
     * @param request
     * @return request
     * @description input ('profile_photo')
     * *********************************************
    */
    public function getCandidateResumes()
    {
        $appliedJobs = $this->employerService->getCandidateResumes(auth()->user()->id);
        // dd($appliedJobs);
        $jobsCount = count($appliedJobs);
        return response()->json([
            'jobs' => $appliedJobs,
            'jobsCount' => $jobsCount
        ]);
    }

    /**
     * ********************************************
     * method used to get employer jobs
     * --------------------------------------------
     * @param request
     * @return request
     * @description input ('profile_photo')
     * *********************************************
    */
    public function getEmployerJobs()
    {
        $jobs = $this->jobService->getEmployerJobsList();
        $jobsCount = count($jobs);
        return response()->json([
            'jobs' => $jobs,
            'jobsCount' => $jobsCount
        ]);
    }

    /**
     * ********************************
     * Method to download resume
     *---------------------------------
     * @param fileName
     * @return Data
     **********************************
     */
    public function downloadCandidateResume($fileName = null)
    {
        try {
             $filePath = config('constants.CANDIDATE_RESUME_PATH') . "/" .$fileName;

            if (!File::exists($filePath)) {
                abort(404, 'Resume file not found.');
            }

            return response()->download($filePath);
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
     * ******************************************
     * Function used to change apply job status
     * ------------------------------------------
     * @param object $request
     * @return jsonResponse
     * ******************************************
     */
    public function changeApplyJobStatus(Request $request)
    {
        try {
            $inputArray = $this->validateApplyChangeStatusJobInput($request);
            $this->applyJobService->changeApplyJobStatus($inputArray);
            return response()->json(
                [
                    'status' => true,
                    'msg' => 'Status changed successfully!'
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
     *********************************************************
     * Function use to validate apply job change status input
     * -------------------------------------------------------
     * @param object $request
     * @return object request
     *********************************************************
     */
    private function validateApplyChangeStatusJobInput(Request $request)
    {
        return $request->only(
            [
                'id', 'status'
            ]
        );
    }
}
