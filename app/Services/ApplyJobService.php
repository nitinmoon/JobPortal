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
        $data = $this->applyJobRepository->getApplyJobs($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'job_category',
                function ($row) {
                    return $row->job->jobCategory->name;
                }
            )
            ->addColumn(
                'job_type',
                function ($row) {
                    return $row->job->jobType->name;
                }
            )
            ->addColumn(
                'job_title',
                function ($row) {
                    return $row->job->job_title;
                }
            )
            ->addColumn(
                'candidate_name',
                function ($row) {
                    return $row->candidate->first_name . " " . $row->candidate->last_name;
                }
            )
            ->addColumn(
                'created_at',
                function ($row) {
                    return date('Y-m-d', strtotime($row->created_at));
                }
            )
            ->addColumn(
                'candidate_contact',
                function ($row) {
                    return '<a href="mailto:' . strip_tags($row->candidate->email) . '"><i class="bi bi-envelope"></i> ' . strip_tags($row->candidate->email) . '</a><br>
                    <a href="tel:' . strip_tags($row->candidate->phone) . '"><i class="bi bi-telephone"></i> ' . strip_tags($row->candidate->phone) . '</a>';
                }
            )
            ->addColumn(
                'status',
                function ($row) {
                    $applicationSent = "";
                    $resumeViewed = "";
                    $shortlisted = "";
                    $applicationSentDisabled = "disabled";
                    if ($row->status == '1') {
                        $applicationSent = 'selected';
                    } else if ($row->status == '2') {
                        $resumeViewed = 'selected';
                    } else if ($row->status == '3') {
                        $shortlisted = 'selected';
                    }

                    $showManagerType = '';
                    $showManagerType .= '<select class="js-example-basic-single application_status' . $row->id . '"
                        id="application_status' . $row->id . '"  onchange="applicationStatusFunction(' . $row->id . ')"
                        name="application_status" style="width:100% !important">
                                    <option value="1" ' . $applicationSent . ' '.$applicationSentDisabled.'>Application Sent</option>
                                    <option value="2" ' . $resumeViewed . '>Resume Viewed</option>
                                    <option value="3" ' . $shortlisted . '>Shortlisted</option>
                                </select>
                                ';

                    return $showManagerType;
                }
            )
            ->addColumn(
                'job_location',
                function ($row) {
                    $country = isset($row->countryName) && $row->countryName != '' ? $row->countryName : '-';
                    $state = isset($row->stateName) && $row->stateName != '' ? $row->stateName : '-';
                    $city = isset($row->cityName) && $row->cityName != '' ? $row->cityName : '-';
                    return $city.', '.$state.', '.$country;
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    // $button .= '<a class="btn btn-sm btn-info " href="" title="View Resume">
                    // <i class="bi bi-eye"></i></a>&nbsp;&nbsp;';
                    $button .= '<a class="btn btn-sm btn-primary btn-blue" href="'.route('downloadResume', $row->resume_file).'" title="Download Resume" download>
                        <i class="bi bi-download"></i></a>&nbsp;&nbsp;';
                    if ($row->resume_file != null) {
                        $button .='<a class="btn btn-sm btn-info btn-blue view-resume" data-url=" '.route('viewResumeModal', $row->candidate_id).' " title="View Resume" View>
                            <i class="bi bi-file-pdf"></i></a>&nbsp;&nbsp;';
                    }
                    return $button;
                }
            )
            ->rawColumns(['job_category', 'job_type', 'job_title', 'status', 'candidate_contact', 'created_at', 'action'])
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
                'job_title',
                function ($row) {
                    return $row->job->job_title;
                }
            )
            ->addColumn(
                'job_type',
                function ($row) {
                    return $row->job->jobType->name;
                }
            )
            ->addColumn(
                'job_category',
                function ($row) {
                    return $row->job->jobCategory->name;
                }
            )
            ->addColumn(
                'created_at',
                function ($row) {
                    return date('Y-m-d', strtotime($row->created_at));
                }
            )
            ->addColumn(
                'status',
                function ($row) {
                    return '<span class="badge badge-'.getJobAppliedBadgeColor($row->status).'">'.getJobAppliedStatusName($row->status).'</span>';
                }
            )
            ->addColumn(
                'job_location',
                function ($row) {
                    $country = isset($row->countryName) && $row->countryName != '' ? $row->countryName : '-';
                    $state = isset($row->stateName) && $row->stateName != '' ? $row->stateName : '-';
                    $city = isset($row->cityName) && $row->cityName != '' ? $row->cityName : '-';
                    if($row->work_type_id == '1') {
                        return 'Remote';
                    } else {
                        return $city.', '.$state.', '.$country;
                    }
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $button = '<a class="btn btn-primary btn-sm" href="'.route('jobDetails', base64_encode($row->jobId)).'" title="View Details">
                        <i class="bi bi-eye"></i></a>';
                    return $button;
                }
            )
            ->rawColumns(['job_category', 'job_type', 'job_title', 'status', 'candidate_contact', 'created_at', 'action'])
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
}
