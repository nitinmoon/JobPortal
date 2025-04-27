<?php

use App\Models\ActivityLog;
use App\Models\ApplyJob;
use App\Models\Constants\StatusConstants;
use App\Models\Designation;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\Skill;
use App\Models\User;
use App\Models\WorkType;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Request;

/**
 * ****************************************
 * method use to get all enum values
 * ----------------------------------------
 * @param string $table
 * @param string $name
 * @return data
 * ****************************************
 */
if (!function_exists('getEnum')) {
    function getEnum($table, $name)
    {
        $type = 'SHOW COLUMNS FROM ' . $table . ' WHERE Field = "' . $name . '"';
        $type = DB::select($type)[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[] = $v;
        }
        return $enum;
    }
}

/**
 * ***************************
 * method use to get gender
 * ---------------------------
 * @param string $gender
 * @return data
 * ***************************
 */
if (!function_exists('getGender')) {
    function getGender($gender)
    {
        if ($gender == '1') {
            $genderName = "Male";
        } elseif ($gender == '2') {
            $genderName = "Female";
        } elseif ($gender == '3') {
            $genderName = "Transgenders";
        } else {
            $genderName = "Others";
        }
        return $genderName;
    }
}

/**
 * *********************************
 * method use to get english level
 * --------------------------------
 * @param string $englishLevel
 * @return data
 * *********************************
 */
if (!function_exists('englishLevel')) {
    function englishLevel($englishLevel)
    {
        if ($englishLevel == '1') {
            $englishLevel = "Beginner";
        } elseif ($englishLevel == '2') {
            $englishLevel = "Intermediate";
        } else {
            $englishLevel = "Advanced";
        }
        return $englishLevel;
    }
}

/**
 ****************************************
 * method use to active / inactive badge
 * ---------------------------------------
 * @return data
 ****************************************
 */
if (!function_exists('getActiveInactiveStatusBadge')) {
    function getActiveInactiveStatusBadge($status)
    {
        return $status == StatusConstants::ACTIVE ? "<span class='badge bg-success'>ACTIVE</span>" :
            "<span class='badge bg-danger'>INACTIVE</span>";
    }
}

/**
 ****************************************
 * method use to active / inactive badge
 * ---------------------------------------
 * @return data
 ****************************************
 */
if (!function_exists('getJobTypeBadgeColor')) {
    function getJobTypeBadgeColor($jobType)
    {
        if ($jobType == 'Full Time') {
            $color = 'job-btn4';
        } elseif ($jobType == 'Part Time') {
            $color = 'job-btn1';
        } elseif ($jobType == 'Intern') {
            $color = 'job-btn2';
        } else {
            $color = 'job-btn3';
        }
        return $color;
    }
}

/**
 ****************************************
 * method use to get designation
 * ---------------------------------------
 * @return data
 ****************************************
 */
if (!function_exists('getDesignation')) {
    function getDesignation()
    {
        return Designation::select('id', 'name')->where('status', '1')->orderBy('name', 'asc')->get();
    }
}

/**
 ****************************************
 * method use to get job category
 * ---------------------------------------
 * @return data
 ****************************************
 */
if (!function_exists('getJobCategory')) {
    function getJobCategory()
    {
        return JobCategory::select('id', 'name')->where('status', '1')->orderBy('name', 'asc')->get();
    }
}

/**
 ****************************************
 * method use to get job type
 * ---------------------------------------
 * @return data
 ****************************************
 */
if (!function_exists('getJobType')) {
    function getJobType()
    {
        return JobType::select('id', 'name')->where('status', '1')->orderBy('name', 'asc')->get();
    }
}

/**
 ****************************************
 * method use to get job work type
 * ---------------------------------------
 * @return data
 ****************************************
 */
if (!function_exists('getJobWorkType')) {
    function getJobWorkType()
    {
        return WorkType::select('id', 'name')->where('status', '1')->orderBy('name', 'asc')->get();
    }
}

/**
 ****************************************
 * method use to get job work type
 * ---------------------------------------
 * @return data
 ****************************************
 */
if (!function_exists('getSkills')) {
    function getSkills()
    {
        return Skill::select('id', 'name')->where('status', '1')->orderBy('name', 'asc')->get();
    }
}


/**
 * ********************************
 * method use to save activity log
 * --------------------------------
 *  @param string $section
 * @param string $message
 * @param int $userId
 * @return void
 * ****************
 * ********************************
 */
