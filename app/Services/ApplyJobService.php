<?php

namespace App\Services;

use App\Repositories\ApplyJobRepository;
use Yajra\DataTables\Facades\DataTables;

class ApplyJobService
{
    private $applyJobRepository;

    public function __construct(
        ApplyJobRepository $applyJobRepository,
    ) {
        $this->applyJobRepository = $applyJobRepository;
    }

    /**
     *****************************************
     * Function use to get appy job candidates
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function applyCandidatesJobAjaxDatatable($request)
    {
        $data = $this->applyJobRepository->getCandidateApplyJobsList($request);
        return DataTables::of($data)
            ->addIndexColumn()
           ->addColumn('company_name', function ($row) {
                return '<a href="#">' . (!empty($row->company_name) ? $row->company_name : '--') . '</a>';
            })

            ->addColumn('candidate_name', function ($row) {
                if (!empty($row->candidate_id)) {
                    $fullName = trim("{$row->first_name} {$row->middle_name} {$row->last_name}");
                    return '<a href="#">' . $fullName . '</a>';
                }
                return '--';
            })
            ->addColumn(
                'job_title',
                function ($row) {
                    return isset($row->job_title) ? $row->job_title : '--';
                }
            )
            ->addColumn(
                'applied_date',
                function ($row) {
                    return isset($row->applyDate) ? date('Y-m-d', strtotime($row->applyDate)) : '--';
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    $button .= '<a class="btn btn-sm btn-primary btn-blue" href="'.route('downloadResume', $row->resume_file).'" title="Download Resume" download>
                        <i class="bi bi-download"></i></a>&nbsp;&nbsp;';
                    return $button;
                }
            )
            ->rawColumns(['company_name', 'candidate_name', 'job_title', 'applied_date', 'action'])
            ->removeColumn('updated_at', 'id')
            ->make(true);
    }

    /**
     * *****************************************
     * Function used to change job type status
     * -----------------------------------------
     * @param object $request
     * @return data
     * *****************************************
     */
    public function changeApplyJobStatus($inputArray)
    {
        $getData = $this->applyJobRepository->getById($inputArray['id']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->applyJobRepository->update($getData, $inputArray);
    }

    /**
     *****************************************************
     * Function use to get total applied candidates count
     * --------------------------------------------------
     * @param string $total
     * @return data
     *****************************************************
     */
    public function getTotalApplyJobCount($total = null)
    {
        return $this->applyJobRepository->getTotalApplyJobCount($total);
    }

    /**
     ***************************************************************
     * Function use to get total applied candidates count by status
     * -------------------------------------------------------------
     * @param string $status
     * @return data
     ***************************************************************
     */
    public function geApplyJobCountByStatus($status)
    {
        return $this->applyJobRepository->geApplyJobCountByStatus($status);
    }

    /**
     *****************************************************
     * Function use to get total applied candidates count
     * --------------------------------------------------
     * @param string $total
     * @return data
     *****************************************************
     */
    public function getTodaysApplyJobCandidate()
    {
        return $this->applyJobRepository->getTodaysApplyJobCandidate();
    }

    /**
     *****************************************
     * Function use to get appy job candidates
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function candidateApplyJobsAjaxDatatable($request)
    {
        $data = $this->applyJobRepository->getCandidateApplyJobsList($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'company_name',
                function ($row) {
                    return isset($row->employer_id) ? $row->company_name : '--';
                }
            )
            ->addColumn(
                'job_title',
                function ($row) {
                    return isset($row->job_id) ? $row->job_title : '--';
                }
            )
            ->addColumn(
                'apply_date',
                function ($row) {
                    return isset($row->applyDate) ? date('y m d', strtotime($row->applyDate)) : '--';
                }
            )
            ->rawColumns(['company_name', 'job_title', 'apply_date'])
            ->removeColumn('updated_at', 'id')
            ->make(true);
    }

    /**
     *********************************************************
     * Function use to get total applied job candidates count
     * -------------------------------------------------------
     * @param string $total
     * @return data
     *********************************************************
     */
    public function getApplyJobCount($request)
    {
        return $this->applyJobRepository->getApplyJobCount($request);
    }

    /**
     ************************************
     * Function use to get applied jobs
     * ----------------------------------
     * @param string $total
     * @return data
     ************************************
     */
    public function getAppliedJobs($candidateId)
    {
        return $this->applyJobRepository->getAppliedJobs($candidateId);
    }
}
