<?php

namespace App\Exports;

use App\Models\Constants\ApplyJobStatusConstants;
use App\Models\PlayerPurchasePlan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Constants\UserRoleConstants;
use App\Models\User;

class DatabaseExport implements FromView
{
    private $candidateId;
    private $education;
    private $status;
    private $deleted;

    public function __construct(
        $candidateId = "",
        $education = "",
        $status = "",
        $deleted = ""
    ) {
        $this->candidateId = $candidateId;
        $this->education = $education;
        $this->status = $status;
        $this->deleted = $deleted;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $queryBuilder = User::select(
            'users.id',
            'users.title',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'users.email',
            'users.phone',
            'users.status',
            'users.created_at',
            'users.deleted_at',
            'candidate_details.candidate_id',
            'candidate_details.address',
            'candidate_details.country_id',
            'candidate_details.state_id',
            'candidate_details.city_id',
            'candidate_details.zip',
            'candidate_details.resume_file',
            'candidate_details.experience',
            'candidate_details.education',
            'candidate_details.skills',
            'candidate_details.created_by',
            'candidate_details.updated_by',
            'apply_jobs.status as applyStatus'
        )
        ->join('candidate_details', 'candidate_details.candidate_id', '=', 'users.id')
        ->leftJoin('apply_jobs', 'apply_jobs.candidate_id', '=', 'users.id');
        if (isset($this->candidateId) && !empty($this->candidateId)) {
            $queryBuilder = $queryBuilder->where('users.id', $this->candidateId);
        }
        if (!empty($this->education)) {
            $queryBuilder = $queryBuilder->where('candidate_details.education', $this->education);
        }
        if (!empty($this->status)) {
            if ($this->status == '0') {
                $queryBuilder = $queryBuilder->where('users.status', '0');
            } else {
                $queryBuilder = $queryBuilder->where('users.status', '1');
            }
        }
        if (!empty($this->deleted)) {
            if ($this->deleted == '1') {
                $queryBuilder = $queryBuilder->where('users.deleted_at', null);
            } else {
                $queryBuilder = $queryBuilder->where('users.deleted_at', '<>', null);
            }
        }
        $data =  $queryBuilder->orderBy('id', 'desc')->withTrashed()->get();
        foreach ($data as $key => $database) {
            if ($database->applyStatus == ApplyJobStatusConstants::HIRED) {
                unset($data[$key]);
            }
        }
        return view(
            'exports.database-excel-export',
            [
                'database' => $data
            ]
        );
    }
}
