<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\City;
use App\Models\Constants\StatusConstants;

class CityRepository extends BaseRepository
{
    public function getModel()
    {
        return new City();
    }

    /**
     * **********************************
     * method used to get city by id
     * ----------------------------------
     *
     * @param  stateId
     * @return data
     * **********************************
     */
    public function getCityByID($stateId)
    {
        return $this->getModel()
            ->where('state_id', $stateId)
            ->where('status', StatusConstants::ACTIVE)
            ->get(['id', 'name']);
    }

    /**
     * ***************************
     * method used to search city
     * ---------------------------
     *
     * @param       searchString
     * @return      data
     * @description (search using name)
     * *********************************
     */
    public function searchCityAjaxQuery($searchString = '')
    {
        return $this->getModel()
            ->select("id", "name")
            ->where('name', 'LIKE', "%$searchString%")
            ->limit(10)
            ->get();
    }
}
