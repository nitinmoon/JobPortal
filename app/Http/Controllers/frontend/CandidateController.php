<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Models\Constants\UserRoleConstants;
use App\Services\ApplyJobService;
use App\Services\CandidateService;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\DesignationService;
use App\Services\EmployerService;
use App\Services\JobCategoryService;
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

class CandidateController extends Controller
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
    private $applyJobService;
    private $candidateService;
    private $skillService;

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
        ApplyJobService $applyJobService,
        CandidateService $candidateService,
        SkillService $skillService
    ) {
        $this->employerService = $employerService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
        $this->jobCategoryService = $jobCategoryService;
        $this->designationService = $designationService;
        $this->jobTypeService = $jobTypeService;
        $this->loginService = $loginService;
        $this->userService = $userService;
        $this->applyJobService = $applyJobService;
        $this->candidateService = $candidateService;
        $this->skillService = $skillService;
    }

    /**
     * ****************************
     * method use to view profile
     * ----------------------------
     * @param int $authId
     * @return jsonResponse
     * ****************************
     */
    public function myProfile($flag = '')
    {
        if (auth()->user()->role_id != UserRoleConstants::CANDIDATE) {
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
        $designations = $this->designationService->getAllDesignations();
        // $languages = getLanguages();
        return view(
            'frontend.candidate.my-profile',
            compact(
                'title',
                'genders',
                'countries',
                'userDetails',
                'states',
                'cities',
                'designations',
                'flag'
            )
        );
    }

    /**
     * ********************************
     * method use to update my profile
     * --------------------------------
     * @param object $request
     * @return jsonResponse
     * ********************************
     */
    public function updateCandidateProfile(Request $request)
    {
        try {
            $inputArray = $this->validateMyProfileInput($request);
            $this->userService->updateMyProfile($inputArray);
            $redirectRoute = isset($inputArray['flag']) && $inputArray['flag'] == 'apply-job' ? route('candidateProfile') : route('myResume');
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Profile updated successfully!",
                    'redirectRoute' => $redirectRoute
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
                'flag',
                'job_id'
            ]
        );
    }

    /**
     * ****************************
     * method use to view profile
     * ----------------------------
     * @param int $authId
     * @return jsonResponse
     * ****************************
     */
    public function myResume()
    {
        $userDetails = $this->employerService->getUserDetails(auth()->user()->id);
        $candidateDetails = $this->candidateService->getCandidateDetails(auth()->user()->id);
        $skills = $this->skillService->getAllSkills();
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        $designations = $this->designationService->getAllDesignations();
        $jobTypes = $this->jobTypeService->getAllJobTypes();
        $jobWorkTypes = getJobWorkType();
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
            'frontend.candidate.my-resume',
            compact(
                'title',
                'genders',
                'countries',
                'userDetails',
                'states',
                'cities',
                'designations',
                'candidateDetails',
                'skills',
                'jobCategories',
                'jobTypes',
                'jobWorkTypes'
            )
        );
    }

    /**
     * ********************************
     * method use to update candidate
     * --------------------------------
     * @param object $request
     * @return jsonResponse
     * ********************************
     */
    public function updateCandidateDetails(Request $request)
    {
        try {
            $inputArray = $this->validateCandidateDetailsInput($request);
            $this->candidateService->updateCandidateDetails($inputArray);
            $redirectRoute = isset($inputArray['flag']) && $inputArray['flag'] == 'apply-job' ? route('candidateProfile') : route('myResume');
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Profile updated successfully!",
                    'redirectRoute' => $redirectRoute
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
    private function validateCandidateDetailsInput(Request $request)
    {
        return $request->only(
            [
                'userId',
                'resume_headline',
                'skills',
                'profile_summary',
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
                'flag',
                'job_id'
            ]
        );
    }

    /**
     * ***************************************************
     * method use to view candidate change password form
     * ---------------------------------------------------
     * @param int $authId
     * @return jsonResponse
     * ***************************************************
     */
    public function cadidateChangePassword()
    {
        return view('frontend.candidate.change-password');
    }

     /**
     * *******************************
     * method used to change password
     * -------------------------------
     * @param object $request
     * *******************************
    */
    public function changeCandidatePassword(AdminChangePasswordRequest $request)
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
    public function updateCandidateProfilePhoto(ProfileImageRequest $request)
    {
        // try {
            $inputArray = $this->validateImage($request);
            $imageName  = time().'.'.$inputArray['profile_photo']->extension();
            $imagepath = config('constants.PROFILE_PATH');
            if (!file_exists($imagepath)) {
                mkdir($imagepath, 0777, true);
            }
            $inputArray['profile_photo']->move(config('constants.PROFILE_PATH'), $imageName);
            $inputArray['profile_photo'] = $imageName;
            $this->userService->updateProfilePhoto(auth()->user()->id, $inputArray);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Profile photo updated successfully!"
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
    private function validateImage(Request $request)
    {
        return $request->only(['profile_photo']);
    }

    /**
     * *********************************
     * method use to view applied jobs
     * ---------------------------------
     * @return jsonResponse
     * *********************************
     */
    public function appliedJobs()
    {
        return view(
            'frontend.candidate.applied-job'
        );
    }

    public function getAppliedJobsData()
    {
        $appliedJobs = $this->applyJobService->getAppliedJobs(auth()->user()->id);
        // dd($appliedJobs);
        $jobsCount = count($appliedJobs);
        return response()->json([
            'jobs' => $appliedJobs,
            'jobsCount' => $jobsCount
        ]);
    }
}
