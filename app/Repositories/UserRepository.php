<?php

namespace App\Repositories;

use App\Mail\AddUserMail;
use App\Mail\VerifyOtpMail;
use App\Models\Constants\UserStatusConstants;
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
            session(['email_verified_at' => date('Y-m-d H:i:s')]);
            // Clear OTP record
            $otpRecord->delete();
            return true;
        }
        return false;
    }

    /**
     * **********************************
     * method used to register user
     * ----------------------------------
     * @param array $inputArray
     * @return data
     * **********************************
     */
    public function registerUser($inputArray)
    {
        $user = new User();
        $user->first_name = session('first_name');
        $user->last_name = session('last_name');
        $user->email = session('email');
        $user->password = bcrypt($inputArray['password']);
        $user->email_verified_at = session('email_verified_at');
        $user->role_id = $inputArray['role_id'];
        $user->save();
        addUserMail($user->id, $inputArray['password']);
        User::where('id', $user->id)->update([
            'created_by' => $user->id
        ]);

        session()->flush();

        return $user->id;
    }

    /**
     * **********************************
     * method used to check login
     * ----------------------------------
     *
     * @param  array $credentials
     * @return data
     * **********************************
     */
    public function checkLoginStatus($credentials)
    {
        return User::where('email', $credentials['email'])
            ->where('status', UserStatusConstants::APPROVED)
            ->first();
    }
}
