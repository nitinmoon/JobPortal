<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\CountryRepository;
use Yajra\DataTables\DataTables;
use App\Models\Constants\UserRoleConstants;

class CountryService
{

    private $countryRepository;

    public function __construct(
        CountryRepository $countryRepository
    ) {
        $this->countryRepository = $countryRepository;
    }

    /**
     * ********************************
     * method used to get all country
     * --------------------------------
     *
     * @return data
     * ********************************
     */
    public function getAllCountry()
    {
        return $this->countryRepository->getModel()->get();
    }

    /**
     * ******************************
     * method used to search country
     * ------------------------------
     *
     * @param       searchString
     * @return      data
     * @description (search using name)
     * *******************************
     */
    public function searchCountryAjaxQuery($searchString = ''): object
    {
        return $this->countryRepository->searchCountryAjaxQuery($searchString);
    }
}
