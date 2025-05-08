<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Services\LoginService;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\IpUtils;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(
        LoginService $loginService
    ) {
        $this->loginService = $loginService;
    }

    /**
     * ***************************************
     * function used to view admin login page
     * ---------------------------------------
     * @return view
     * **************************************
     */
    public function index()
    {
        return view('backend.auth.login');
    }

    /**
     * **********************************
     * method used to check user login
     * ----------------------------------
     * @param object $request
     * @return jsonResponse
     * **********************************
     */
    public function checkLogin(LoginRequest $request)
    {
        // Google reCAPTCHA API key configuration
        $siteKey     = env('RECAPTCHA_SITE_KEY');
        $secretKey     = env('RECAPTCHA_SITE_SECRET');

        $data = $request->all();
        if (isset($data['g-recaptcha-response']) && !empty($data['g-recaptcha-response'])) {
            // Verify the reCAPTCHA response
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $request->ip(),
            ]);
            // Json data
            $responseBody = $response->json();
            // If reCAPTCHA response is valid
            if ($responseBody['success']) {
                $credentials = $this->validateLoginRequest($request);
                $user = $this->loginService->checkLoginStatus($credentials);
                if (!empty($user)) {
                    if ($user->portal_access == 0 || $user->deleted_at != null) {
                        return response()->json(
                            [
                                'status' => '2',
                                'msg' => 'Account is deactivated!',
                            ]
                        );
                    }
                    $remember = isset($credentials['remember']) ? true : false;
                    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
                        User::where('id', $user->id)->update(
                            [
                                'last_login' => date('Y-m-d H:i:s')
                            ]
                        );
                        return response()->json(
                            [
                                'status' => true,
                                'redirectRoute' => url('console/dashboard'),
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
     * @param object $request
     * @return request
     * ***********************************************
     */
    private function validateLoginRequest(Request $request)
    {
        return $request->only(['email', 'password']);
    }

    /**
     * ******************************************
     * method used to view forgot password page
     * ------------------------------------------
     * @return view
     * ******************************************
     */
    public function forgotPassword()
    {
        return view('backend.auth.forgot-password');
    }

    /**
     * ***********************************
     * method used to view forgot password
     * --------------------------------------
     * @param object $request
     * @return jsonResponse
     * **************************************
     */
    public function sendResetPasswordLink(ForgotPasswordRequest $request)
    {
        $credentials = $this->validateForgotRequest($request);
        try {
            $user = $this->loginService->checkLoginStatus($credentials);
            if (!empty($user)) {
                if ($user->portal_access == 0) {
                    return response()->json(
                        [
                            'status' => 2,
                            'msg' => 'Account is deactivated!'
                        ]
                    );
                }
                $this->loginService->sendForgotPasswordLink($credentials);
                return response()->json(
                    [
                        'status' => 1,
                        'msg' => 'Reset password link sent successfully, Please check email!'
                    ]
                );
            }
            return response()->json(
                [
                    'status' => 0,
                    'msg' => 'You are not authorized user!'
                ]
            );
        } catch (Exception  $exception) {
            return response()->json(
                [
                    '
                status' => 0,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }

    /**
     * *********************************************************
     * method used to check required input for forgot password
     * ---------------------------------------------------------
     * @param object $request
     * @return request
     * *********************************************************
     */
    private function validateForgotRequest(Request $request)
    {
        return $request->only(['email']);
    }

    /**
     * ******************************************
     * method used to view reset password page
     * ------------------------------------------
     * @param string $token
     * @return view
     * ******************************************
     */
    public function resetPassword($token = null)
    {
        $getTokenData =  $this->loginService->getResetPasswordRecord($token);
        if ($getTokenData == null) {
            return redirect('adminLogin')->with('error', 'Reset password token expired!');
        }
        $email = isset($getTokenData->email) ? $getTokenData->email : '';
        $token = isset($getTokenData->token) ? $getTokenData->token : '';
        return view('backend.auth.reset-password', compact('email', 'token'));
    }

    /**
     * **************************************************************
     * method used to update reset password
     * --------------------------------------------------------------
     * @param object $request
     * @return jsonResponse
     * @description input (email, token, password, confirm password)
     * **************************************************************
     */
    public function updateResetPassword(ResetPasswordRequest $request)
    {
        try {
            $credentials = $this->validateResetPassword($request);
            $checkToken =  $this->loginService->checkPasswordEmailToken($credentials);
            if (!$checkToken) {
                return response()->json(
                    [
                        'status' => '2',
                        'msg' => 'Invalid token!'
                    ]
                );
            }
            $user = $this->loginService->checkLoginStatus($credentials);
            if (empty($user)) {
                return response()->json(
                    [
                        'status' => '0',
                        'msg' => 'Invalid user!'
                    ]
                );
            }
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => '0',
                    'msg' => $exception->getMessage()
                ]
            );
        }
        $this->loginService->updateResetPassword($user, $request);
        return response()->json(
            [
                'status' => true,
                'msg' => 'Password reset successfully!',
                'redirectRoute' => route('adminLogin')
            ]
        );
    }

    /**
     * **************************************************************
     * method used to validate reset password input
     * --------------------------------------------------------------
     * @param object $request
     * @return request
     * @description input (email, token, password, confirm password)
     * ***************************************************************
     */
    private function validateResetPassword(Request $request)
    {
        return $request->only(['email', 'password', 'confirm_password', 'token']);
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
        return redirect(route('adminLogin'));
    }
}
