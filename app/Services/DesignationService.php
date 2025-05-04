<?php

namespace App\Services;

use App\Models\Designation;
use App\Repositories\DesignationRepository;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class DesignationService
{
    private $designationRepository;

    public function __construct(
        DesignationRepository $designationRepository
    ) {
        $this->designationRepository = $designationRepository;
    }

    /**
     *****************************************
     * Function use to get designations listing
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function designationAjaxDatatable($request)
    {
        $data = $this->designationRepository->getDesignation($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'name',
                function ($row) {
                    return isset($row->name) ? $row->name : '--';
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
                        return '<input type="hidden" name="_token" value="' . csrf_token() . '">
                        <label class="switch">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" class="change-designation-status" name="status" data-url="' . route('changeDesignationStatus') . '" id="' . $row->id . '" ' . $activeChecked . '>
                        <span class="slider round"></span>
                        <input type="hidden" name="action" value="submit" />
                        </label>';
                    } else {
                        return getActiveInactiveStatusBadge($row->status);
                    }
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    if ($row->deleted_at == null) {
                        $button .= '<a class="edit-designation btn btn-sm btn-primary btn-blue" data-url=" ' . route('editDesignationModal', $row->id) . ' "
                            href="javascript:void(0)" data-bs-toggle="modal"
                            title="Edit Designation" data-bs-target="#edit_designation">
                            <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;';
                    }
                    if ($row->deleted_at == null) {
                        $button .= '<a class="deleteDesignation btn btn-sm btn-danger" data-url="' . route('deleteDesignation', $row->id) . '" title="Delete Designation" href="#" data-bs-toggle="modal" data-bs-target="#deleteJobTypeModal">
                        <i class="bi bi-trash"></i></a>&nbsp;&nbsp;';
                    } else {
                        $button .= '<a class="restoreDesignation btn btn-sm btn-success" data-url="' . route('restoreDesignation', $row->id) . '" href="#" title="Restore Designation" data-bs-toggle="modal" data-bs-target="#restoreJobTypeModal">
                        <i class="bi bi-upload"></i></a>';
                    }
                    return $button;
                }
            )
            ->rawColumns(['action', 'name', 'status'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }

    /**
     *****************************************
     * Function use to add update designation
     * ----------------------------------------
     * @return data
     * @param array $inputArray
     *****************************************
     */
    public function addUpdateDesignation($inputArray)
    {
        $this->designationRepository->addUpdateDesignation($inputArray);
    }

    /**
     *****************************************
     * Function use to get designation details
     * ----------------------------------------
     * @return data
     * @param int $designationId
     *****************************************
     */
    public function getDesignationDetails($designationId)
    {
        return $this->designationRepository->getById($designationId);
    }

    /**
     * ********************************************
     * Function used to change designation status
     * --------------------------------------------
     * @param object $request
     * @return data
     * ********************************************
     */
    public function changeDesignationStatus($request)
    {
        $inputArray = $request->all();
        $getData = $this->designationRepository->getById($inputArray['designationId']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->designationRepository->update($getData, $inputArray);
    }

    /**
     *************************************
     * Method use to delete designation
     * -----------------------------------
     * @param int designationId
     * @return data
     *************************************
     */
    public function deleteDesignation($designationId)
    {
        return $this->designationRepository->getById($designationId)->delete();
    }

    /**
     ********************************
     * Method to restore designation
     * ------------------------------
     * @param int designationId
     * @return data
     ********************************
     */
    public function restoreDesignation($designationId)
    {
        return $this->designationRepository->getModel()->where('id', $designationId)->withTrashed()->restore();
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
        return $this->designationRepository->getAllDesignations();
    }
}
