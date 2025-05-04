<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StateService;
use App\Services\CityService;
use App\Services\JobService;
use App\Services\CandidateService;

class AjaxController extends Controller
{
    private $stateService;
    private $cityService;
    private $jobService;
    private $candidateService;

    public function __construct(

        StateService $stateService,
        CityService $cityService,
        JobService $jobService,
        CandidateService $candidateService

    ) {
        $this->stateService = $stateService;
        $this->cityService = $cityService;
        $this->jobService = $jobService;
        $this->candidateService = $candidateService;
    }

    /**
     * ********************
     * method to get state
     * --------------------
     *
     * @param  request
     * @return JsonResponse
     * ************************
     */
    public function getState(Request $request)
    {
        $countryId = $request->only(['countryId']);
        $state = $this->stateService->getState($countryId);
        return response()->json(
            [
                'state' => $state
            ]
        );
    }

    /**
     * ********************
     * method to get city
     * --------------------
     *
     * @param  request
     * @return jsonResponse
     * ************************
     */
    public function getCity(Request $request)
    {
        $stateId = $request->only(['stateId']);

        $city = $this->cityService->getCity($stateId);
        return response()->json(
            [
                'city'    => $city
            ]
        );
    }

    /**
     * *******************************************
     * method used to complete search of location
     * -------------------------------------------
     * @param object $request
     * @return jsonResponse
     * *******************************************
     */
    public function autocompleteLocation(Request $request)
    {
        $users = [];
        $searchString = $request->only(['q']);
        if (isset($searchString['q']) && trim($searchString['q']) != '') {
            $users = $this->jobService->autocompleteLocation($searchString['q']);
        } else {
            $users = $this->jobService->autocompleteLocation();
        }
        return response()->json($users);
    }

     /**
     * ***************************************
     * method used to complete search of user
     * ---------------------------------------
     *
     * @param  request
     * @return jsonResponse
     * ***************************************
     */
    public function autocompleteSearchApplyCandidate(Request $request)
    {
        $users = [];
        $searchString = $request->only(['q']);
        if (isset($searchString['q']) && trim($searchString['q']) != '') {
            $users = $this->candidateService->autocompleteSearchApplyCandidate($searchString['q']);
        } else {
            $users = $this->candidateService->autocompleteSearchApplyCandidate();
        }
        return response()->json($users);
    }
}
