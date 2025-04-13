<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobCategoryInputRequest;
use App\Services\JobCategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Constants\UserRoleConstants;

class JobCategoryController extends Controller
{
    private $jobCategoryService;

    public function __construct(
        JobCategoryService $jobCategoryService
    ) {
        $this->jobCategoryService = $jobCategoryService;
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
            return $this->jobCategoryService->jobCategoryAjaxDatatable($request);
        }
        return view('backend.job-category.index');
    }

    /**
     * *******************************************
     * Function is used to add edit job category
     * -------------------------------------------
     * @return view
     * *******************************************
     */
    public function addJobCategoryModal()
    {
        $html = view('backend.job-category.add-edit-job-category')->render();
        return response()->json(array('body' => $html));
    }

    /**
     * ***************************************
     * method use to add update job category
     * ---------------------------------------
     * @param object $request
     * @return jsonResponse
     * ***********************************
     */
    public function addUpdateJobCategory(JobCategoryInputRequest $request)
    {
        try {
            $inputArray = $this->validateJobCategoryInput($request);
            $this->jobCategoryService->addUpdateJobCategory($inputArray);
            $msg = $inputArray['jobCategoryId'] == 0 ? 'Job Type added successfully!' : 'Job Type updated successfully!';
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
     * @description input ('name', 'jobCategoryId')
     ***********************************************************************
     */
    private function validateJobCategoryInput(Request $request)
    {
        return $request->only(
            ['name', 'icon', 'jobCategoryId']
        );
    }

    /**
     ***********************************************
     * Function use to view edit job category modal
     * ---------------------------------------------
     * @param int $jobCategoryId
     * @return jsonResponse
     ***********************************************
     */
    public function editJobCategoryModal($jobCategoryId)
    {
        $jobCategoryDetails = $this->jobCategoryService->getJobCategoryDetails($jobCategoryId);
        $html = view('backend.job-category.add-edit-job-category', compact('jobCategoryDetails'))->render();
        return response()->json(array('body' => $html));
    }

    /**
     * ********************************************
     * Function used to change job category status
     * --------------------------------------------
     * @param object $request
     * @return jsonResponse
     * ********************************************
     */
    public function changeJobCategoryStatus(Request $request)
    {
        try {
            $this->jobCategoryService->changeJobCategoryStatus($request);
            $msg = $request->status == 1 ? trans('job-category.status_active_msg'): trans('job-category.status_inactive_msg');
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
     * @param int $jobCategoryId
     * @return jsonResponse
     * *******************************
     */
    public function deleteJobCategory($jobCategoryId)
    {
        $this->jobCategoryService->deleteJobCategory($jobCategoryId);
        return response()->json(
            [
                'status' => true,
                'msg' => trans('job-category.delete_msg')
            ]
        );
    }

    /**
     * *******************************
     * method to restore job category
     * -------------------------------
     * @param int $jobCategoryId
     * @return jsonResponse
     * *******************************
     */
    public function restoreJobCategory($jobCategoryId)
    {
        $this->jobCategoryService->restoreJobCategory($jobCategoryId);
        return response()->json(
            [
                'status' => true,
                'msg' => trans('job-category.restore_msg')
            ]
        );
    }
}
