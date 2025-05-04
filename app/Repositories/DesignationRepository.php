<?php

namespace App\Repositories;

use App\Models\Constants\StatusConstants;
use App\Models\Designation;
use App\Repositories\BaseRepository;

class DesignationRepository extends BaseRepository
{
    public function getModel()
    {
        return new Designation();
    }

    /**
     * *************************************
     * Method use to designation listing data
     * -------------------------------------
     * @return data
     * @description input (title)
     * *************************************
     */
    public function getDesignation($request)
    {
        $filterData = $request->all();
        return $this->getModel()
        ->orderBy('id', 'desc')->withTrashed()->get();
    }

    /**
      *****************************************
     * Function use to add update designation
     * ----------------------------------------
     * @param array $inputArray
     * @return int $designationId
      *****************************************
     */
    public function addUpdateDesignation($inputArray)
    {
        if ($inputArray['designationId'] == 0) {
            $designation = $this->getModel();
            $designation->name = strip_tags($inputArray['name']);
            $designation->created_by = auth()->user()->id;
            $designation->save();
            $LastInsertId = $designation->id;
            return $LastInsertId;
        } else {
            $this->getModel()->where('id', $inputArray['designationId'])->update(
                [
                    'name' => strip_tags($inputArray['name']),
                    'updated_by' => auth()->user()->id,
                ]
            );
            return $inputArray['designationId'];
        }
    }

    /**
     ********************************
     * Method to get all designation
     * ------------------------------
     * @return data
     ********************************
     */
    public function getAllDesignations()
    {
        return Designation::select('id', 'name')->where('status', '1')->orderBy('name', 'asc')->get();
    }
}
