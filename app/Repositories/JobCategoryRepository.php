<?php

namespace App\Repositories;

use App\Models\Constants\StatusConstants;
use App\Models\JobCategory;
use App\Repositories\BaseRepository;

class JobCategoryRepository extends BaseRepository
{
    public function getModel()
    {
        return new JobCategory();
    }

    /**
     * ****************************************
     * Method use to job category listing data
     * ----------------------------------------
     * @return data
     * @description input (title)
     * ****************************************
     */
    public function getJobCategory($request)
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
      *****************************************
     * Function use to add update job category
     * ----------------------------------------
     * @param array $inputArray
     * @return int $jobCategoryId
      *****************************************
     */
    public function addUpdateJobCategory($inputArray)
    {
        if ($inputArray['jobCategoryId'] == 0) {
            $jobCategory = $this->getModel();
            $jobCategory->name = strip_tags($inputArray['name']);
            $jobCategory->icon = strip_tags($inputArray['icon']);
            $jobCategory->created_by = auth()->user()->id;
            $jobCategory->save();
            $LastInsertId = $jobCategory->id;
            return $LastInsertId;
        } else {
            $this->getModel()->where('id', $inputArray['jobCategoryId'])->update(
                [
                    'name' => strip_tags($inputArray['name']),
                    'icon' => strip_tags($inputArray['icon']),
                    'updated_by' => auth()->user()->id,
                ]
            );
            return $inputArray['jobCategoryId'];
        }
    }

    /**
     *************************************
     * Method use to get all job category
     * -----------------------------------
     * @return data
     *************************************
     */
    public function getAllJobCategory()
    {
        return $this->getModel()->where('status', StatusConstants::ACTIVE)->get();
    }
}
