<?php

namespace App\Repositories;

use App\Models\ApplyJob;
use App\Models\Constants\ApplyJobStatusConstants;
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
    public function getAppliedJobs($candidateId)
    {
         $queryBuilder = ApplyJob::select([
            'jobs.id',
            'jobs.job_title',
            'jobs.salary_range',
            'jobs.skills',
            'countries.name as country',
            'jobs.country_id',
            'states.name as state',
            'jobs.state_id',
            'cities.name as city',
            'jobs.city_id',
            'employer_details.company_name',
            'apply_jobs.status',
            DB::raw('DATE(jobs.created_at) as date')
         ])
         ->leftJoin('jobs', 'jobs.id', '=', 'apply_jobs.job_id')
         ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'apply_jobs.employer_id')
        ->leftJoin('countries', 'countries.id', '=', 'jobs.country_id')
        ->leftJoin('states', 'states.id', '=', 'jobs.state_id')
        ->leftJoin('cities', 'cities.id', '=', 'jobs.city_id')
        ->where('apply_jobs.candidate_id', $candidateId)
        ->where('jobs.status', StatusConstants::ACTIVE)
        ->orderByDesc('apply_jobs.id')->get();
        foreach ($queryBuilder as $key => $jobData) {
            $queryBuilder[$key]['jobDetailsRoute'] = !empty($jobData->id) ? route('jobDetails', base64_encode($jobData->id)) : '';
            $queryBuilder[$key]['jobTitle'] = !empty($jobData->id) ? route('jobDetails', base64_encode($jobData->id)) : '';
            $queryBuilder[$key]['company'] = !empty($jobData->company_name) ? $jobData->company_name : '';
            $queryBuilder[$key]['job_title'] = !empty($jobData->job_title) ? $jobData->job_title : '--';
            $queryBuilder[$key]['company_address'] = isset($jobData->city_id) ? $jobData->city.', '.$jobData->state.', '.$jobData->country : '';
            $queryBuilder[$key]['jobType'] = isset($jobData->job_type_id) ? $jobData->jobType->name : '';
            $queryBuilder[$key]['workType'] = isset($jobData->work_type_id) ? $jobData->workType->name : '';
            $queryBuilder[$key]['salary_range'] = isset($jobData->salary_range) ? '₹ '.$jobData->salary_range.' / P.A.' : '';
            // $queryBuilder[$key]['skills'] = isset($jobData->skills) ? getJobSkills($jobData->skills) : '';
            $queryBuilder[$key]['date'] = isset($jobData->date) ? date('d M Y', strtotime($jobData->date)) : '';
            $queryBuilder[$key]['status_label'] = isset($jobData->status) ? getJobAppliedStatusName($jobData->status) : '';
            $queryBuilder[$key]['status_badge_class'] = isset($jobData->status) ? getJobAppliedBadgeColor($jobData->status) : '';
        }
        return $queryBuilder;
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
            'apply_jobs.created_at as applyDate',
            'jobs.id as jobId',
            'jobs.id as job_title',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'employer_details.company_name',
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
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'apply_jobs.employer_id')
        ->leftJoin('users', 'users.id', '=', 'apply_jobs.candidate_id')
        ->leftJoin('work_types', 'work_types.id', '=', 'jobs.work_type_id');
        if (isset($filterData['user_id']) && $filterData['user_id'] != '') {
            $queryBuilder = $queryBuilder->where('apply_jobs.candidate_id', $filterData['user_id']);
        }
        return $queryBuilder->orderBy('apply_jobs.id', 'desc')->get();
    }

    /**
     ************************************
     * Function use to get applied jobs
     * ----------------------------------
     * @param string $total
     * @return data
     ************************************
    */
    public function getCandidateResumes($employerId)
    {
        $employerId = auth()->id(); // or wherever it's from

        $queryBuilder = ApplyJob::select([
            'apply_jobs.id',
            'apply_jobs.job_id',
            'apply_jobs.candidate_id',
            'apply_jobs.employer_id',
            'apply_jobs.status',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'candidate_details.resume_file',
            'candidate_details.skills',
            'employer_details.company_name',
            'user_addresses.country_id',
            'user_addresses.state_id',
            'user_addresses.city_id',
            'countries.name as countryName',
            'states.name as stateName',
            'cities.name as cityName',
        ])
        ->leftJoin('users', 'users.id', '=', 'apply_jobs.candidate_id')
        ->leftJoin('candidate_details', 'candidate_details.candidate_id', '=', 'apply_jobs.candidate_id')
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'apply_jobs.employer_id')
        ->leftJoin('user_addresses', 'user_addresses.user_id', '=', 'apply_jobs.candidate_id')
        ->leftJoin('countries', 'countries.id', '=', 'user_addresses.country_id')
        ->leftJoin('states', 'states.id', '=', 'user_addresses.state_id')
        ->leftJoin('cities', 'cities.id', '=', 'user_addresses.city_id')
        ->where('apply_jobs.employer_id', $employerId)
        ->orderByDesc('apply_jobs.id')
        ->get();

        foreach ($queryBuilder as $key => $applyJobData) {
            $queryBuilder[$key]['candidate_name'] =
                $applyJobData->first_name . ' ' .
                $applyJobData->middle_name . ' ' .
                $applyJobData->last_name;

            $queryBuilder[$key]['job_title'] =
                isset($applyJobData->job->job_title) ? $applyJobData->job->job_title : '';

            $queryBuilder[$key]['company_name'] =
                isset($applyJobData->employer_id) ? $applyJobData->company_name : '';

            $queryBuilder[$key]['skills'] =
                isset($applyJobData->skills)
                    ? getJobSkills($applyJobData->skills)
                    : [];

            $queryBuilder[$key]['location'] =
                isset($applyJobData->country_id) ? $applyJobData->cityName .', '. $applyJobData->stateName .', '. $applyJobData->cityName: ' ';

            $resumeFile = $applyJobData->resume_file != null ? route('downloadCandidateResume', $applyJobData->resume_file) : 'javascript:void(0)' ;
            $queryBuilder[$key]['resume_url'] = $resumeFile;

        }
        return $queryBuilder;
    }

    /**
     ************************************
     * Function use to get report data
     * ----------------------------------
     * @param object $request
     * @return data
     ************************************
    */
    public function getReportData($request) {
        $filterData = $request->all();
        $queryBuilder = ApplyJob::select([
            'apply_jobs.id',
            'apply_jobs.job_id',
            'apply_jobs.candidate_id',
            'apply_jobs.employer_id',
            'apply_jobs.status',
            'apply_jobs.created_at as applyDate',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'employer_details.company_name',
            'jobs.job_category_id',
            'jobs.job_title',
            'job_categories.name as categoryName',
            'job_types.name as jobTypeName',
            'candidate_details.resume_file',
            'countries.name as countryName',
            'states.name as stateName',
            'cities.name as cityName'
        ])
            ->leftJoin('users', 'users.id', '=', 'apply_jobs.candidate_id')
            ->leftJoin('jobs', 'jobs.id', '=', 'apply_jobs.job_id')
            ->leftJoin('job_categories', 'job_categories.id', '=', 'jobs.job_category_id')
            ->leftJoin('job_types', 'job_types.id', '=', 'jobs.job_type_id')
            ->leftJoin('countries', 'countries.id', '=', 'jobs.country_id')
            ->leftJoin('states', 'states.id', '=', 'jobs.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'jobs.city_id')
            ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'apply_jobs.employer_id')
            ->leftJoin('candidate_details', 'candidate_details.candidate_id', '=', 'apply_jobs.candidate_id');

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
}
