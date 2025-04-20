<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\Constants\UserRoleConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RouteRequest;

class AuthController extends Controller
{
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

    public function sendOtp(VerifyEmailRequest $request)
    {
        // Validate inputs  
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate a random OTP  
        $otp = mt_rand(100000, 999999);

        // Store user info and OTP in the session to use later  
        session([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP via Email  
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Your OTP Code for Verification');
        });

        return redirect()->back()->with('success', 'OTP sent to your email!');
    }
}
