<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Constants\UserRoleConstants;
use App\Services\CountryService;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $reportService;
    private $countryService;

    public function __construct(
        ReportService $reportService,
        CountryService $countryService
    ) {
        $this->reportService = $reportService;
        $this->countryService = $countryService;
    }

    /**
     * **************************************
     * Method is used to view reports
     * --------------------------------------
     * @param object $request
     * @return view
     * **************************************
     */
    public function index(Request $request)
    {
        if (auth()->user()->role_id != UserRoleConstants::SUPER_ADMIN) {
            return back();
        }
        $jobCategory = getJobCategory();
        $jobType = getJobType();
        if ($request->ajax()) {
            return $this->reportService->reportAjaxDatatable($request);
        }
        $countries = $this->countryService->getAllCountry();
        return view('backend.reports.index', compact('jobCategory', 'jobType', 'countries'));
    }
}
