<?php

namespace App\Http\Controllers\backend;

use App\Exports\DatabaseExport;
use App\Http\Controllers\Controller;
use App\Services\CandidateService;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\SkillService;
use App\Services\StateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Constants\UserRoleConstants;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ApplyJobService;

class CandidateController extends Controller
{
    private $candidateService;
    private $countryService;
    private $stateService;
    private $cityService;
    private $skillService;
    private $applyJobService;

    public function __construct(
        CandidateService $candidateService,
        CountryService $countryService,
        StateService $stateService,
        CityService $cityService,
        SkillService $skillService,
        ApplyJobService $applyJobService
    ) {
        $this->candidateService = $candidateService;
        $this->countryService = $countryService;
        $this->stateService = $stateService;
        $this->cityService = $cityService;
        $this->skillService = $skillService;
        $this->applyJobService = $applyJobService;
    }

    /**
     * **************************************
     * Method is used to view candidate list
     * --------------------------------------
     * @param object $request
     * @return view
     * **************************************
     */
    public function index(Request $request)
    {
        if (auth()->user()->role_id != UserRoleConstants::SUPER_ADMIN) {
            return back();
        }
        if ($request->ajax()) {
            return $this->candidateService->candidateAjaxDatatable($request);
        }
        $jobType = getJobType();
        $jobTitle = getJobTitle();
        return view('backend.candidate.index', compact('jobType', 'jobTitle'));
    }

    /**
     * *************************************
     * Method is used to view add candidate
     * -------------------------------------
     * @return view
     * *************************************
     */
    public function addCandidateForm()
    {
        $title = getEnum('users', 'title');
        $gender = getEnum('users', 'gender');
        $skills =  getSkills();
        $states = [];
        $cities = [];
        // if (isset($candidateDetails->country_id) && $candidateDetails->country_id != '') {
        //     $states = $this->stateService->getState($candidateDetails->country_id);
        // }
        // if (isset($candidateDetails->state_id) && $candidateDetails->state_id != '') {
        //     $cities = $this->cityService->getCity($candidateDetails->state_id);
        // }
        $countries = $this->countryService->getAllCountry();
        return view('backend.candidate.add-edit-candidate', compact('title', 'gender', 'skills', 'countries'));
    }

     /**
     * *******************************
     * Method use to delete candidate
     * -------------------------------
     * @param int $candidateId
     * @return jsonResponse
     * *******************************
     */
    public function deleteCandidate($candidateId)
    {
        try {
            $this->candidateService->deleteCandidate($candidateId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => trans('candidate.delete_msg')
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
     * ****************************
     * method to restore candidate
     * ----------------------------
     * @param int $candidateId
     * @return jsonResponse
     * *******************************
     */
    public function restoreCandidate($candidateId)
    {
        try {
            $this->candidateService->restoreCandidate($candidateId);
            return response()->json(
                [
                    'status' => true,
                    'msg' => trans('candidate.restore_msg')
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
     * ******************************************
     * Function used to change candidate status
     * ------------------------------------------
     * @param object $request
     * @return jsonResponse
     * ******************************************
     */
    public function changeCandidateStatus(Request $request)
    {
        try {
            $this->candidateService->changeCandidateStatus($request);
            $msg = $request->status == 1 ?  'Status active successfully!' : 'Status inactive successfully!';
            saveActivityLog('Job', $msg);
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
     * *****************************
     * method use to view candidate
     * -----------------------------
     * @param int $candidateId
     * @return jsonResponse
     * ******************************
     */
    public function viewCandidate($candidateId)
    {
        $userDetails = $this->candidateService->getUserDetails(base64_decode($candidateId));
        $candidateDetails = $this->candidateService->getCandidateDetails(base64_decode($candidateId));
        $skills = $this->skillService->getAllSkills();
        return view(
            'backend.candidate.view-candidate',
            compact(
                'candidateDetails',
                'userDetails',
                'skills'
            )
        );
    }

    /**
     * *********************************************
     * method used to complete search of candidates
     * ---------------------------------------------
     *
     * @param  request
     * @return jsonResponse
     * ***************************************
     */
    public function autoCompleteSearchCandidate(Request $request)
    {
        $users = [];
        $searchString = $request->only(['q']);
        if (isset($searchString['q']) && trim($searchString['q']) != '') {
            $users = $this->candidateService->autoCompleteSearchCandidate($searchString['q']);
        } else {
            $users = $this->candidateService->autoCompleteSearchCandidate();
        }
        return response()->json($users);
    }

    /**
     * **************************************
     * Method is used to view database list
     * --------------------------------------
     * @param object $request
     * @return view
     * **************************************
     */
    public function database(Request $request)
    {
        if (auth()->user()->role_id != UserRoleConstants::EMPLOYER) {
            return back();
        }
        if ($request->ajax()) {
            return $this->candidateService->databaseAjaxDatatable($request);
        }
        $jobType = getJobType();
        $jobTitle = getJobTitle();
        return view('backend.database.index', compact('jobType', 'jobTitle'));
    }

    /**
     * ***************************************
     * method use to export database
     * ---------------------------------------
     * @param request
     * @return excelSheets
     * @description input (exportType, candidate_search, education, status, deleted)
     * *****************************************************************************
     */
    public function databaseExport(Request $request)
    {
        $data = $request->all();
        $candidateId = isset($data['candidate_search']) ? $data['candidate_search'] : '';
        $filename = 'export-database.' . $data['exportType'];
        return Excel::download(new DatabaseExport(
            $candidateId,
            $data['education'],
            $data['status'],
            $data['deleted']
        ), $filename);
    }

     /**
     * *****************************
     * method use to view candidate
     * -----------------------------
     * @param int $candidateId
     * @return jsonResponse
     * ******************************
     */
    public function getApplyJobListing(Request $request)
    {
        if ($request->ajax()) {
            return $this->applyJobService->candidateApplyJobsAjaxDatatable($request);
        }
    }

    /**
     * ****************************
     * method use to view profile
     * ----------------------------
     * @param int $authId
     * @return jsonResponse
     * ****************************
     */
    // public function myProfile()
    // {
    //     $title = getEnum('users', 'title');
    //     $genders = getEnum('users', 'gender');
    //     $states = [];
    //     $cities = [];
    //     $countries = $this->countryService->getAllCountry();
    //     return view(
    //         'frontend.candidate.my-profile',
    //         compact(
    //             'title',
    //             'genders',
    //             'countries'
    //         )
    //     );
    // }
}
