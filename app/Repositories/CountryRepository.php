<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Country;

class CountryRepository extends BaseRepository
{
    public function getModel()
    {
        return new Country();
    }

    /**
     * ********************************
     * method to search country
     * --------------------------------
     *
     * @param       searchString
     * @return      data
     * @description (search using name)
     * *********************************
     */
    public function searchCountryAjaxQuery($searchString = '')
    {
        return $this->getModel()
            ->select("id", "name")
            ->where('name', 'LIKE', "%$searchString%")
            ->limit(10)
            ->get();
    }
}
