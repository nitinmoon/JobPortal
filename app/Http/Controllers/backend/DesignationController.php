<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesignationInputRequest;
use App\Models\Constants\UserRoleConstants;
use App\Services\DesignationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DesignationController extends Controller
{
    private $designationService;

    public function __construct(
        DesignationService $designationService,
    ) {
        $this->designationService = $designationService;
    }

    /**
     * ****************************************
     * Method is used to view designation list
     * ----------------------------------------
     * @param object $request
     * @return view
     * ****************************************
     */
    public function index(Request $request)
    {
        if (auth()->user()->role_id != UserRoleConstants::USER_ROLE_ADMIN) {
            return back();
        }
        if ($request->ajax()) {
            return $this->designationService->designationAjaxDatatable($request);
        }
        $jobType = getJobType();
        return view('backend.designation.index', compact('jobType'));
    }

    /**
     * ****************************************
     * Method is used to add designation modal
     * ----------------------------------------
     * @param object $request
     * @return view
     * ****************************************
     */
    public function addDesignationModal(Request $request)
    {
        $html = view('backend.designation.add-edit-designation')->render();
        return response()->json(array('body' => $html));
    }

    /**
     * *************************************
     * method use to add update designation
     * -------------------------------------
     * @param object $request
     * @return jsonResponse
     * *************************************
     */
    public function addUpdateDesignation(DesignationInputRequest $request)
    {
        try {
            $inputArray = $this->validateDesignationInput($request);
            $this->designationService->addUpdateDesignation($inputArray);
            $msg = $inputArray['designationId'] == 0 ? 'Designation added successfully!' : 'Designation updated successfully!';
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
     * Function use to validate designation input
     * -------------------------------------------
     * @param object $request
     * @return object request
     * @description input ('name', 'designationId')
     ***********************************************************************
     */
    private function validateDesignationInput(Request $request)
    {
        return $request->only(
            ['name', 'designationId']
        );
    }

    /**
     ***********************************************
     * Function use to view edit designation modal
     * ---------------------------------------------
     * @param int $designationId
     * @return jsonResponse
     ***********************************************
     */
    public function editDesignationModal($designationId)
    {
        $designationDetails = $this->designationService->getDesignationDetails($designationId);
        $html = view('backend.designation.add-edit-designation', compact('designationDetails'))->render();
        return response()->json(array('body' => $html));
    }

    /**
     * ********************************************
     * Function used to change designation status
     * --------------------------------------------
     * @param object $request
     * @return jsonResponse
     * ********************************************
     */
    public function changeDesignationStatus(Request $request)
    {
        try {
            $this->designationService->changeDesignationStatus($request);
            $msg = $request->status == 1 ? "Designation active successfully!": "Designation inactive successfully!";
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
     * *********************************
     * Method use to delete designation
     * ---------------------------------
     * @param int $designationId
     * @return jsonResponse
     * *********************************
     */
    public function deleteDesignation($designationId)
    {
        try {
            $this->designationService->deleteDesignation($designationId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Designation deleted successfully!"
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
     * method use to restore designation
     * -----------------------------------
     * @param int $designationId
     * @return jsonResponse
     * ***********************************
     */
    public function restoreDesignation($designationId)
    {
        try {
            $this->designationService->restoreDesignation($designationId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => "Designation restore successfully!"
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
}
