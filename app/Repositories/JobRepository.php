<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Constants\JobStatusConstants;
use App\Models\Constants\StatusConstants;
use App\Models\Country;
use App\Models\Job;
use App\Models\Skill;
use App\Models\State;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File;

class JobRepository extends BaseRepository
{
    public function getModel()
    {
        return new Job();
    }

    /**
     * ******************************
     * Get jobs listing data
     * ------------------------------
     * @return data
     * ******************************
     */
    public function getJobs($request)
    {
        $filterData = $request->all();
        $queryBuilder = $this->getModel();
        if ($filterData['job_category_id'] != '') {
            $queryBuilder = $queryBuilder->where('job_category_id', $filterData['job_category_id']);
        }
        if ($filterData['job_type_id'] != '') {
            $queryBuilder = $queryBuilder->where('job_type_id', $filterData['job_type_id']);
        }
        if (!empty($filterData['deleted'])) {
            if ($filterData['deleted'] == '1') {
                $queryBuilder = $queryBuilder->where('deleted_at', null);
            } else {
                $queryBuilder = $queryBuilder->where('deleted_at', '<>', null);
            }
        }
        if (isset($filterData['status'])) {
            if ($filterData['status'] == '0') {
                $queryBuilder = $queryBuilder->where('status', '0');
            } else {
                $queryBuilder = $queryBuilder->where('status', '1');
            }
        }
        return $queryBuilder->orderBy('id', 'desc')->withTrashed()->get();
    }

