<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
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
        return $this->userRepository->saveUserDataInSession($inputArray);
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
        return $this->userRepository->saveVerifyOtp($inputArray);
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
        return $this->userRepository->sendVerifyOtpMail($email, $otp);
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
        return $this->userRepository->verifyOtp($inputArray);
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
        return $this->userRepository->registerUser($inputArray);
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
        return $this->userRepository->checkLoginStatus($credentials);
    }

    /**
     *************************************
     * Function use to update my profile
     * -----------------------------------
     * @param object $request
     * @return data
     *************************************
     */
    public function updateMyProfile($inputArray)
    {
        return $this->userRepository->updateMyProfile($inputArray);
    }

    /**
     * *****************************************
     * method used to update profile basic info
     * -----------------------------------------
     * @param userId
     * @param inputdata
     * @return data
     * @description input (user details)
     * ******************************************
     */
    public function updateProfilePhoto($userId, $inputdata)
    {
        $userDetail = $this->userRepository->getById($userId);
        $user = $this->userRepository->update($userDetail, $inputdata);
        return $user;
    }

    /**
     * **********************************
     * method used to update last login
     * ----------------------------------
     *
     * @param int $userId
     * @return data
     * **********************************
     */
    public function updateLastLogin($userId)
    {
        return $this->userRepository->updateLastLogin($userId);
    }
}
