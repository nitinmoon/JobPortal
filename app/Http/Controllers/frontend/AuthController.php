<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\Constants\UserRoleConstants;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as RouteRequest;

class AuthController extends Controller
{
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * ***************************************
     * Method is used to view auth type page
     * ---------------------------------------
     * @param string $flag
     * @return view
     * ***************************************
     */
    public function authType($flag)
    {
        $type = base64_decode($flag);
        return view('frontend.auth.auth-type', compact('type'));
    }

    /**
     * ***************************************
     * Method is used to view register page
     * ---------------------------------------
     * @return view
     * ***************************************
     */
    public function register()
    {
        $roleId = RouteRequest::routeIs('employerRegister') ? UserRoleConstants::EMPLOYER
            : UserRoleConstants::CANDIDATE;
        return view('frontend.auth.register', compact('roleId'));
    }

    /**
     * ********************************************
     * Method is used to view login page
     * --------------------------------------------
     * @return view
     * ********************************************
     */
    public function login()
    {
        $roleId = RouteRequest::routeIs('employerLogin') ? UserRoleConstants::EMPLOYER : UserRoleConstants::CANDIDATE;
        return view('frontend.auth.login', compact('roleId'));
    }

    /**
     * ********************************************
     * method used to verify email by sending otp
     * --------------------------------------------
     *
     * @param  object $request
     * @return request
     * ********************************************
     */
    public function verifyEmail(VerifyEmailRequest $request)
    {
        try {
            $inputArray = $this->validateVerifyEmailRequest($request);
            $this->userService->saveUserDataInSession($inputArray);
            $otp = $this->userService->saveVerifyOtp($inputArray);
            $this->userService->sendVerifyOtpMail($inputArray['email'], $otp);
            return response()->json(
                [
                    'status' => true,
                    'msg'    => 'OTP sent to ' . $inputArray['email'].', Please check your inbox.',
                ]
            );
        } catch (\Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage(),
                ]
            );
        }
    }

    /**
     * *****************************************************
     * method used to validate verify email request input
     * -----------------------------------------------------
     *
     * @param  object $request
     * @return request
     * *****************************************************
     */
    private function validateVerifyEmailRequest(Request $request)
    {
        return $request->only(
            [
                'first_name',
                'last_name',
                'email'
            ]
        );
    }

    /**
     * ****************************
     * method used to verify otp
     * ----------------------------
     *
     * @param  object $request
     * @return request
     * ****************************
     */
    public function verifyOtp(Request $request)
    {
        try {
            $inputArray = $this->validateVerifyOtpRequest($request);
            $verifyOtp = $this->userService->verifyOtp($inputArray);
            if ($verifyOtp == false) {
                return response()->json(
                    [
                        'status' => false,
                        'msg' => 'The OTP you entered is invalid or expired. Please enter the correct OTP.'
                    ]
                );
            }
            return response()->json(
                [
                    'status' => true,
                    'msg' => 'Email Verified'
                ]
            );
        } catch (\Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage(),
                ]
            );
        }
    }

    /**
     * *****************************************************
     * method used to validate verify otp request input
     * -----------------------------------------------------
     *
     * @param  object $request
     * @return request
     * *****************************************************
     */
    private function validateVerifyOtpRequest(Request $request)
    {
        return $request->only(['otp']);
    }

    /**
     * ****************************
     * method used to verify otp
     * ----------------------------
     *
     * @param  object $request
     * @return request
     * ****************************
     */
    public function registerUser(Request $request)
    {
        try {
            $inputArray = $this->validateRegisterUserRequest($request);
            $user = $this->userService->registerUser($inputArray);
            if ($user == false) {
                return response()->json(
                    [
                        'status' => false,
                        'msg' => 'The OTP you entered is invalid or expired. Please enter the correct OTP.'
                    ]
                );
            }
            return response()->json(
                [
                    'status' => true,
                    'msg' => 'Email Verified'
                ]
            );
        } catch (\Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage(),
                ]
            );
        }
    }

    /**
     * *****************************************************
     * method used to validate verify otp request input
     * -----------------------------------------------------
     *
     * @param  object $request
     * @return request
     * *****************************************************
     */
    private function validateRegisterUserRequest(Request $request)
    {
        return $request->only(
            [
                'password',
                'confirm_password',
                'role_id'
            ]
        );
    }
}
