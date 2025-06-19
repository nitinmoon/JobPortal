<?php

namespace App\Services;

use App\Models\Constants\JobStatusConstants;
use App\Repositories\ApplyJobRepository;
use App\Repositories\JobRepository;
use Yajra\DataTables\Facades\DataTables;

class ReportService
{
    private $applyJobRepository;

    public function __construct(
        ApplyJobRepository $applyJobRepository,
    ) {
        $this->applyJobRepository = $applyJobRepository;
    }

    /**
     *****************************************
     * Function use to get job types Listing
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function reportAjaxDatatable($request)
    {
        $data = $this->applyJobRepository->getReportData($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'company_name',
                function ($row) {
                    return isset($row->company_name) ? $row->company_name : '--';
                }
            )
            ->addColumn(
                'candidate_name',
                function ($row) {
                    return isset($row->candidate_id) ? $row->first_name .' '. $row->middle_name .' '. $row->last_name : '--';
                }
            )
            ->addColumn(
                'category',
                function ($row) {
                    return isset($row->categoryName) ? $row->categoryName : '--';
                }
            )
            ->addColumn(
                'job_type',
                function ($row) {
                    return isset($row->jobTypeName) ? $row->jobTypeName : '--';
                }
            )
            ->addColumn(
                'job_title',
                function ($row) {
                   return isset($row->job_title) ? $row->job_title : '--';
                }
            )
            ->addColumn(
                'status',
                function ($row) {
                    return isset($row->status) ? getJobAppliedStatusName($row->status) : '--';
                }
            )
            ->addColumn(
                'applied_date',
                function ($row) {
                     return isset($row->applyDate) ? date('Y-m-d', strtotime($row->applyDate)) : '--';
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
            ->rawColumns(['company_name', 'candidate_name', 'category', 'job_type', 'job_title', 'status', 'applied_date', 'job_location'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }
}
