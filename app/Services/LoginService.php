<?php

namespace App\Services;

use App\Repositories\LoginRepository;

class LoginService
{
    private $loginRepository;

    public function __construct(
        LoginRepository $loginRepository,
    ) {
        $this->loginRepository = $loginRepository;
    }

    /**
     * **********************************
     * method used to check user login
     * ----------------------------------
     *
     * @param  array $credentials
     * @return data
     * **********************************
     */
    public function checkLoginStatus($credentials)
    {
        return $this->loginRepository->checkLoginStatus($credentials);
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
        return $this->loginRepository->sendForgotPasswordLink($credentials);
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
        return $this->loginRepository->getResetPasswordRecord($token);
    }

    /**
     * ***********************************************
     * method used to token for reseting password
     * -----------------------------------------------
     *
     * @param array $inputArray
     * @return data
     * @description (email, token)
     * ***********************************************
     */
    public function checkPasswordEmailToken($inputArray)
    {
        return $this->loginRepository->checkPasswordEmailToken($inputArray);
    }

    /**
     * **********************************************************
     * method used to reset admin password and delete old token
     * ----------------------------------------------------------
     *
     * @param array $user
     * @param array $request
     * @description (email, password)
     * @return data
     * **********************************************************
     */
    public function updateResetPassword($user, $request)
    {
        return $this->loginRepository->updateResetPassword($user, $request);
    }

    /**
     * ************************************
     * method used to get personal details
     * ------------------------------------
     * @param int $userId
     * @return data
     * ************************************
     */
    public function getUserDetails($userId)
    {
        return $this->loginRepository->getUserDetails($userId);
    }

    /**
     * ************************************
     * method used to get personal details
     * ------------------------------------
     * @param int $userId
     * @param array $inputdata
     * @return data
     * ************************************
     */
    public function updateAdminProfile($userId, $inputdata)
    {
        return $this->loginRepository->updateAdminProfile($userId, $inputdata);
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
    public function updateProfileImage($userId, $inputdata)
    {
        return $this->loginRepository->updateProfileImage($userId, $inputdata);
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
        return $this->loginRepository->changePassword($credentials);
    }

     /**
     * **************************************
     * method to update admin profile image
     * --------------------------------------
     * @param int $userId
     * @param array $inputdata
     * @return data
     * **************************************
     */
    public function updateAdminProfileImage($userId, $inputdata)
    {
        return $this->loginRepository->updateAdminProfileImage($userId, $inputdata);
    }
}
