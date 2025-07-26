<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApplyJobService;
use App\Services\CountryService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Constants\UserRoleConstants;

class ApplyJobController extends Controller
{
    private $applyJobService;
    private $countryService;

    public function __construct(
        ApplyJobService $applyJobService,
        CountryService $countryService
    ) {
        $this->applyJobService = $applyJobService;
        $this->countryService = $countryService;
    }

    /**
     * ********************************************
     * Method is used to view apply job candidate
     * --------------------------------------------
     * @param object $request
     * @return view
     * ********************************************
     */
    public function index(Request $request)
    {
        $jobCategory = getJobCategory();
        $jobType = getJobType();
        if ($request->ajax()) {
            return $this->applyJobService->applyCandidatesJobAjaxDatatable($request);
        }
        $countries = $this->countryService->getAllCountry();
        return view('backend.apply-jobs.index', compact('jobCategory', 'jobType', 'countries'));
    }

    /**
     * ****************************************
     * Function used to change apply job status
     * ----------------------------------------
     * @param object $request
     * @return jsonResponse
     * ****************************************
     */
    public function applyJobChangeStatus(Request $request)
    {
        try {
            $inputArray = $this->validateApplyChangeStatusJobInput($request);
            $this->applyJobService->changeApplyJobStatus($inputArray);
            $msg = 'Status changed successfully!';
            saveActivityLog('Apply Job', $msg);
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
     *********************************************************
     * Function use to validate apply job change status input
     * -------------------------------------------------------
     * @param object $request
     * @return object request
     *********************************************************
     */
    private function validateApplyChangeStatusJobInput(Request $request)
    {
        return $request->only(
            [
                'id', 'status'
            ]
        );
    }
}
