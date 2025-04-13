<?php

namespace App\Repositories;

use App\Models\ApplyJob;
use App\Models\Constants\StatusConstants;
use App\Models\Constants\UserRoleConstants;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ApplyJobRepository extends BaseRepository
{
    public function getModel()
    {
        return new ApplyJob();
    }

    /**
     * **************************************
     * Get apply jobs candidates listing data
     * --------------------------------------
     * @return data
     * **************************************
     */
    public function getApplyJobs($request)
    {
        $filterData = $request->all();
        $queryBuilder = ApplyJob::select([
            'apply_jobs.id',
            'apply_jobs.job_id',
            'apply_jobs.candidate_id',
            'apply_jobs.employer_id',
            'apply_jobs.status',
            'apply_jobs.created_at',
            'candidate_details.resume_file',
            'countries.name as countryName',
            'states.name as stateName',
            'cities.name as cityName'
        ])
            ->leftJoin('jobs', 'jobs.id', '=', 'apply_jobs.job_id')
            ->leftJoin('countries', 'countries.id', '=', 'jobs.country_id')
            ->leftJoin('states', 'states.id', '=', 'jobs.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'jobs.city_id')
            ->leftJoin('candidate_details', 'candidate_details.candidate_id', '=', 'apply_jobs.candidate_id')
            ->where('apply_jobs.employer_id', auth()->user()->id);

        if ($filterData['status'] != '') {
            $queryBuilder = $queryBuilder->where('apply_jobs.status', $filterData['status']);
        }
        if ($filterData['applied_on'] != '') {
            $queryBuilder = $queryBuilder->whereDate('apply_jobs.created_at', $filterData['applied_on']);
        }
        if ($filterData['candidate_id'] != 0) {
            $queryBuilder = $queryBuilder->where('apply_jobs.candidate_id', $filterData['candidate_id']);
        }
        if ($filterData['job_category_id'] != '') {
            $queryBuilder = $queryBuilder->where('jobs.job_category_id', $filterData['job_category_id']);
        }
        if ($filterData['job_type_id'] != '') {
            $queryBuilder = $queryBuilder->where('jobs.job_type_id', $filterData['job_type_id']);
        }
        if ($filterData['job_title'] != '') {
            $queryBuilder = $queryBuilder->where('jobs.job_title', 'LIKE', "%{$filterData['job_title']}%");
        }
        if ($filterData['country_id'] != '') {
            $queryBuilder = $queryBuilder->where('jobs.country_id', $filterData['country_id']);
        }
        if ($filterData['state_id'] != '') {
            $queryBuilder = $queryBuilder->where('jobs.state_id', $filterData['state_id']);
        }
        if ($filterData['city_id'] != '') {
            $queryBuilder = $queryBuilder->where('jobs.city_id', $filterData['city_id']);
        }
        return $queryBuilder->orderBy('apply_jobs.id', 'desc')->get();
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
        return $this->getModel()->where('status', StatusConstants::ACTIVE)->orderByDesc('id')->get();
    }


    /**
     *******************************************
     * Method use to get all applied jobs count
     * -----------------------------------------
     * @return data
     * @param string $today
     *******************************************
     */
    public function getTotalApplyJobCount($today)
    {
        $queryBuilder = $this->getModel();
        if (auth()->user()->role_id == UserRoleConstants::USER_ROLE_EMPLOYER) {
            $queryBuilder = $queryBuilder->where('employer_id', auth()->user()->id);
        }
        if ($today == 'today') {
            $queryBuilder = $queryBuilder->whereDate('created_at', date('Y-m-d'));
        }
        return $queryBuilder->count();
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
        $queryBuilder = $this->getModel();
        if (auth()->user()->role_id == UserRoleConstants::USER_ROLE_EMPLOYER) {
            $queryBuilder = $queryBuilder->where('employer_id', auth()->user()->id);
        }
        $queryBuilder = $queryBuilder->where('status', $status);
        return $queryBuilder->count();
    }

    /**
     *******************************************
     * Method use to get all applied jobs count
     * -----------------------------------------
     * @return data
     *******************************************
     */
    public function getTodaysApplyJobCandidate()
    {
        $queryBuilder = $this->getModel();
        if (auth()->user()->role_id == UserRoleConstants::USER_ROLE_EMPLOYER) {
            $queryBuilder = $queryBuilder->where('employer_id', auth()->user()->id);
        }
        $queryBuilder = $queryBuilder->whereDate('created_at', date('Y-m-d'));
        return $queryBuilder->paginate(5);
    }

    /**
     * **************************************
     * Get apply jobs candidates listing data
     * --------------------------------------
     * @return data
     * **************************************
     */
    public function getCandidateApplyJobsList($request)
    {
        $filterData = $request->all();
        $queryBuilder = ApplyJob::select([
            'apply_jobs.id',
            'apply_jobs.job_id',
            'apply_jobs.candidate_id',
            'apply_jobs.employer_id',
            'apply_jobs.status',
            'apply_jobs.created_at',
            'jobs.id as jobId',
            'candidate_details.resume_file',
            'countries.name as countryName',
            'states.name as stateName',
            'cities.name as cityName',
            'work_types.name as workTypeName',
            'jobs.work_type_id'
        ])
        ->leftJoin('jobs', 'jobs.id', '=', 'apply_jobs.job_id')
        ->leftJoin('countries', 'countries.id', '=', 'jobs.country_id')
        ->leftJoin('states', 'states.id', '=', 'jobs.state_id')
        ->leftJoin('cities', 'cities.id', '=', 'jobs.city_id')
        ->leftJoin('candidate_details', 'candidate_details.candidate_id', '=', 'apply_jobs.candidate_id')
        ->leftJoin('work_types', 'work_types.id', '=', 'jobs.work_type_id')
        ->where('apply_jobs.candidate_id', $filterData['user_id']);
        return $queryBuilder->orderBy('apply_jobs.id', 'desc')->get();
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
        $filterData = $request->all();
        $todayDate = date('Y-m-d');
        $weekDate = date('Y-m-d', strtotime('- 6 day'));
        $monthDate = date('Y-m-d', strtotime('- 30 day'));
        $queryBuilder = $this->getModel();
        if ($filterData['duration'] == 'today') {
            $queryBuilder = $queryBuilder->whereDate('created_at', $todayDate);
        }
        if ($filterData['duration'] == 'week') {
            $queryBuilder = $queryBuilder->whereBetween(DB::raw('DATE(created_at)'), array($weekDate, $todayDate));
        }
        if ($filterData['duration'] == 'month') {
            $queryBuilder = $queryBuilder->whereBetween(DB::raw('DATE(created_at)'), array($monthDate, $todayDate));
        }
        return $queryBuilder->count();
    }
}
