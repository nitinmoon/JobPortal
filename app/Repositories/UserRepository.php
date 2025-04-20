<?php

namespace App\Repositories;

use App\Mail\VerifyOtpMail;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Models\VerifyOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
        return new User();
    }

    /**
     * ******************************************
     * method used to save user data in session
     * ------------------------------------------
     * @param array $inputArray
     * @return data
     * ******************************************
     */
    public function saveUserDataInSession($inputArray)
    {
        // Store user info in the session to use later
        return session([
            'first_name' => $inputArray['first_name'],
            'last_name' => $inputArray['last_name'],
            'email' => $inputArray['email']
        ]);
    }

    /**
     * **********************************
     * method used to save verify otp
     * ----------------------------------
     * @param array $inputArray
     * @return data
     * **********************************
     */
    public function saveVerifyOtp($inputArray)
    {
        // Generate a random OTP
        $otp = mt_rand(100000, 999999);

        // Store or update OTP in the database
        VerifyOtp::updateOrCreate(
            ['email' => $inputArray['email']],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5),
            ]
        );

        return $otp;
    }

    /**
     * *************************************
     * method used to send verify otp mail
     * -------------------------------------
     * @param string $email
     * @param int $otp
     * @return data
     * *************************************
     */
    public function sendVerifyOtpMail($email, $otp)
    {
        try {
            return Mail::to($email)->send(new VerifyOtpMail($otp));
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    /**
     * **********************************
     * method used to verify otp
     * ----------------------------------
     * @param array $inputArray
     * @return data
     * **********************************
     */
    public function verifyOtp($inputArray)
    {
        $otpRecord = VerifyOtp::where('email', session('email'))
            ->where('otp', $inputArray['otp'])
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if ($otpRecord != null) {
            // Clear OTP record
            $otpRecord->delete();
            return true;
        }
        return false;
    }
}
