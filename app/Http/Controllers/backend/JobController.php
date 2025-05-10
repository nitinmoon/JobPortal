<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JobService;
use App\Services\CountryService;
use App\Services\StateService;
use App\Services\CityService;
use App\Http\Requests\JobFormRequest;
use App\Services\SkillService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Constants\UserRoleConstants;

class JobController extends Controller
{
    private $jobService;
    private $countryService;
    private $stateService;
    private $cityService;
    private $skillService;

    public function __construct(
        JobService $jobService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService,
        SkillService $skillService,
    ) {
        $this->jobService = $jobService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
        $this->skillService = $skillService;
    }

    /**
     * **************************************
     * Method is used to view job list
     * --------------------------------------
     * @param object $request
     * @return view
     * **************************************
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->jobService->jobAjaxDatatable($request);
        }
        $jobCategory = getJobCategory();
        $jobType = getJobType();
        return view('backend.jobs.index', compact('jobCategory', 'jobType'));
    }


    /**
     * **************************************
     * Method is used to view add job form
     * --------------------------------------
     * @return view
     * **************************************
     */
    public function addJob()
    {
        $designation = getDesignation();
        $jobCategory = getJobCategory();
        $jobType = getJobType();
        $jobWorkType = getJobWorkType();
        $countries = $this->countryService->getAllCountry();
        $skills =  getSkills();
        $gender = getEnum('jobs', 'gender');
        $englishLevel = getEnum('jobs', 'english_level');
        return view('backend.jobs.add-edit-job', compact(
            'designation',
            'jobCategory',
            'jobType',
            'jobWorkType',
            'countries',
            'skills',
            'gender',
            'englishLevel'
        ));
    }


    /**
     * **************************************
     * Method is used to view add job form
     * --------------------------------------
     * @return view
     * **************************************
     */
    public function addUpdateJob(JobFormRequest $request)
    {
        try {
            $inputArray = $this->validateJobInput($request);
            $this->jobService->addUpdateJob($inputArray);
            $msg = $inputArray['jobId'] == 0 ? 'Job added successfully!' : 'Job updated successfully!';
            return response()->json(
                [
                    'status' => true,
                    'msg' => $msg,
                    'redirectRoute' => route('jobs')
                ]
            );
        } catch (Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }

    /**
     * **************************************
     * Method is used to view add job form
     * --------------------------------------
     * @return view
     * **************************************
     */
    public function editJob($id)
    {
        $jobDetails = $this->jobService->getJobDetails(base64_decode($id));
        $designation = getDesignation();
        $jobCategory = getJobCategory();
        $jobType = getJobType();
        $jobWorkType = getJobWorkType();
        $countries = $this->countryService->getAllCountry();
        $states = [];
        $cities = [];
        if (isset($jobDetails->country_id) && $jobDetails->country_id != '') {
            $states = $this->stateService->getState($jobDetails->country_id);
        }
        if (isset($jobDetails->state_id) && $jobDetails->state_id != '') {
            $cities = $this->cityService->getCity($jobDetails->state_id);
        }
        $skills =  getSkills();
        $gender = getEnum('jobs', 'gender');
        $englishLevel = getEnum('jobs', 'english_level');
        return view('backend.jobs.add-edit-job', compact(
            'jobDetails',
            'designation',
            'jobCategory',
            'jobType',
            'jobWorkType',
            'countries',
            'states',
            'cities',
            'skills',
            'gender',
            'englishLevel'
        ));
    }

    /**
     ********************************************
     * Function use to validate job  input
     * -------------------------------------------
     * @param object $request
     * @return object request
     * @description input ('name', 'jobTypeId')
     ***********************************************************************
     */
    private function validateJobInput(Request $request)
    {
        return $request->only(
            [
                'jobId', 'job_title', 'designation_id', 'job_category_id', 'job_type_id', 'work_type_id',
                'country_id', 'state_id', 'city_id', 'experience', 'year_experience', 'month_experience', 'salary_range', 'vacancy', 'deadline',
                'gender', 'english_level', 'skills', 'job_description', 'job_responsibility',
                'educational_requirements', 'other_benefits'
            ]
        );
    }

    /**
     * ***********************************
     * Function used to change job status
     * -----------------------------------
     * @param object $request
     * @return jsonResponse
     * ***********************************
     */
    public function changeJobApprovalStatus(Request $request)
    {
        try {
            $this->jobService->changeJobApprovalStatus($request);
            return response()->json(
                [
                    'status' => true,
                    'msg' => 'Status updated successfully!'
                ]
            );
        } catch (Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json([
                'status' => false,
                'msg' => $exception->getMessage()
            ]);
        }
    }

    /**
     * ***********************************
     * Function used to change job status
     * -----------------------------------
     * @param object $request
     * @return jsonResponse
     * ***********************************
     */
    public function changeJobStatus(Request $request)
    {
        try {
            $this->jobService->changeJobStatus($request);
            $msg = $request->status == 1 ?  'Status active successfully!' : 'Status inactive successfully!';
            return response()->json(
                [
                    'status' => true,
                    'msg' => $msg
                ]
            );
        } catch (Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json([
                'status' => false,
                'msg' => $exception->getMessage()
            ]);
        }
    }


    /**
     * *******************************
     * Method use to delete job
     * -------------------------------
     * @param int $jobId
     * @return jsonResponse
     * *******************************
     */
    public function deleteJob($jobId)
    {
        try {
            $this->jobService->deleteJob($jobId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Job deleted successfully!"
                ]
            );
        } catch (Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json([
                'status' => false,
                'msg' => $exception->getMessage()
            ]);
        }
    }

    /**
     * ****************************
     * method to restore job type
     * ----------------------------
     * @param int $jobTypeId
     * @return jsonResponse
     * *******************************
     */
    public function restoreJob($jobId)
    {
        try {
            $this->jobService->restoreJob($jobId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Job restored successfully!"
                ]
            );
        } catch (Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json([
                'status' => false,
                'msg' => $exception->getMessage()
            ]);
        }
    }

    /**
     * ***********************************
     * Function used to view job details
     * -----------------------------------
     * @param object $request
     * @return jsonResponse
     * ***********************************
     */
    public function jobDetails($id)
    {

        $jobDetails = $this->jobService->getJobDetails(base64_decode($id));
        $skills = $this->skillService->getAllSkills();
        return view(
            'backend.jobs.view-details',
            compact(
                'jobDetails',
                'skills'
            )
        );
    }

    /**
     * ********************************
     * Method to download resume
     *---------------------------------
     * @param fileName
     * @return Data
     **********************************
     */
    public function downloadResume($fileName = null)
    {
        try {
            $file = config('constants.CANDIDATE_RESUME_PATH') . "/" .$fileName;
            $headers = array(
                'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            );
            return response()->download($file, $fileName, $headers);
        } catch (Exception $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }
}
