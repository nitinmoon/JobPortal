<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\AdminProfileImageRequest;
use App\Http\Requests\AdminProfileInputRequest;
use App\Models\Constants\ApplyJobStatusConstants;
use App\Services\ApplyJobService;
use App\Services\LoginService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Constants\UserRoleConstants;

class DashboardController extends Controller
{
    private $applyJobService;
    private $loginService;

    public function __construct(
        ApplyJobService $applyJobService,
        LoginService $loginService
    ) {
        $this->applyJobService = $applyJobService;
        $this->loginService = $loginService;
    }

    /**
     * **************************************
     * function used to view dashboard page
     * --------------------------------------
     * @return view
     * **************************************
     */
    public function index()
    {
        if (auth()->user()->role_id != UserRoleConstants::USER_ROLE_ADMIN) {
            return back();
        }
        return view('backend.dashboard.admin-dashboard');
    }

    /**
     * **************************************************
     * function used to view employer dashboard page
     * --------------------------------------------------
     * @return view
     * **************************************************
     */
    public function employerDashboard()
    {
        if (auth()->user()->role_id != UserRoleConstants::USER_ROLE_EMPLOYER) {
            return back();
        }
        $totalApplyJobCount = $this->applyJobService->getTotalApplyJobCount();
        $todayApplyJobCount = $this->applyJobService->getTotalApplyJobCount('today');
        $applicationSentCount = $this->applyJobService->geApplyJobCountByStatus(ApplyJobStatusConstants::APPLICATION_SENT);
        $resumeViewedCount = $this->applyJobService->geApplyJobCountByStatus(ApplyJobStatusConstants::RESUME_VIEWED);
        $shortlistedCount = $this->applyJobService->geApplyJobCountByStatus(ApplyJobStatusConstants::SHORTLISTED);
        $todaysCandidateJobList = $this->applyJobService->getTodaysApplyJobCandidate();
        return view('backend.dashboard.employer-dashboard', compact(
            'totalApplyJobCount',
            'todayApplyJobCount',
            'applicationSentCount',
            'resumeViewedCount',
            'shortlistedCount',
            'todaysCandidateJobList'
        ));
    }

    public function updateAdminProfile(AdminProfileInputRequest $request)
    {
        try {
            $inputArray = $this->validateAdminProfileInput($request);
            $this->loginService->updateAdminProfile(auth()->user()->id, $inputArray);
            return response()->json(
                [
                    'status' => true,
                    'msg' => 'Profile updated successfully!'
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
     ***********************************************
     * Function use to validate admin profile input
     * ---------------------------------------------
     * @param object $request
     * @return object request
     ***********************************************
     */
    private function validateAdminProfileInput(Request $request)
    {
        return $request->only(
            ['title', 'first_name', 'middle_name', 'last_name', 'email', 'phone', 'dob', 'gender']
        );
    }

    /**
     * *******************************
     * method used to change password
     * -------------------------------
     * @param object $request
     * *******************************
     */
    public function changePassword(AdminChangePasswordRequest $request)
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
      *****************************
     * after filter get team hours
     * -----------------------------
     * @param request
     * @return data
      ******************************
     */
    public function getApplyJobCount(Request $request)
    {
        $totalApplyJobCount = $this->applyJobService->getApplyJobCount($request);
        return response()->json([
            'totalApplyJobCount' => $totalApplyJobCount
        ]);
    }

     /**
     * **************************************
     * method to update admin profile image
     * --------------------------------------
     * @param object $request
     * @param int $candidateId
     * @return redirect
     * @description input ('profile_photo')
     * @description (with success message)
     * **************************************
     */
    public function updateAdminProfileImage(AdminProfileImageRequest $request, $userId)
    {
        // try {
            $inputArray = $this->validateImage($request);
            $this->loginService->updateAdminProfileImage($userId, $inputArray);
        // } catch (\Exception  $exception) {
        //     return back()->withError($exception->getMessage())->withInput();
        // }
        return back()->with('success', "Profile photo updated successfully");
    }

    /**
     * ********************************************
     * method used to validate profile photo input
     * --------------------------------------------
     * @param       request
     * @return      request
     * @description input ('profile_photo')
     * *********************************************
     */
    private function validateImage(Request $request)
    {
        return $request->only(['profile_photo', 'roleId']);
    }
}
