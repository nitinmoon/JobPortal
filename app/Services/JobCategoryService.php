<?php

namespace App\Services;

use App\Repositories\JobCategoryRepository;
use Yajra\DataTables\Facades\DataTables;

class JobCategoryService
{
    private $jobCategoryRepository;

    public function __construct(
        JobCategoryRepository $jobCategoryRepository,
    ) {
        $this->jobCategoryRepository = $jobCategoryRepository;
    }

    /**
     *****************************************
     * Function use to get job category listing
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function jobCategoryAjaxDatatable($request)
    {
        $data = $this->jobCategoryRepository->getJobCategory($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    if ($row->deleted_at == null) {
                        $button .= '<a class="edit-job-category btn btn-sm btn-primary btn-blue" data-url="'. route('editJobCategoryModal', $row->id) .'"
                            href="javascript:void(0)" data-bs-toggle="modal"
                            title="Edit Department" data-bs-target="#edit_department">
                            <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;';
                    }
                    if ($row->deleted_at == null) {
                        $button .= '<a class="deleteJobCategory btn btn-sm btn-danger" data-url="'. route('deleteJobCategory', $row->id) .'" title="Delete Job Category" href="#" data-bs-toggle="modal" data-bs-target="#deleteJobCategoryModal">
                        <i class="bi bi-trash"></i></a>&nbsp;&nbsp;';
                    } else {
                        $button .= '<a class="restoreJobCategory btn btn-sm btn-success" data-url="'. route('restoreJobCategory', $row->id) .'" href="#" title="Restore Job Category" data-bs-toggle="modal" data-bs-target="#restoreJobCategoryModal">
                        <i class="bi bi-upload"></i></a>';
                    }
                    return $button;
                }
            )
            ->addColumn(
                'name',
                function ($row) {
                    return $row->name;
                }
            )
            ->addColumn(
                'icon',
                function ($row) {
                    return $row->icon;
                }
            )
            ->addColumn(
                'status',
                function ($row) {
                    if ($row->deleted_at == null) {
                        $activeChecked = "";
                                if ($row->status == 1) {
                                    $activeChecked = 'checked';
                                }
                        return '<input type="hidden" name="_token" value="'.csrf_token().'">
                        <label class="switch">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" class="change-job-category-status" name="status" data-url="' . route('changeJobCategoryStatus') . '" id="' . $row->id . '" '.$activeChecked.'>
                        <span class="slider round"></span>
                        <input type="hidden" name="action" value="submit" />
                        </label>';
                    } else {
                        return getActiveInactiveStatusBadge($row->status);
                    }
                }
            )
            ->rawColumns(['action', 'name', 'icon', 'status'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }

    /**
     ******************************************
     * Function use to add update job category
     * ----------------------------------------
     * @param inputArray
     * @return data
     ******************************************
     */
    public function addUpdateJobCategory($inputArray)
    {
        $this->jobCategoryRepository->addUpdateJobCategory($inputArray);
    }

    /**
     ***********************************************
     * Function use to get job category details by id
     * ----------------------------------------------
     * @param int $jobCategoryId
     * @return data
     ***********************************************
     */
    public function getJobCategoryDetails($jobCategoryId)
    {
        return $this->jobCategoryRepository->getById($jobCategoryId);
    }

    /**
     * ********************************************
     * Function used to change job category status
     * --------------------------------------------
     * @param object $request
     * @return data
     * ********************************************
     */
    public function changeJobCategoryStatus($request)
    {
        $inputArray = $request->all();
        $getData = $this->jobCategoryRepository->getById($inputArray['jobCategoryId']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->jobCategoryRepository->update($getData, $inputArray);
    }

    /**
     *************************************
     * Method use to delete job category
     * -----------------------------------
     * @param int jobCategoryId
     * @return data
     *************************************
     */
    public function deleteJobCategory($jobCategoryId)
    {
        return $this->jobCategoryRepository->getById($jobCategoryId)->delete();
    }

    /**
     ********************************
     * Method to restore job category
     * ------------------------------
     * @param int jobCategoryId
     * @return data
     ********************************
     */
    public function restoreJobCategory($jobCategoryId)
    {
        return $this->jobCategoryRepository->getModel()->where('id', $jobCategoryId)->withTrashed()->restore();
    }

    /**
     *********************************
     * Method use to get all job types
     * -------------------------------
     * @return data
     *********************************
     */
    public function getAllJobCategory()
    {
        return $this->jobCategoryRepository->getAllJobCategory();
    }
}
