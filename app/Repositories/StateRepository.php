<?php

namespace App\Repositories;

use App\Models\Constants\StatusConstants;
use App\Repositories\BaseRepository;
use App\Models\State;

class StateRepository extends BaseRepository
{
    public function getModel()
    {
        return new State();
    }

    /**
     * **************************************
     * method use to get state by id
     * ---------------------------------------
     *
     * @param  countryId
     * @return data
     * ***************************************************
     */
    public function getStateByID($countryId)
    {
        return $this->getModel()
            ->where('country_id', $countryId)
            ->where('status', StatusConstants::ACTIVE)
            ->get(['id', 'name']);
    }

    /**
     * *******************************
     * method used to search state
     * -------------------------------
     *
     * @param       searchString
     * @return      data
     * @description (search using name)
     * ********************************
     */
    public function searchStateAjaxQuery($searchString = '')
    {
        return $this->getModel()
            ->select("id", "name")
            ->where('name', 'LIKE', "%$searchString%")
            ->limit(10)
            ->get();
    }
}
