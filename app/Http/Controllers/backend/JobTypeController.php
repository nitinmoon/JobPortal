<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobTypeInputRequest;
use App\Services\JobTypeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Constants\UserRoleConstants;

class JobTypeController extends Controller
{
    private $jobTypeService;

    public function __construct(
        JobTypeService $jobTypeService
    ) {
        $this->jobTypeService = $jobTypeService;
    }

    /**
     * **************************************
     * Method is used to view job types list
     * --------------------------------------
     * @param object $request
     * @return view
     * **************************************
     */
    public function index(Request $request)
    {
        if (auth()->user()->role_id != UserRoleConstants::USER_ROLE_ADMIN) {
            return back();
        }
        if ($request->ajax()) {
            return $this->jobTypeService->jobTypeAjaxDatatable($request);
        }
        return view('backend.job-types.index');
    }

    /**
     * ***************************************
     * Function is used to add edit job type
     * ---------------------------------------
     * @return view
     * ***************************************
     */
    public function addJobTypeModal()
    {
        $html = view('backend.job-types.add-edit-job-type')->render();
        return response()->json(array('body' => $html));
    }

    /**
     * ***********************************
     * method use to add update job type
     * -----------------------------------
     * @param object $request
     * @return jsonResponse
     * ***********************************
     */
    public function addUpdateJobType(JobTypeInputRequest $request)
    {
        try {
            $inputArray = $this->validateJobTypeInput($request);
            $this->jobTypeService->addUpdateJobType($inputArray);
            $msg = $inputArray['jobTypeId'] == 0 ? 'Job Type added successfully!' : 'Job Type updated successfully!';
            return response()->json(
                [
                    'status' => true,
                    'msg' => $msg
                ]
            );
        } catch (Exception  $exception) {
            Log::channel('exceptionLog')->error("Exception: ".$exception->getMessage().' in '.$exception->getFile().' StackTrace:'.$exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }

    /**
     ********************************************
     * Function use to validate job type input
     * -------------------------------------------
     * @param object $request
     * @return object request
     * @description input ('name', 'jobTypeId')
     ***********************************************************************
     */
    private function validateJobTypeInput(Request $request)
    {
        return $request->only(
            ['name', 'jobTypeId']
        );
    }

    /**
     *******************************************
     * Function use to view edit job type modal
     * -----------------------------------------
     * @param int $jobTypeId
     * @return jsonResponse
     *******************************************
     */
    public function editJobTypeModal($jobTypeId)
    {
        $jobTypeDetails = $this->jobTypeService->getJobTypeDetails($jobTypeId);
        $html = view('backend.job-types.add-edit-job-type', compact('jobTypeDetails'))->render();
        return response()->json(array('body' => $html));
    }

    /**
     * ************************************************
     * Function used to change academy feedback status
     * ------------------------------------------------
     * @param object $request
     * @return jsonResponse
     * ************************************************
     */
    public function changeJobTypeStatus(Request $request)
    {
        try {
            $this->jobTypeService->changeJobTypeStatus($request);
            $msg = $request->status == 1 ? trans('job-type.status_active_msg'): trans('job-type.status_inactive_msg');
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
     * Method use to delete job type
     * -------------------------------
     * @param int $jobTypeId
     * @return jsonResponse
     * *******************************
     */
    public function deleteJobType($jobTypeId)
    {
        $this->jobTypeService->deleteJobType($jobTypeId);
        return response()->json(
            [
                'status' => true,
                'msg' => trans('job-type.delete_msg')
            ]
        );
    }

    /**
     * ****************************
     * method to restore job type
     * ----------------------------
     * @param int $jobTypeId
     * @return jsonResponse
     * *******************************
     */
    public function restoreJobType($jobTypeId)
    {
        $this->jobTypeService->restoreJobType($jobTypeId);
        return response()->json(
            [
                'status' => true,
                'msg' => trans('job-type.restore_msg')
            ]
        );
    }
}
