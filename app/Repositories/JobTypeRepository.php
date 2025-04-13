<?php

namespace App\Repositories;

use App\Models\Constants\StatusConstants;
use App\Models\JobType;
use App\Repositories\BaseRepository;

class JobTypeRepository extends BaseRepository
{
    public function getModel()
    {
        return new JobType();
    }

    /**
     * ******************************
     * Get designation listing data
     * ------------------------------
     * @return data
     * @description input (title)
     * ******************************
     */
    public function getJobTypes($request)
    {
        $filterData = $request->all();
        $queryBuilder = $this->getModel()->select();
        // if (!empty($filterData['deleted'])) {
        //     if ($filterData['deleted'] == '1') {
        //         $queryBuilder = $queryBuilder->where('deleted_at', null);
        //     } else {
        //         $queryBuilder = $queryBuilder->where('deleted_at', '<>', null);
        //     }
        // }
        return $queryBuilder->orderBy('id', 'desc')->withTrashed()->get();
    }

    /**
      *************************************
     * Function use to add update job type
     * ------------------------------------
     * @param array $inputArray
     * @return int $jobTypeId
      *************************************
     */
    public function addUpdateJobType($inputArray)
    {
        if ($inputArray['jobTypeId'] == 0) {
            $jobType = $this->getModel();
            $jobType->name = strip_tags($inputArray['name']);
            $jobType->created_by = auth()->user()->id;
            $jobType->save();
            $LastInsertId = $jobType->id;
            return $LastInsertId;
        } else {
            $this->getModel()->where('id', $inputArray['jobTypeId'])->update(
                [
                    'name' => strip_tags($inputArray['name']),
                    'updated_by' => auth()->user()->id,
                ]
            );
            return $inputArray['jobTypeId'];
        }
    }

    /**
     *********************************
     * Method use to get all job types
     * -------------------------------
     * @return data
     *********************************
     */
    public function getAllJobTypes()
    {
        return $this->getModel()->where('status', StatusConstants::ACTIVE)->get();
    }
}
