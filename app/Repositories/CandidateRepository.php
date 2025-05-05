<?php

namespace App\Repositories;

use App\Models\ApplyJob;
use App\Models\CandidateDetail;
use App\Models\Constants\ApplyJobStatusConstants;
use App\Models\Constants\StatusConstants;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Models\Constants\UserRoleConstants;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CandidateRepository extends BaseRepository
{
    public function getModel()
    {
        return new User();
    }

    /**
     * *************************************
     * Method use to candidate listing data
     * -------------------------------------
     * @return data
     * @description input (title)
     * *************************************
     */
    public function getCandidate($request)
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
            'candidate_details.candidate_id',
            // 'candidate_details.address',
            // 'candidate_details.country_id',
            // 'candidate_details.state_id',
            // 'candidate_details.city_id',
            // 'candidate_details.zip',
            // 'candidate_details.resume_file',
            'candidate_details.experience',
            'candidate_details.education',
            'candidate_details.skills',
            'candidate_details.created_by',
            'candidate_details.updated_by'
        )
        ->leftJoin('candidate_details', 'candidate_details.candidate_id', '=', 'users.id')
        ->where('users.role_id', UserRoleConstants::CANDIDATE);
        if (!empty($filterData['candidate'])) {
            $queryBuilder = $queryBuilder->where('users.id', $filterData['candidate']);
        }
        if ($filterData['education'] != '') {
            $queryBuilder = $queryBuilder->where('candidate_details.education', $filterData['education']);
        }
        if (!empty($filterData['deleted'])) {
            if ($filterData['deleted'] == '1') {
                $queryBuilder = $queryBuilder->where('users.deleted_at', null);
            } else {
                $queryBuilder = $queryBuilder->where('users.deleted_at', '<>', null);
            }
        }
        if (isset($filterData['status'])) {
            if ($filterData['status'] == '0') {
                $queryBuilder = $queryBuilder->where('users.status', '0');
            } else {
                $queryBuilder = $queryBuilder->where('users.status', '1');
            }
        }
        return $queryBuilder = $queryBuilder->orderBy('users.id', 'desc')->withTrashed()->get();
    }

    /**
     * **********************************************
     * method used to send candidate otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function sendCandidateOtp($inputArray)
    {
        $checkEmail = $this->getModel()->where('email', $inputArray['email'])->first();
        $otp = random_int(100000, 999999);
        if ($checkEmail == null) {
            $user = $this->getModel();
            $user->title = '1';
            $user->email = $inputArray['email'];
            $user->verify_otp = $otp;
            $user->role_id = UserRoleConstants::USER_ROLE_CANDIDATE;
            $user->save();
        } else {
            $checkEmailRole = $this->getModel()->where('email', $inputArray['email'])
                ->where('role_id', UserRoleConstants::USER_ROLE_CANDIDATE)
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
     * method used to verify candidate otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function verifyCandidateOtp($inputArray)
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
     * **********************************************
     * method used to resend candidate otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function resendCandidateOtp($inputArray)
    {
        $otp = random_int(100000, 999999);
        $this->getModel()->where('email', $inputArray['email'])->update([
            'verify_otp' => $otp
        ]);
        return $otp;
    }

    /**
     * **********************************************
     * method used to update candidate profile
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function updateCandidateProfile($inputArray)
    {
        $this->getModel()->where('id', $inputArray['candidate_id'])->update([
            'title' => $inputArray['title'],
            'first_name' => $inputArray['first_name'],
            'middle_name' => $inputArray['middle_name'],
            'last_name' => $inputArray['last_name'],
            'phone' => $inputArray['phone'],
            'gender' => isset($inputArray['gender']) ? $inputArray['gender'] : 'M',
            'dob' => $inputArray['dob']
        ]);
        $yearExp = isset($inputArray['year_experience']) ? $inputArray['year_experience'] : '0';
        $monthExp = isset($inputArray['month_experience']) ? $inputArray['month_experience'] : '0';

        $checkCandidate = CandidateDetail::where('candidate_id', $inputArray['candidate_id'])->first();
        if ($checkCandidate == null) {
            $candidateDetails = new CandidateDetail();
            $candidateDetails->candidate_id = $inputArray['candidate_id'];
            $candidateDetails->address = isset($inputArray['address']) ? $inputArray['address'] : null;
            $candidateDetails->country_id = isset($inputArray['country_id']) ? $inputArray['country_id'] : null;
            $candidateDetails->state_id = isset($inputArray['state_id']) ? $inputArray['state_id'] : null;
            $candidateDetails->city_id = isset($inputArray['city_id']) ? $inputArray['city_id'] : null;
            $candidateDetails->zip = isset($inputArray['zip']) ? $inputArray['zip'] : null;
            $candidateDetails->experience = $yearExp . '-' . $monthExp;
            $candidateDetails->education = isset($inputArray['education']) ? $inputArray['education'] : null;
            $candidateDetails->skills = isset($inputArray['skills']) ? implode(',', $inputArray['skills']) : null;
            $candidateDetails->save();
        } else {
            CandidateDetail::where('candidate_id', $inputArray['candidate_id'])->update([
                'address' => isset($inputArray['address']) ? $inputArray['address'] : null,
                'country_id' => isset($inputArray['country_id']) ? $inputArray['country_id'] : null,
                'state_id' => isset($inputArray['state_id']) ? $inputArray['state_id'] : null,
                'city_id' => isset($inputArray['city_id']) ? $inputArray['city_id'] : null,
                'zip' => isset($inputArray['zip']) ? $inputArray['zip'] : null,
                'experience' => $yearExp . '-' . $monthExp,
                'education' => isset($inputArray['education']) ? $inputArray['education'] : null,
                'skills' => isset($inputArray['skills']) ? implode(',', $inputArray['skills']) : null
            ]);
        }

        if (!empty($inputArray['resume_file'])) {
            $filePath = config('constants.CANDIDATE_RESUME_PATH');
            $oldFileName = CandidateDetail::where('candidate_id', $inputArray['candidate_id'])->pluck('resume_file');
            File::delete($filePath . '/' . $oldFileName[0]);
            $fileName  = config('constants.CANDIDATE_PREFIX') . $inputArray['candidate_id'] . '_Resume.' . $inputArray['resume_file']->extension();
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $inputArray['resume_file']->move($filePath, $fileName);
            CandidateDetail::where('candidate_id', $inputArray['candidate_id'])->update(['resume_file' => $fileName]);
        }

        if (!empty($inputArray['flag']) && $inputArray['flag'] == 'apply-job') {
            $job = Job::where('id', $inputArray['job_id'])->where('status', StatusConstants::ACTIVE)->first();
            $applyJob = new ApplyJob();
            $applyJob->job_id = $inputArray['job_id'];
            $applyJob->candidate_id = $inputArray['candidate_id'];
            $applyJob->employer_id = $job['employer_id'];
            $applyJob->status = ApplyJobStatusConstants::APPLICATION_SENT;
            $applyJob->save();
        }
        return $inputArray['candidate_id'];
    }

    /**
     * ******************************************
     * method used to get candidate details
     * ------------------------------------------
     * @param int $candidateId
     * @return data
     * ******************************************
     */
    public function getCandidateDetails($candidateId)
    {
        return CandidateDetail::select(
            'candidate_details.id',
            'candidate_details.candidate_id',
            'candidate_details.address',
            'candidate_details.country_id',
            'candidate_details.state_id',
            'candidate_details.city_id',
            'candidate_details.zip',
            'candidate_details.resume_file',
            'candidate_details.experience',
            'candidate_details.education',
            'candidate_details.skills',
            'candidate_details.created_by',
            'candidate_details.updated_by',
            'jobs.id as jobs_id',
            'jobs.job_title',
            'jobs.job_type_id',
            'jobs.work_type_id',
            'job_types.name as jobTypeName',
            'work_types.name as workTypeName',
        )
        ->leftJoin('apply_jobs', 'apply_jobs.candidate_id', '=', 'candidate_details.candidate_id')
        ->leftJoin('jobs', 'jobs.id', '=', 'apply_jobs.job_id')
        ->leftJoin('job_types', 'job_types.id', '=', 'jobs.job_type_id')
        ->leftJoin('work_types', 'work_types.id', '=', 'jobs.work_type_id')
        ->where('candidate_details.candidate_id', $candidateId)
        ->first();
    }

    /**
     * **********************
     * User search query
     * ----------------------
     *
     * @param string $searchString
     * @return data
     * ******************************
     */
    public function autoCompleteSearchCandidate($searchString = null)
    {

        $queryBuilder = User::select('users.id', 'users.title', 'users.first_name', 'users.last_name')
            ->where('users.portal_access', '1')
            ->where('users.role_id', UserRoleConstants::USER_ROLE_CANDIDATE);

        if (!empty($searchString) && $searchString != '') {
            $queryBuilder = $queryBuilder->where('users.title', 'LIKE', "%{$searchString}%")
                ->orWhere('users.first_name', 'LIKE', "%{$searchString}%")
                ->orWhere('users.last_name', 'LIKE', "%{$searchString}%");
        }
        return $queryBuilder->orderBy('users.first_name')->limit(10)->get();
    }


    /**
     * ******************************
     * apply candidate search query
     * -----------------------------
     *
     * @param string $searchString
     * @return data
     * ******************************
     */
    public function autocompleteSearchApplyCandidate($searchString = null)
    {
        $queryBuilder = User::select('users.id', 'users.title', 'users.first_name', 'users.last_name')
            ->distinct()
            ->join('apply_jobs', 'apply_jobs.candidate_id', '=', 'users.id')
            ->where('users.portal_access', '1')
            ->where('users.role_id', UserRoleConstants::USER_ROLE_CANDIDATE)
            ->where('apply_jobs.employer_id', auth()->user()->id);
        if (!empty($searchString) && $searchString != '') {
            $queryBuilder = $queryBuilder->where('users.title', 'LIKE', "%{$searchString}%")
                ->orWhere('users.first_name', 'LIKE', "%{$searchString}%")
                ->orWhere('users.last_name', 'LIKE', "%{$searchString}%");
        }
        return $queryBuilder->orderBy('users.first_name')->limit(10)->get();
    }

    /**
     * **************************************
     * method to update candidate profile image
     * --------------------------------------
     * @param int $candidateId
     * @param array $inputdata
     * @return data
     * **************************************
     */
    public function updateCandidateProfileImage($candidateId, $inputArray)
    {
        if (!empty($inputArray['profile_photo'])) {
            $filePath = config('constants.PROFILE_PATH');
            $oldFileName = User::where('id', $candidateId)->pluck('profile_photo');
            File::delete($filePath . $oldFileName[0]);
            $fileName  = config('constants.CANDIDATE_PREFIX'). $candidateId . '.' . $inputArray['profile_photo']->extension();
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $inputArray['profile_photo']->move($filePath, $fileName);
            User::where('id', $candidateId)->update(['profile_photo' => $fileName]);
        }
        return $candidateId;
    }

    /**
     * *************************************
     * Method use to database listing data
     * -------------------------------------
     * @return data
     * @description input (title)
     * *************************************
     */
    public function getDatabaseCandidate($request)
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
            'candidate_details.candidate_id',
            'candidate_details.address',
            'candidate_details.country_id',
            'candidate_details.state_id',
            'candidate_details.city_id',
            'candidate_details.zip',
            'candidate_details.resume_file',
            'candidate_details.experience',
            'candidate_details.education',
            'candidate_details.skills',
            'candidate_details.created_by',
            'candidate_details.updated_by',
            'jobs.id as jobs_id',
            'jobs.job_title',
            'jobs.job_type_id',
            'job_types.name as jobTypeName',
            'apply_jobs.status as applyStatus'
        )
        ->join('candidate_details', 'candidate_details.candidate_id', '=', 'users.id')
        ->leftJoin('apply_jobs', 'apply_jobs.candidate_id', '=', 'users.id')
        ->leftJoin('jobs', 'jobs.id', '=', 'apply_jobs.job_id')
        ->leftJoin('job_types', 'job_types.id', '=', 'jobs.job_type_id')
        ->where('users.role_id', UserRoleConstants::USER_ROLE_CANDIDATE);
        // ->where('apply_jobs.status', '!=', ApplyJobStatusConstants::HIRED);
        if (!empty($filterData['candidate'])) {
            $queryBuilder = $queryBuilder->where('users.id', $filterData['candidate']);
        }
        // if ($filterData['job_title_id'] != '') {
        //     $queryBuilder = $queryBuilder->where('jobs.id', $filterData['job_title_id']);
        // }
        // if ($filterData['job_type_id'] != '') {
        //     $queryBuilder = $queryBuilder->where('jobs.job_type_id', $filterData['job_type_id']);
        // }
        if (!empty($filterData['education'])) {
            $queryBuilder = $queryBuilder->where('candidate_details.education', $filterData['education']);
        }
        if (!empty($filterData['deleted'])) {
            if ($filterData['deleted'] == '1') {
                $queryBuilder = $queryBuilder->where('users.deleted_at', null);
            } else {
                $queryBuilder = $queryBuilder->where('users.deleted_at', '<>', null);
            }
        }
        if (isset($filterData['status'])) {
            if ($filterData['status'] == '0') {
                $queryBuilder = $queryBuilder->where('users.status', '0');
            } else {
                $queryBuilder = $queryBuilder->where('users.status', '1');
            }
        }
        return $queryBuilder = $queryBuilder->orderBy('users.id', 'desc')->withTrashed()->get();
    }
}
