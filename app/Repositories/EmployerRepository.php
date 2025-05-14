<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Models\Constants\UserRoleConstants;
use App\Models\EmployerDetail;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EmployerRepository extends BaseRepository
{
    public function getModel()
    {
        return new User();
    }

    /**
     * **********************************************
     * method used to send employer otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function sendEmployerOtp($inputArray)
    {
        $checkEmail = $this->getModel()->where('email', $inputArray['email'])->first();
        $otp = random_int(100000, 999999);
        if ($checkEmail == null) {
            $user = $this->getModel();
            $user->title = '1';
            $user->email = $inputArray['email'];
            $user->verify_otp = $otp;
            $user->role_id = UserRoleConstants::EMPLOYER;
            $user->save();
        } else {
            $checkEmailRole = $this->getModel()->where('email', $inputArray['email'])
            ->where('role_id', UserRoleConstants::EMPLOYER)
            ->first();
            if ($checkEmailRole == null) {
                return 'Invalid_User';
            }
            $this->getModel()->where('email', $inputArray['email'])->update([
                'verify_otp' => $otp
            ]);
        }
        return $otp;
    }

    /**
     * **********************************************
     * method used to verify employer otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function verifyEmployerOtp($inputArray)
    {
        $checkEmail = $this->getModel()->where('email', $inputArray['email'])->where('verify_otp', $inputArray['otp'])->first();
        if ($checkEmail != null) {
            $this->getModel()->where('email', $inputArray['email'])->update([
                'last_login' => date('Y-m-d H:i:s')
            ]);
            $user = $this->getModel()->where('email', $inputArray['email'])->first();
            Auth::login($user);
            return true;
        }
        return false;
    }

    /**
     * *************************************
     * Method use to employer listing data
     * -------------------------------------
     * @return data
     * @description input (title)
     * *************************************
     */
    public function getEmployer($request)
    {
        $filterData = $request->all();
        $queryBuilder = User::select(
            'users.id',
            'users.title',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'users.email',
            'users.phone',
            'users.status',
            'users.created_at',
            'users.deleted_at',
            'employer_details.employer_id',
            'employer_details.company_name',
            'employer_details.company_contact_person',
            'employer_details.company_contact_email',
            'employer_details.company_contact_no',
        )
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'users.id')
        ->where('users.role_id', UserRoleConstants::EMPLOYER);
        if (!empty($filterData['employer'])) {
            $queryBuilder = $queryBuilder->where('users.id', $filterData['employer']);
        }
        if (!empty($filterData['deleted'])) {
            if ($filterData['deleted'] == '1') {
                $queryBuilder = $queryBuilder->where('users.deleted_at', null);
            } else {
                $queryBuilder = $queryBuilder->where('users.deleted_at', '<>', null);
            }
        }
        if (isset($filterData['status'])) {
            if ($filterData['status'] == '1') {
                $queryBuilder = $queryBuilder->where('users.status', '1');
            } else {
                $queryBuilder = $queryBuilder->where('users.status', '2');
            }
        }
        return $queryBuilder->orderBy('users.id', 'desc')->withTrashed()->get();
    }

    /**
     * **********************************************
     * method used to resend employer otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function resendEmployerOtp($inputArray)
    {
        $otp = random_int(100000, 999999);
        $this->getModel()->where('email', $inputArray['email'])->update([
            'verify_otp' => $otp
        ]);
        return $otp;
    }

    /**
     * *************************************
     * method used to get employer details
     * -------------------------------------
     * @param int $employerId
     * @return data
     * *************************************
     */
    public function getEmployerDetails($employerId)
    {
        return EmployerDetail::where('employer_id', $employerId)->first();
    }

    /**
     **************************************
     * Function use to add update employer
     * ------------------------------------
     * @param array $inputArray
     * @return int $employerId
     **************************************
     */
    public function addUpdateEmployer($inputArray, $password)
    {
        $condition = ['employer_id' => $inputArray['employerId']];
        if ($inputArray['employerId'] == 0) {
            $user = $this->getModel();
            $user->title = strip_tags($inputArray['title']);
            $user->first_name = strip_tags($inputArray['first_name']);
            $user->middle_name = strip_tags($inputArray['middle_name']);
            $user->last_name = strip_tags($inputArray['last_name']);
            $user->email = strip_tags($inputArray['email']);
            $user->password = bcrypt($password);
            $user->phone = strip_tags($inputArray['phone']);
            $user->dob = strip_tags($inputArray['dob']);
            $user->gender = strip_tags($inputArray['gender']);
            $user->role_id = UserRoleConstants::EMPLOYER;
            $user->created_by = auth()->user()->id;
            $user->save();
            addUserMail($user->id, $password);
            $LastInsertId = $user->id;
        } else {
            $this->getModel()->where('id', $inputArray['employerId'])->update(
                [
                    'title' => strip_tags($inputArray['title']),
                    'first_name' => strip_tags($inputArray['first_name']),
                    'middle_name' => strip_tags($inputArray['middle_name']),
                    'last_name' => strip_tags($inputArray['last_name']),
                    'email' => strip_tags($inputArray['email']),
                    'phone' => $inputArray['phone'],
                    'dob' => $inputArray['dob'],
                    'gender' => strip_tags($inputArray['gender']),
                    'role_id' => UserRoleConstants::EMPLOYER,
                    'updated_by' => auth()->user()->id
                ]
            );
            $LastInsertId = $inputArray['employerId'];
        }
        $employerDetails = [
            'employer_id' => $LastInsertId,
            'company_name' => strip_tags($inputArray['company_name']),
            'company_website' => strip_tags($inputArray['company_website']),
            'company_contact_person' => strip_tags($inputArray['company_contact_person']),
            'company_contact_email' => strip_tags($inputArray['company_contact_email']),
            'company_contact_no' => $inputArray['company_contact_no'],
            'job_category_id' => $inputArray['job_category_id'],
            'foundation_date' => $inputArray['foundation_date'],
            'no_of_employees' => $inputArray['no_of_employees'],
            'gst_no' => strip_tags($inputArray['gst_no']),
            'company_description' => $inputArray['company_description'],
            'company_address' => strip_tags($inputArray['company_address']),
            'zip' => strip_tags($inputArray['zip']),
            'country_id' => isset($inputArray['country_id']) ? $inputArray['country_id'] : null,
            'state_id' => isset($inputArray['state_id']) ? $inputArray['state_id'] : null,
            'city_id' => isset($inputArray['city_id']) ? $inputArray['city_id'] : null,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ];
        if (!empty($inputArray['company_logo'])) {
            $filePath = config('constants.COMPANY_LOGO_PATH');
            $oldFileName = EmployerDetail::where('employer_id', $inputArray['employerId'])->pluck('company_logo')->first();
            if (!empty($oldFileName)) {
                File::delete($filePath . '/' . $oldFileName);
            }
            $fileName  = config('constants.EMPLOYER_PREFIX') . $inputArray['employerId'] . '_Logo.' . $inputArray['company_logo']->extension();
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $inputArray['company_logo']->move($filePath, $fileName);
            $employerDetails['company_logo'] = $fileName;
        }
        EmployerDetail::updateOrCreate($condition, $employerDetails);
        return $inputArray['employerId'];
    }

    /**
     **************************************
     * Function use to add update employer
     * ------------------------------------
     * @param array $inputArray
     * @return int $employerId
     **************************************
     */
    public function updateEmployerProfile($inputArray)
    {
        $this->getModel()->where('id', auth()->user()->id)->update(
            [
                'title' => strip_tags($inputArray['title']),
                'first_name' => strip_tags($inputArray['first_name']),
                'middle_name' => strip_tags($inputArray['middle_name']),
                'last_name' => strip_tags($inputArray['last_name']),
                'email' => strip_tags($inputArray['email']),
                'phone' => $inputArray['phone'],
                'dob' => $inputArray['dob'],
                'gender' => strip_tags($inputArray['gender']),
                'role_id' => UserRoleConstants::EMPLOYER,
                'updated_by' => auth()->user()->id
            ]
        );
        $checkEmployer = EmployerDetail::where('employer_id', auth()->user()->id)->first();
        $employerDetails = [
            'company_address' => strip_tags($inputArray['company_address']),
            'zip' => strip_tags($inputArray['zip']),
            'country_id' => isset($inputArray['country_id']) ? $inputArray['country_id'] : null,
            'state_id' => isset($inputArray['state_id']) ? $inputArray['state_id'] : null,
            'city_id' => isset($inputArray['city_id']) ? $inputArray['city_id'] : null,
            'company_name' => strip_tags($inputArray['company_name']),
            'company_description' => $inputArray['company_description'],
            'company_contact_person' => strip_tags($inputArray['company_contact_person']),
            'company_contact_email' => strip_tags($inputArray['company_contact_email']),
            'company_contact_no' => $inputArray['company_contact_no'],
            'foundation_date' => $inputArray['foundation_date'],
            'no_of_employees' => $inputArray['no_of_employees'],
            'gst_no' => strip_tags($inputArray['gst_no']),
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ];
        if ($checkEmployer == null) {
            $employerDetails['employer_id'] = auth()->user()->id;
            EmployerDetail::create($employerDetails);
        } else {
            EmployerDetail::where('employer_id', auth()->user()->id)->update($employerDetails);
        }
        return auth()->user()->id;
    }

    /**
     * **********************
     * User search query
     * ----------------------
     * @param string $searchString
     * @return data
     * ******************************
     */
    public function autoCompleteSearchEmployer($searchString = null)
    {

        $queryBuilder = User::select('users.id', 'users.title', 'users.first_name', 'users.last_name')
            ->where('users.portal_access', '1')
            ->where('users.role_id', UserRoleConstants::EMPLOYER);

        if (!empty($searchString) && $searchString != '') {
            $queryBuilder = $queryBuilder->where('users.title', 'LIKE', "%{$searchString}%")
                ->orWhere('users.first_name', 'LIKE', "%{$searchString}%")
                ->orWhere('users.last_name', 'LIKE', "%{$searchString}%");
        }
        return $queryBuilder->orderBy('users.first_name')->limit(10)->get();
    }

    /**
     *****************************************
     * Function use to get user details by id
     * ---------------------------------------
     * @param int $employerId
     * @return data
     **************************************
     */
    public function getUserDetails($employerId)
    {
        return User::select(
            'users.id',
            'users.title',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'users.email',
            'users.phone',
            'users.dob',
            'users.gender',
            'users.status',
            'user_addresses.address',
            'user_addresses.zip',
            'user_addresses.country_id',
            'user_addresses.state_id',
            'user_addresses.city_id',
            'countries.name as country_name',
            'states.name as state_name',
            'cities.name as city_name',
        )
        ->leftJoin('user_addresses', 'user_addresses.user_id', '=', 'users.id')
        ->leftJoin('countries', 'countries.id', '=', 'user_addresses.country_id')
        ->leftJoin('states', 'states.id', '=', 'user_addresses.state_id')
        ->leftJoin('cities', 'cities.id', '=', 'user_addresses.city_id')
        ->where('users.id', $employerId)
        ->first();
    }

    /**
     ******************************************
     * Function use to update company profile
     * ----------------------------------------
     * @param object $request
     * @return data
     ******************************************
     */
    public function updateCompanyProfile($inputArray)
    {
        $condition = ['employer_id' => auth()->user()->id];
        $companyDetails = [
            'company_name' => strip_tags($inputArray['company_name']),
            'company_website' => strip_tags($inputArray['company_website']),
            'company_contact_person' => strip_tags($inputArray['company_contact_person']),
            'company_contact_email' => strip_tags($inputArray['company_contact_email']),
            'company_contact_no' => $inputArray['company_contact_no'],
            'job_category_id' => $inputArray['job_category_id'],
            'foundation_date' => $inputArray['foundation_date'],
            'no_of_employees' => $inputArray['no_of_employees'],
            'gst_no' => $inputArray['gst_no'],
            'company_description' => $inputArray['company_description'],
            'country_id' => isset($inputArray['country_id']) ? $inputArray['country_id'] : null,
            'state_id' => isset($inputArray['state_id']) ? $inputArray['state_id'] : null,
            'city_id' => isset($inputArray['city_id']) ? $inputArray['city_id'] : null,
            'zip' => strip_tags($inputArray['zip']),
            'company_address' => strip_tags($inputArray['company_address']),
            'updated_by' => auth()->user()->id,
        ];
        EmployerDetail::updateOrCreate($condition, $companyDetails);
        return auth()->user()->id;
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
    public function updateCompanyLogo($userId, $inputdata)
    {
        $condition = ['employer_id' => auth()->user()->id];
        $companyDetails = [
            'company_logo' => $inputdata['company_logo'],
            'updated_by' => auth()->user()->id,
        ];
        EmployerDetail::updateOrCreate($condition, $companyDetails);
        return auth()->user()->id;
    }

    /**
     * **********************************
     * method used to get all employers
     * ----------------------------------
     * @param userId
     * @param inputdata
     * @return data
     * @description input (user details)
     * **********************************
     */
    public function getEmployers()
    {
       return User::select('id', 'first_name', 'last_name')
       ->where('role_id', UserRoleConstants::EMPLOYER)
       ->get();
    }
}
