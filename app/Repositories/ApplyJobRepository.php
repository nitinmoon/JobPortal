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
        // return new ApplyJob();
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
            // $queryBuilder[$key]['company_logo_image'] = !empty($jobData->company_logo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.COMPANY_LOGO_PATH').'/'.$jobData->company_logo))  : asset(config('constants.DEFAULT_COMPANY_LOGO'));
            $queryBuilder[$key]['job_title'] = !empty($jobData->job_title) ? $jobData->job_title : '--';
            $queryBuilder[$key]['company_address'] = isset($jobData->city_id) ? $jobData->city.', '.$jobData->state.', '.$jobData->country : '';
            $queryBuilder[$key]['jobType'] = isset($jobData->job_type_id) ? $jobData->jobType->name : '';
            $queryBuilder[$key]['workType'] = isset($jobData->work_type_id) ? $jobData->workType->name : '';
            $queryBuilder[$key]['salary_range'] = isset($jobData->salary_range) ? '₹ '.$jobData->salary_range.' / P.A.' : '';
            $queryBuilder[$key]['skills'] = isset($jobData->skills) ? getJobSkills($jobData->skills) : '';
            $queryBuilder[$key]['date'] = isset($jobData->date) ? date('d M Y', strtotime($jobData->date)) : '';
        }
        // dd($queryBuilder);
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
        // return $this->getModel()->where('status', StatusConstants::ACTIVE)->orderByDesc('id')->get();
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
        // $queryBuilder = $this->getModel();
        // if (auth()->user()->role_id == UserRoleConstants::USER_ROLE_EMPLOYER) {
        //     $queryBuilder = $queryBuilder->where('employer_id', auth()->user()->id);
        // }
        // if ($today == 'today') {
        //     $queryBuilder = $queryBuilder->whereDate('created_at', date('Y-m-d'));
        // }
        // return $queryBuilder->count();
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
        // $queryBuilder = $this->getModel();
        // if (auth()->user()->role_id == UserRoleConstants::USER_ROLE_EMPLOYER) {
        //     $queryBuilder = $queryBuilder->where('employer_id', auth()->user()->id);
        // }
        // $queryBuilder = $queryBuilder->where('status', $status);
        // return $queryBuilder->count();
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
        // $queryBuilder = $this->getModel();
        // if (auth()->user()->role_id == UserRoleConstants::USER_ROLE_EMPLOYER) {
        //     $queryBuilder = $queryBuilder->where('employer_id', auth()->user()->id);
        // }
        // $queryBuilder = $queryBuilder->whereDate('created_at', date('Y-m-d'));
        // return $queryBuilder->paginate(5);
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
        // $filterData = $request->all();
        // $queryBuilder = ApplyJob::select([
        //     'apply_jobs.id',
        //     'apply_jobs.job_id',
        //     'apply_jobs.candidate_id',
        //     'apply_jobs.employer_id',
        //     'apply_jobs.status',
        //     'apply_jobs.created_at',
        //     'jobs.id as jobId',
        //     'candidate_details.resume_file',
        //     'countries.name as countryName',
        //     'states.name as stateName',
        //     'cities.name as cityName',
        //     'work_types.name as workTypeName',
        //     'jobs.work_type_id'
        // ])
        // ->leftJoin('jobs', 'jobs.id', '=', 'apply_jobs.job_id')
        // ->leftJoin('countries', 'countries.id', '=', 'jobs.country_id')
        // ->leftJoin('states', 'states.id', '=', 'jobs.state_id')
        // ->leftJoin('cities', 'cities.id', '=', 'jobs.city_id')
        // ->leftJoin('candidate_details', 'candidate_details.candidate_id', '=', 'apply_jobs.candidate_id')
        // ->leftJoin('work_types', 'work_types.id', '=', 'jobs.work_type_id')
        // ->where('apply_jobs.candidate_id', $filterData['user_id']);
        // return $queryBuilder->orderBy('apply_jobs.id', 'desc')->get();
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
        // $filterData = $request->all();
        // $todayDate = date('Y-m-d');
        // $weekDate = date('Y-m-d', strtotime('- 6 day'));
        // $monthDate = date('Y-m-d', strtotime('- 30 day'));
        // $queryBuilder = $this->getModel();
        // if ($filterData['duration'] == 'today') {
        //     $queryBuilder = $queryBuilder->whereDate('created_at', $todayDate);
        // }
        // if ($filterData['duration'] == 'week') {
        //     $queryBuilder = $queryBuilder->whereBetween(DB::raw('DATE(created_at)'), array($weekDate, $todayDate));
        // }
        // if ($filterData['duration'] == 'month') {
        //     $queryBuilder = $queryBuilder->whereBetween(DB::raw('DATE(created_at)'), array($monthDate, $todayDate));
        // }
        // return $queryBuilder->count();
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
                isset($applyJobData->job_id) ? $applyJobData->job->job_title : '';

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
}
