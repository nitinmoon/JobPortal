<?php

namespace App\Services;

use App\Models\Constants\JobStatusConstants;
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
                        $button .= '<a class="btn btn-sm btn-info text-white" href="' . route('viewdetailJob', base64_encode($row->id)) . '" title="View Job">
                        <i class="bi bi-eye"></i></a>&nbsp;&nbsp;';

                        // $button .= '<a class="btn btn-sm btn-primary btn-blue" href="' . route('editJob', base64_encode($row->id)) . '" title="Edit Job">
                        //     <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;';

                    }
                    // if ($row->deleted_at == null) {
                    //     $button .= '<a class="deleteJob btn btn-sm btn-danger" data-url="' . route('deleteJob', $row->id) . '" title="Delete Job" href="#" data-bs-toggle="modal" data-bs-target="#deleteJobModal">
                    //     <i class="bi bi-trash"></i></a>&nbsp;&nbsp;';
                    // } else {
                    //     $button .= '<a class="restoreJob btn btn-sm btn-success" data-url="' . route('restoreJob', $row->id) . '" href="#" title="Restore Job Type" data-bs-toggle="modal" data-bs-target="#restoreJobModal">
                    //     <i class="bi bi-upload"></i></a>';
                    // }
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
            ->editColumn('job_status', function ($row) {
                if ($row->deleted_at == null) {
                    $pendingSelected =  $row->job_status == JobStatusConstants::PENDING ? 'selected' : '';
                    $approvedSelected =  $row->job_status == JobStatusConstants::APPROVED ? 'selected' : '';
                    $holdSelected =  $row->job_status == JobStatusConstants::HOLD ? 'selected' : '';
                    $rejectedSelected =  $row->job_status == JobStatusConstants::REJECTED ? 'selected' : '';
                    return '<select class="form-control change-approval-status" data-url="' . route('changeJobApprovalStatus') . '" job-id="' . $row->id . '">
                        <option value="1" ' . $pendingSelected . '>Pending</option>
                        <option value="2" ' . $approvedSelected . '>Approved</option>
                        <option value="3" ' . $holdSelected . '>Hold</option>
                        <option value="4" ' . $rejectedSelected . '>Rejected</option>
                    </select>';
                } else {
                    return ('<label class="badge badge-secondary text-white">Deleted</label>');
                }
            })
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
            ->rawColumns(['action', 'vacancy', 'job_status','status'])
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
     * Function used to change job status
     * -----------------------------------------
     * @param object $request
     * @return data
     * *****************************************
     */
    public function changeJobApprovalStatus($request)
    {
        $inputArray = $request->all();
        $getData = $this->jobRepository->getById($inputArray['jobId']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->jobRepository->update($getData, $inputArray);
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
     *********************************
     * Method use to get all jobs
     * -------------------------------
     * @return data
     *********************************
     */
    public function getEmployerJobsList()
    {
        return $this->jobRepository->getEmployerJobsList();
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