if (!function_exists('saveActivityLog')) {
    function saveActivityLog($section, $activityName, $userId = null)
    {
        $userId = empty($userId) ? auth()->user()->id : $userId;
        $agent = new Agent();
        $deviceType = '';
        if ($agent->isMobile()) {
            $deviceType = 'Mobile';
        } elseif ($agent->isTablet()) {
            $deviceType = 'Tablet';
        } elseif ($agent->isDesktop()) {
            $deviceType = 'Desktop';
        }
        $inputArray = [
            'section' => $section,
            'activity_name' => $activityName,
            'user_id' => $userId,
            'device_type' => $deviceType,
            'ip_address' => Request::ip(),
            'browser' => $agent->browser(),
            'added_on' => date('Y-m-d H:i:s')
        ];
        ActivityLog::create($inputArray);
    }
}

/**
 **********************************************
 * method use to applied job status color badge
 * --------------------------------------------
 * @return data
 **********************************************
 */
if (!function_exists('getJobAppliedBadgeColor')) {
    function getJobAppliedBadgeColor($status)
    {
        if ($status == '1') {
            $color = 'warning';
        } elseif ($status == '2') {
            $color = 'primary';
        } elseif ($status == '3') {
            $color =  'success';
        } else {
            $color = '';
        }
        return $color;
    }
}

/**
 **********************************************
 * method use to applied job status color badge
 * --------------------------------------------
 * @return data
 **********************************************
 */
if (!function_exists('getJobAppliedStatusName')) {
    function getJobAppliedStatusName($status)
    {
        if ($status == '1') {
            $statusName = 'Application Sent';
        } elseif ($status == '2') {
            $statusName = 'Resume Viewed';
        } elseif ($status == '3') {
            $statusName =  'Shortlisted';
        } else {
            $statusName = '';
        }
        return $statusName;
    }
}

/**
  **************************
 * method use to get title
 * ---------------------------
 * @param string $title
 * @return data
  **************************
 */
if (!function_exists('getTitle')) {
    function getTitle($title)
    {
        if ($title == 1) {
            $titleName = "Mr";
        } elseif ($title == 2) {
            $titleName = "Mrs";
        } elseif ($title == 3) {
            $titleName = "Miss";
        } elseif ($title == 4){
            $titleName = "Other";
        } else {
            $titleName = '';
        }
        return $titleName;
    }
}

/**
  ************************************
 * method use to get size array
 * -------------------------------------
 * @return data
  *************************************
 */
if (!function_exists('educationArray')) {
    function educationArray()
    {
        return [
            '10 th',
            '12 th',
            'Diploma',
            'ITI',
            'Graduate',
            'Post Graduate',
            'PhD'
        ];
    }
}

/**
  *****************************************
 * method use to check candidate ApplyJob
 * ----------------------------------------
 * @return data
  *****************************************
 */
if (!function_exists('isCandidateApplyJob')) {
    function isCandidateApplyJob($candidateId, $jobId)
    {
        return ApplyJob::where('candidate_id', $candidateId)->where('job_id', $jobId)->first();
    }
}

/**
 * ***************************
 * method use to get gender
 * ---------------------------
 * @param string $gender
 * @return data
 * ***************************
 */
if (!function_exists('getUserGender')) {
    function getUserGender($gender)
    {
        if ($gender == 'M') {
            $genderName = "Male";
        } elseif ($gender == 'F') {
            $genderName = "Female";
        } elseif ($gender == 'T') {
            $genderName = "Transgender";
        } else {
            $genderName = "Others";
        }
        return $genderName;
    }
}

/**
  ************************************
 * method use to get size array
 * -------------------------------------
 * @return data
  *************************************
 */
if (!function_exists('jobCount')) {
    function jobCount($field, $Id)
    {
        return Job::where($field, $Id)->where('status', StatusConstants::ACTIVE)->count();
    }
}

/**
  *******************************
 * method use to get users count
 * ------------------------------
 * @return data
  *******************************
 */
if (!function_exists('getDashboardUsersCount')) {
    function getDashboardUsersCount($roleId)
    {
        return User::where('role_id', $roleId)->where('status', StatusConstants::ACTIVE)->count();
    }
}

/**
 *******************************
 * method use to get job title
 * -----------------------------
 * @return data
 *******************************
 */
if (!function_exists('getJobTitle')) {
    function getJobTitle()
    {
        return Job::select('id', 'job_title')->where('status', '1')->orderBy('job_title', 'asc')->get();
    }
}