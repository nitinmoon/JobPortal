<?php

namespace App\Repositories;

use App\Models\ContactMessage;
use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    public function getModel()
    {
        return new ContactMessage();
    }

    /**
     * ************************************
     * Method use to get contact messages
     * ------------------------------------
     * @return data
     * ************************************
     */
    public function getContacts($request)
    {
        $filterData = $request->all();
        $queryBuilder = $this->getModel();
        return $queryBuilder->orderBy('id', 'desc')->get();
    }
}