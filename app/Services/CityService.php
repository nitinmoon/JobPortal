<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\CityRepository;
use Yajra\DataTables\DataTables;
use App\Models\Constants\UserRoleConstants;

class CityService
{

    private $cityRepository;

    public function __construct(
        CityRepository $cityRepository
    ) {
        $this->cityRepository = $cityRepository;
    }

    /**
     * ***********************
     * method used to get city
     * -----------------------
     *
     * @param  stateId
     * @return data
     * ************************
     */
    public function getCity($stateId)
    {
        return $this->cityRepository->getCityByID($stateId);
    }

    /**
     * ****************************
     * method used to get all city
     * ----------------------------
     *
     * @return data
     * ****************************
     */
    public function getAllCity()
    {
        return $this->cityRepository->getModel()->get();
    }

    /**
     * *********************************
     * method used to search city
     * ---------------------------------
     *
     * @param       searchString
     * @return      data
     * @description (search using name)
     * **********************************
     */
    public function searchCityAjaxQuery($searchString = ''): object
    {
        return $this->cityRepository->searchCityAjaxQuery($searchString);
    }
}
