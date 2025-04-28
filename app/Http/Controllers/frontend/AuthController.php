<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\Constants\UserRoleConstants;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                    'msg'    => 'OTP sent to ' . $inputArray['email'] . ', Please check your inbox.',
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
    public function registerUser(RegisterUserRequest $request)
    {
        try {
            $inputArray = $this->validateRegisterUserRequest($request);
            $this->userService->registerUser($inputArray);
            $route = $inputArray['role_id'] == UserRoleConstants::EMPLOYER ? route('employerLogin') : route('candidateLogin');
            return response()->json(
                [
                    'status' => true,
                    'msg' => 'Account created successfully!',
                    'redirectRoute' => $route
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

    /**
     * **********************************
     * method used to check login
     * ----------------------------------
     *
     * @param  object $request
     * @return jsonResponse
     * **********************************
     */
    public function checkLogin(LoginRequest $request)
    {
        // Google reCAPTCHA API key configuration
        $siteKey = env('RECAPTCHA_SITE_KEY');
        $secretKey = env('RECAPTCHA_SITE_SECRET');

        $data = $request->all();
        if (isset($data['g-recaptcha-response']) && !empty($data['g-recaptcha-response'])) {
            // Verify the reCAPTCHA response
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response']);
            // Decode json data
            $responseData = json_decode($verifyResponse);
            // If reCAPTCHA response is valid
            if ($responseData->success) {
                $credentials = $this->validateLoginRequest($request);
                $user = $this->userService->checkLoginStatus($credentials);
                if (!empty($user)) {
                    if ($user->deleted_at != null) {
                        return response()->json(
                            [
                                'status' => '2',
                                'msg' => 'Account is deactivated!',
                            ]
                        );
                    }
                    $remember = isset($credentials['remember']) ? true : false;
                    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
                        $route = $user->role_id == UserRoleConstants::EMPLOYER ? route('myProfile') : route('candidateProfile');
                        return response()->json(
                            [
                                'status' => true,
                                'redirectRoute' => $route,
                                'msg' => 'Login successfully!'
                            ]
                        );
                    }
                }
                return response()->json(
                    [
                        'status' => '3',
                        'msg' => 'Credentials are not matched!',
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'status' => '4',
                    'msg' => 'Please check on the reCAPTCHA box',
                ]
            );
        }
    }

    /**
     * ***********************************************
     * method used to check required input for login
     * -----------------------------------------------
     *
     * @param  object $request
     * @return request
     * ***********************************************
     */
    private function validateLoginRequest(Request $request)
    {
        return $request->only(['email', 'password']);
    }

    /**
     * *************************
     * method used to logout
     * -------------------------
     * @return redirect
     * **************************
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
