<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\StateRepository;

class StateService
{

    private $stateRepository;

    public function __construct(
        StateRepository $stateRepository
    ) {
        $this->stateRepository = $stateRepository;
    }

    /**
     * **************************
     * method used to get state
     * --------------------------
     *
     * @param  countryId
     * @return data
     * **************************
     */
    public function getState($countryId)
    {
        return $this->stateRepository->getStateByID($countryId);
    }

    /**
     * ******************************
     * method used to get all state
     * ------------------------------
     *
     * @return data
     * ******************************
     */
    public function getAllState()
    {
        return $this->stateRepository->getModel()->get();
    }

    /**
     * ********************************
     * method used to search state
     * --------------------------------
     *
     * @param       searchString
     * @return      data
     * @description (search using name)
     * *********************************
     */
    public function searchStateAjaxQuery($searchString = ''): object
    {
        return $this->stateRepository->searchStateAjaxQuery($searchString);
    }
}