    /**
     *************************************
     * Function use to add update job type
     * ------------------------------------
     * @param array $inputArray
     * @return int $jobTypeId
     *************************************
     */
    public function addUpdateJob($inputArray)
    {
        if (!empty($inputArray['skills'])) {
            $skillArray = [];
            foreach ($inputArray['skills'] as $skillName) {
                $checkSkill = Skill::where('name', $skillName)->first();
                if ($checkSkill == null) {
                    $skill = new Skill();
                    $skill->name = $skillName;
                    $skill->created_by = auth()->user()->id;
                    $skill->save();
                    array_push($skillArray, $skill->id);
                }
            }
        }
        if (!empty($inputArray['upload_file'])) {
            $filePath = config('constants.JOB_FILE');
            $oldFileName = Job::where('id', $inputArray['jobId'])->pluck('upload_file');
            File::delete($filePath . '/' . $oldFileName[0]);
            $fileName  = config('constants.JOB_PREFIX') . $inputArray['jobId'] . '_Job.' . $inputArray['upload_file']->extension();
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $inputArray['upload_file']->move($filePath, $fileName);
        }
        $condition = ['id' => $inputArray['jobId']];
        $data = [
            'job_title' => strip_tags($inputArray['job_title']),
            'employer_id' => auth()->user()->id,
            'designation_id' => $inputArray['designation_id'],
            'job_category_id' => $inputArray['job_category_id'],
            'job_type_id' => $inputArray['job_type_id'],
            'work_type_id' => $inputArray['work_type_id'],
            'job_tags' => isset($inputArray['job_tags']) ? implode(',', $inputArray['job_tags']) : '',
            'country_id' => isset($inputArray['country_id']) ? $inputArray['country_id'] : null,
            'state_id' => isset($inputArray['state_id']) ? $inputArray['state_id'] : null,
            'city_id' => isset($inputArray['city_id']) ? $inputArray['city_id'] : null,
            'experience' => $inputArray['experience'],
            'min_salary' => $inputArray['min_salary'],
            'max_salary' => $inputArray['max_salary'],
            'vacancy' => $inputArray['vacancy'],
            'deadline' => $inputArray['deadline'],
            'gender' => $inputArray['gender'],
            'english_level' => $inputArray['english_level'],
            'skills' => isset($skillArray) ? implode(',', $skillArray) : '',
            'job_description' => $inputArray['job_description'],
            'job_responsibility' => $inputArray['job_responsibility'],
            'educational_requirements' => $inputArray['educational_requirements'],
            'other_benefits' => $inputArray['other_benefits'],
            'upload_file' => isset($fileName) ? $fileName : null,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ];
        Job::updateOrCreate($condition, $data);
        return $inputArray['jobId'];
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
        return $this->getModel()
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'jobs.employer_id')
        ->where('jobs.job_status', JobStatusConstants::APPROVED)->where('jobs.status', StatusConstants::ACTIVE)->orderByDesc('jobs.id')->get();
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
        $filterData = $request->all();
        // dd($filterData);
        $queryBuilder = Job::select([
            'jobs.id',
            'jobs.job_title',
            'jobs.job_type_id',
            'jobs.job_category_id',
            'jobs.salary_range',
            'jobs.city_id',
            'jobs.state_id',
            'jobs.country_id',
            'employer_details.company_logo',
            'cities.name'
        ])->where('jobs.status', StatusConstants::ACTIVE)
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'jobs.employer_id')
        ->leftJoin('cities', 'cities.id', '=', 'jobs.city_id');
        if (!empty($filterData['jobCategoryId']) && base64_decode($filterData['jobCategoryId']) != 'All') {
            $queryBuilder =  $queryBuilder->where('jobs.job_category_id', base64_decode($filterData['jobCategoryId']));
        }
        if (!empty($filterData['location']) && !empty(base64_decode($filterData['jobCategoryId'])) == 'All') {
            $queryBuilder =  $queryBuilder->where('cities.name', $filterData['location']);
        }
        return $queryBuilder = $queryBuilder->get();
    }

    /**
     * ********************************************
     * method used to get job category filter page
     * --------------------------------------------
     * @param object $request
     * @return data
     * ********************************************
     */
    public function findJobFilter($request)
    {
        $filterData = $request->all();
        $queryBuilder = Job::select([
            'jobs.id',
            'jobs.job_title',
            'jobs.job_type_id',
            'jobs.job_category_id',
            'jobs.salary_range',
            'jobs.city_id',
            'jobs.state_id',
            'jobs.country_id',
            'employer_details.company_logo',
        ])->where('jobs.status', StatusConstants::ACTIVE)
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'jobs.employer_id');
        if (!empty($filterData['job_title'])) {
            $queryBuilder =  $queryBuilder->where('jobs.job_title', 'like', '%' . $filterData['job_title'] . '%');
        }
        if (!empty($filterData['job_category_id'])) {
            $queryBuilder =  $queryBuilder->where('jobs.job_category_id', $filterData['job_category_id']);
        }
        if (!empty($filterData['job_location_id'])) {
            $queryBuilder =  $queryBuilder->where('jobs.country_id', $filterData['job_location_id']);
        }
        if (!empty($filterData['job_location_id'])) {
            $queryBuilder =  $queryBuilder->orWhere('jobs.state_id', $filterData['job_location_id']);
        }
        if (!empty($filterData['job_location_id'])) {
            $queryBuilder =  $queryBuilder->orWhere('jobs.city_id', $filterData['job_location_id']);
        }
        return $queryBuilder = $queryBuilder->get();
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
        $queryBuilder = Job::where('jobs.status', StatusConstants::ACTIVE)
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'jobs.employer_id');
        if ($jobTitle != 'All') {
            $queryBuilder =  $queryBuilder->where('jobs.job_title', 'like', '%' . $jobTitle . '%');
        }
        return $queryBuilder = $queryBuilder->get();
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
        $filterData = $request->all();
        $queryBuilder = Job::where('jobs.status', StatusConstants::ACTIVE)
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'jobs.employer_id');
        if (!empty($filterData['job_type_id'])) {
            $queryBuilder =  $queryBuilder->where('jobs.job_type_id', $filterData['job_type_id']);
        }
        if (!empty($filterData['job_location_id'])) {
            $queryBuilder =  $queryBuilder->where('jobs.city_id', $filterData['job_location_id']);
        }
        if (!empty($filterData['salary_range'])) {
            $queryBuilder =  $queryBuilder->where('jobs.salary_range', $filterData['salary_range']);
        }
        if (!empty($filterData['salary_range_slider'])) {
            $queryBuilder =  $queryBuilder->where('jobs.salary_range', $filterData['salary_range_slider']);
        }
        return $queryBuilder = $queryBuilder->get();
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
        $countryArray = Country::select('id', 'name');
        if (!empty($searchString) && $searchString != '') {
            $countryArray = $countryArray->where('name', 'LIKE', "%{$searchString}%");
        }
        $countryArray = $countryArray->limit(5);
        $stateArray = State::select('id', 'name');
        if (!empty($searchString) && $searchString != '') {
            $stateArray = $stateArray->where('name', 'LIKE', "%{$searchString}%");
        }
        $stateArray = $stateArray->limit(5);
        $cityArray = City::select('id', 'name');
        if (!empty($searchString) && $searchString != '') {
            $cityArray = $cityArray->where('name', 'LIKE', "%{$searchString}%");
        }
        $cityArray = $cityArray->limit(5)->union($countryArray)
        ->union($stateArray)->get();
        return $cityArray;
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
        $filterData = $request->all();
        $queryBuilder = Job::select([
            'jobs.id',
            'jobs.job_title',
            'jobs.job_type_id',
            'jobs.job_category_id',
            'jobs.salary_range',
            'jobs.city_id',
            'jobs.state_id',
            'jobs.country_id',
            'employer_details.company_logo',
            'cities.name',
        ])
        ->leftJoin('employer_details', 'employer_details.employer_id', '=', 'jobs.employer_id')
        ->leftJoin('cities', 'cities.id', '=', 'jobs.city_id');
        if (!empty($filterData['job_type_id'])) {
            if ($filterData['job_type_id'] == 'recent') {
                $queryBuilder =  $queryBuilder->latest('jobs.created_at')->take(5);
            } else {
                $queryBuilder =  $queryBuilder->where('jobs.job_type_id', $filterData['job_type_id'])->latest('jobs.created_at')->take(10);
            }
        }
        if (!empty($filterData['location'])) {
            $queryBuilder =  $queryBuilder->where('cities.name', $filterData['location']);
        }
        return $queryBuilder = $queryBuilder->where('jobs.status', StatusConstants::ACTIVE)->get();
    }
}
