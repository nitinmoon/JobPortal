<?php

namespace App\Services;

use App\Repositories\JobTypeRepository;
use Yajra\DataTables\Facades\DataTables;

class JobTypeService
{
    private $jobTypeRepository;

    public function __construct(
        JobTypeRepository $jobTypeRepository,
    ) {
        $this->jobTypeRepository = $jobTypeRepository;
    }

    /**
     *****************************************
     * Function use to get job types Listing
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function jobTypeAjaxDatatable($request)
    {
        $data = $this->jobTypeRepository->getJobTypes($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    if ($row->deleted_at == null) {
                        $button .= '<a class="edit-job-type btn btn-sm btn-primary btn-blue" data-url="'. route('editJobTypeModal', $row->id) .'"
                            href="javascript:void(0)" data-bs-toggle="modal"
                            title="Edit Department" data-bs-target="#edit_department">
                            <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;';
                    }
                    if ($row->deleted_at == null) {
                        $button .= '<a class="deleteJobType btn btn-sm btn-danger" data-url="'. route('deleteJobType', $row->id) .'" title="Delete Job Type" href="#" data-bs-toggle="modal" data-bs-target="#deleteJobTypeModal">
                        <i class="bi bi-trash"></i></a>&nbsp;&nbsp;';
                    } else {
                        $button .= '<a class="restoreJobType btn btn-sm btn-success" data-url="'. route('restoreJobType', $row->id) .'" href="#" title="Restore Job Type" data-bs-toggle="modal" data-bs-target="#restoreJobTypeModal">
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
                'status',
                function ($row) {
                    if ($row->deleted_at == null) {
                        $activeChecked = "";
                        if ($row->status == 1) {
                            $activeChecked = 'checked';
                        }
                        return '<div class="form-check form-switch">
                        <input class="form-check-input change-job-type-status" type="checkbox" data-url="' . route('changeJobTypeStatus') . '"
                            id="' . $row->id . '" ' . $activeChecked . '>
                        </div>';
                    } else {
                        return getActiveInactiveStatusBadge($row->status);
                    }
                }
            )
            ->rawColumns(['action', 'name', 'status'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }

    /**
     **************************************
     * Function use to add update job type
     * ------------------------------------
     * @param inputArray
     * @return data
     **************************************
     */
    public function addUpdateJobType($inputArray)
    {
        $this->jobTypeRepository->addUpdateJobType($inputArray);
    }

    /**
     ***********************************************
     * Function use to get job type details by id
     * ----------------------------------------------
     * @param int $jobTypeId
     * @return data
     ***********************************************
     */
    public function getJobTypeDetails($jobTypeId)
    {
        return $this->jobTypeRepository->getById($jobTypeId);
    }

    /**
     * *****************************************
     * Function used to change job type status
     * -----------------------------------------
     * @param object $request
     * @return data
     * *****************************************
     */
    public function changeJobTypeStatus($request)
    {
        $inputArray = $request->all();
        $getData = $this->jobTypeRepository->getById($inputArray['jobTypeId']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->jobTypeRepository->update($getData, $inputArray);
    }

    /**
     *********************************
     * Method use to delete job type
     * -------------------------------
     * @param int jobTypeId
     * @return data
     *********************************
     */
    public function deleteJobType($jobTypeId)
    {
        return $this->jobTypeRepository->getById($jobTypeId)->delete();
    }

    /**
     ********************************
     * Method to restore job type
     * ------------------------------
     * @param int jobTypeId
     * @return data
     ********************************
     */
    public function restoreJobType($jobTypeId)
    {
        return $this->jobTypeRepository->getModel()->where('id', $jobTypeId)->withTrashed()->restore();
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
        return $this->jobTypeRepository->getAllJobTypes();
    }
}
