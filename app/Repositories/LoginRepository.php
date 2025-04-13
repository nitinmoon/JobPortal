<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;

class LoginRepository extends BaseRepository
{
    public function getModel()
    {
        return new User();
    }

    /**
     * **********************************
     * method used to check user login
     * ----------------------------------
     *
     * @param array $credentials
     * @return data
     * **********************************
     */
    public function checkLoginStatus($credentials)
    {
        return User::where('email', $credentials['email'])->first();
    }

    /**
     * ************************************************
     * method used to send forgot password link email
     * ------------------------------------------------
     *
     * @param array $credentials
     * @return data
     * ************************************************
     */
    public function sendForgotPasswordLink($credentials)
    {
        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert(
            [
                'email' => $credentials['email'],
                'token' => $token,
                'created_at' => date('Y-m-d H:i:s')
            ]
        );
        Mail::to($credentials['email'])->send(new ResetPassword($token));
        return $token;
    }

    /**
     * **********************************
     * method used to get token records
     * ----------------------------------
     *
     * @param string $token
     * @return data
     * **********************************
     */
    public function getResetPasswordRecord($token)
    {
        return DB::table('password_reset_tokens')->where(['token' => $token])->first();
    }

    /**
     * ********************************************************
     * method used to token for reseting password
     * ---------------------------------------------------------
     *
     * @param array $inputArray
     * @return data
     * @description (email, token)
     * *********************************************************
     */
    public function checkPasswordEmailToken($inputArray)
    {
        return DB::table('password_reset_tokens')->where(['email' => $inputArray['email'], 'token' => $inputArray['token']])->first();
    }

    /**
     * *****************************************************
     * method used to reset password and delete old token
     * -----------------------------------------------------
     *
     * @param object $user
     * @param object $request
     * @description (email, password)
     * @return void
     * *****************************************************
     */
    public function updateResetPassword($user, $request)
    {
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
    }

    /**
     * ************************************
     * method used to get personal details
     * ------------------------------------
     *
     * @param int $userId
     * @return data
     * ************************************
     */
    public function getUserDetails($userId)
    {
        return User::select('id', 'title', 'first_name', 'last_name', 'email', 'phone', 'dob', 'gender', 'profile_photo', 'role_id')
            ->where('id', $userId)
            ->first();
    }

    /**
     * ************************************
     * method used to get personal details
     * ------------------------------------
     *
     * @param int $userId
     * @param array $inputdata
     * @return data
     * ************************************
     */
    public function updateAdminProfile($userId, $inputdata)
    {
        $userDetail = $this->getById($userId);
        $user = $this->update($userDetail, $inputdata);
        return $user;
    }

    /**
     * ************************************
     * method used to get personal details
     * ------------------------------------
     *
     * @param int $userId
     * @param array $inputdata
     * @return data
     * ************************************
     */
    public function updateProfileImage($userId, $inputArray)
    {
        $role_id = User::select('role_id')->where('id', $userId)->first();
        $role = $role_id->role->name;
        if (!empty($inputArray['profile_photo'])) {
            $filePath = config('constants.PROFILE_PATH');
            $oldFileName = User::where('id', $userId)->pluck('profile_photo');
            File::delete($filePath . '/' . $oldFileName[0]);
            $fileName  = $role . '_' . $userId . '.' . $inputArray['profile_photo']->extension();
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $inputArray['profile_photo']->move($filePath, $fileName);
            User::where('id', $userId)->update(['profile_photo' => $fileName]);
        }
        return $userId;
    }

    /**
     * *******************************
     * method used to change password
     * -------------------------------
     * @param array $credentials
     * @return data
     * *******************************
     */
    public function changePassword($credentials)
    {
        return User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($credentials['password'])
        ]);
    }

    /**
     * *************************************
     * method to update admin profile image
     * -------------------------------------
     * @param int $userId
     * @param array $inputdata
     * @return data
     * *************************************
     */
    public function updateAdminProfileImage($userId, $inputArray)
    {
        if (!empty($inputArray['profile_photo'])) {
            $filePath = config('constants.PROFILE_PATH');
            $oldFileName = User::where('id', $userId)->pluck('profile_photo');
            File::delete($filePath . $oldFileName[0]);
            $fileName  = config('constants.ADMIN_PREFIX'). $userId . '.' . $inputArray['profile_photo']->extension();
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $inputArray['profile_photo']->move($filePath, $fileName);
            User::where('id', $userId)->update(['profile_photo' => $fileName]);
        }
        return $userId;
    }
}
