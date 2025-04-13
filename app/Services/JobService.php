<?php

namespace App\Services;

use App\Repositories\JobRepository;
use Yajra\DataTables\Facades\DataTables;

class JobService
{
    private $jobRepository;

    public function __construct(
        JobRepository $jobRepository,
    ) {
        $this->jobRepository = $jobRepository;
    }

    /**
     *****************************************
     * Function use to get job types Listing
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function jobAjaxDatatable($request)
    {
        $data = $this->jobRepository->getJobs($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    if ($row->deleted_at == null) {
                        $button .= '<a class="btn btn-sm btn-info " href="' . route('viewdetailJob', base64_encode($row->id)) . '" title="View Job">
                        <i class="bi bi-eye"></i></a>&nbsp;&nbsp;';

                        $button .= '<a class="btn btn-sm btn-primary btn-blue" href="' . route('editJob', base64_encode($row->id)) . '" title="Edit Job">
                            <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;';

                    }
                    if ($row->deleted_at == null) {
                        $button .= '<a class="deleteJob btn btn-sm btn-danger" data-url="' . route('deleteJob', $row->id) . '" title="Delete Job" href="#" data-bs-toggle="modal" data-bs-target="#deleteJobModal">
                        <i class="bi bi-trash"></i></a>&nbsp;&nbsp;';
                    } else {
                        $button .= '<a class="restoreJob btn btn-sm btn-success" data-url="' . route('restoreJob', $row->id) . '" href="#" title="Restore Job Type" data-bs-toggle="modal" data-bs-target="#restoreJobModal">
                        <i class="bi bi-upload"></i></a>';
                    }
                    return $button;
                }
            )
            ->addColumn(
                'job_type',
                function ($row) {
                    return $row->jobType->name;
                }
            )
            ->addColumn(
                'job_category',
                function ($row) {
                    return $row->jobCategory->name;
                }
            )
            ->addColumn(
                'vacancy',
                function ($row) {
                    return '<span class="badge rounded-pill bg-secondary">' . $row->vacancy . '</span>';
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
                        <input class="form-check-input change-job-status" type="checkbox" data-url="' . route('changeJobStatus') . '"
                            id="' . $row->id . '" ' . $activeChecked . '>
                        </div>';
                    } else {
                        return getActiveInactiveStatusBadge($row->status);
                    }
                }
            )
            ->rawColumns(['action', 'vacancy', 'status'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }

    /**
     *********************************
     * Function use to add update job
     * -------------------------------
     * @param inputArray
     * @return data
     *********************************
     */
    public function addUpdateJob($inputArray)
    {
        $this->jobRepository->addUpdateJob($inputArray);
    }

    /**
     * *****************************************
     * Function used to change job type status
     * -----------------------------------------
     * @param object $request
     * @return data
     * *****************************************
     */
    public function changeJobStatus($request)
    {
        $inputArray = $request->all();
        $getData = $this->jobRepository->getById($inputArray['jobId']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->jobRepository->update($getData, $inputArray);
    }

    /**
     *********************************
     * Method use to delete job
     * -------------------------------
     * @param int jobId
     * @return data
     *********************************
     */
    public function deleteJob($jobId)
    {
        return $this->jobRepository->getById($jobId)->delete();
    }

    /**
     ********************************
     * Method to restore job
     * ------------------------------
     * @param int jobId
     * @return data
     ********************************
     */
    public function restoreJob($jobId)
    {
        return $this->jobRepository->getModel()->where('id', $jobId)->withTrashed()->restore();
    }

    /**
     *********************************
     * Method use to get all jobs
     * -------------------------------
     * @return data
     *********************************
     */
    public function getAllJobs()
    {
        return $this->jobRepository->getAllJobs();
    }

    /**
     ***********************************************
     * Function use to get job details by id
     * ----------------------------------------------
     * @param int $jobId
     * @return data
     ***********************************************
     */
    public function getJobDetails($jobId)
    {
        return $this->jobRepository->getById($jobId);
    }

    /**
     * ********************************************
     * method used to get job category filter page
     * --------------------------------------------
     * @param object $request
     * @return data
     * ********************************************
     */
    public function jobCategoryFilter($request)
    {
        return $this->jobRepository->jobCategoryFilter($request);
    }

    /**
     * ********************************************
     * method used to get job in find job filter
     * --------------------------------------------
     * @param object $request
     * @return data
     * ********************************************
     */
    public function findJobFilter($request)
    {
        return $this->jobRepository->findJobFilter($request);
    }

    /**
     * ********************************************
     * method used to get job title filter page
     * --------------------------------------------
     * @param string $jobTitle
     * @return data
     * ********************************************
     */
    public function jobTitleFilter($jobTitle)
    {
        return $this->jobRepository->jobTitleFilter($jobTitle);
    }

    /**
     * ********************************************
     * method used to get job advanced filter
     * --------------------------------------------
     * @param object $request
     * @return data
     * ********************************************
     */
    public function jobAdvancedFilter($request)
    {
        return $this->jobRepository->jobAdvancedFilter($request);
    }

    /**
     * *******************************************
     * method used to complete search of location
     * -------------------------------------------
     * @param string $searchString
     * @return data
     * *******************************************
     */
    public function autocompleteLocation($searchString = null)
    {
        return $this->jobRepository->autocompleteLocation($searchString);
    }

    /**
     * ********************************************
     * method used to get job recent filter
     * --------------------------------------------
     * @param object $request
     * @return data
     * ********************************************
     */
    public function recentjobFilter($request)
    {
        return $this->jobRepository->recentjobFilter($request);
    }
}
