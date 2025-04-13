<?php

namespace App\Services;

use App\Mail\OtpVerificationEmail;
use App\Models\Constants\ApplyJobStatusConstants;
use App\Repositories\CandidateRepository;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class CandidateService
{
    private $candidateRepository;

    public function __construct(
        CandidateRepository $candidateRepository
    ) {
        $this->candidateRepository = $candidateRepository;
    }

    /**
     *****************************************
     * Function use to get job category listing
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function candidateAjaxDatatable($request)
    {
        $data = $this->candidateRepository->getCandidate($request);
        // dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'name',
                function ($row) {
                    $userName = isset($row->first_name) && $row->first_name != null ? getTitle($row->title) . ' ' . strip_tags(ucfirst($row->first_name)).' '.strip_tags(ucfirst($row->last_name)) : explode('@', $row->email)[0];
                    return $userName;
                }
            )
            ->addColumn(
                'education',
                function ($row) {
                    return isset($row->education) ? $row->education : '--';
                }
            )
            ->addColumn(
                'experience',
                function ($row) {
                    return isset($row->experience) ? explode("-",$row->experience)[0].' Years '. explode("-",$row->experience)[1].' Months' : '--';
                }
            )
            ->addColumn(
                'contacts',
                function ($row) {
                return '<a href="mailto:'.strip_tags($row->email).'"><i class="fa fa-envelope"></i> ' . strip_tags($row->email) . '</a><br>
                        <a href="tel:'.strip_tags($row->phone).'"><i class="fa fa-phone"></i> ' . strip_tags($row->phone).'</a>';
                }
            )
            ->addColumn(
                'status',
                function ($row) {
                    return getActiveInactiveStatusBadge($row->status);
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    $button .= '<a class=" btn btn-sm btn-warning btn-warning  text-white" title="View"
                    href="' . route('viewCandidate', base64_encode($row->id)) . '" title="View Candidate">
                    <i class="bi bi-eye"></i></a>&nbsp;&nbsp;';
                    if ($row->resume_file != null) {
                        $button .= '<a class="btn btn-sm btn-primary btn-blue" href="'.route('downloadResume', $row->resume_file).'" title="Download Resume" download>
                            <i class="bi bi-download"></i></a>&nbsp;&nbsp;';
                        $button .='<a class="btn btn-sm btn-info btn-blue view-resume" data-url=" '.route('viewResumeModal', $row->candidate_id).' " title="View Resume" View>
                        <i class="bi bi-file-pdf"></i></a>&nbsp;&nbsp;';
                    }
                    return $button;
                }
            )
            ->rawColumns(['action', 'name', 'education', 'experience', 'contacts', 'status'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }

    /**
     * **********************************************
     * method used to send candidate otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function sendCandidateOtp($inputArray)
    {
        $otp = $this->candidateRepository->sendCandidateOtp($inputArray);
        if ($otp == 'Invalid_User') {
            return 'Invalid_User';
        }
        return $this->candidateOtpEmail($otp, $inputArray['email']);
    }

    /**
     * **********************************************
     * method used to send candidate otp email
     * ----------------------------------------------
     * @param string $otp
     * @return data
     * *************************************************
     */
    public function candidateOtpEmail($otp, $email)
    {
        $subject = 'Verify Email - '.env('APP_NAME');
        $msg = 'Thank you for choosing '.env('APP_NAME').'. Use the following OTP to verify your email. OTP is valid for 5 minutes';
        $bladeName = 'emails.otp-verify-email';
        try {
            Mail::to($email)->send(new OtpVerificationEmail($subject, $msg, $otp, $bladeName));
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    /**
     * **********************************************
     * method used to verify candidate otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function verifyCandidateOtp($inputArray)
    {
        return $this->candidateRepository->verifyCandidateOtp($inputArray);
    }

    /**
     * **********************************************
     * method used to resend candidate otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function resendCandidateOtp($inputArray)
    {
        $otp = $this->candidateRepository->resendCandidateOtp($inputArray);
        return $this->candidateOtpEmail($otp, $inputArray['email']);
    }

    /**
     * **********************************************
     * method used to update candidate profile
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function updateCandidateProfile($inputArray)
    {
        return $this->candidateRepository->updateCandidateProfile($inputArray);
    }

    /**
     * ******************************************
     * method used to get candidate details
     * ------------------------------------------
     * @param int $candidateId
     * @return data
     * ******************************************
     */
    public function getCandidateDetails($candidateId)
    {
        return $this->candidateRepository->getCandidateDetails($candidateId);
    }

    /**
     *********************************
     * Method use to delete candidate
     * -------------------------------
     * @param int candidateId
     * @return data
     *********************************
     */
    public function deleteCandidate($candidateId)
    {
        return $this->candidateRepository->getById($candidateId)->delete();
    }

    /**
     ********************************
     * Method to restore candidate
     * ------------------------------
     * @param int candidateId
     * @return data
     ********************************
     */
    public function restoreCandidate($candidateId)
    {
        return $this->candidateRepository->getModel()->where('id', $candidateId)->withTrashed()->restore();
    }

     /**
     * *****************************************
     * Function used to change candidate status
     * -----------------------------------------
     * @param object $request
     * @return data
     * *****************************************
     */
    public function changeCandidateStatus($request)
    {
        $inputArray = $request->all();
        $getData = $this->candidateRepository->getById($inputArray['candidateId']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->candidateRepository->update($getData, $inputArray);
    }

    /**
     * *******************************
     * method used to search candidate
     * -------------------------------
     *
     * @param       searchString
     * @return      data
     * @description (search using first name, last name)
     * ***************************************************
     */
    public function autoCompleteSearchCandidate($searchString = null)
    {
        return $this->candidateRepository->autoCompleteSearchCandidate($searchString);
    }

    /**
     * *******************************************
     * method used to search apply job candidate
     * -------------------------------------------
     *
     * @param string $searchString
     * @return  data
     * @description (search using first name, last name)
     * ***************************************************
     */
    public function autocompleteSearchApplyCandidate($searchString = null)
    {
        return $this->candidateRepository->autocompleteSearchApplyCandidate($searchString);
    }

    /**
     * **************************************
     * method to update candidate profile image
     * --------------------------------------
     * @param int $candidateId
     * @param array $inputdata
     * @return data
     * **************************************
     */
    public function updateCandidateProfileImage($candidateId, $inputdata)
    {
        return $this->candidateRepository->updateCandidateProfileImage($candidateId, $inputdata);
    }

    /**
     *****************************************
     * Function use to get database listing
     * ---------------------------------------
     * @return data
     *****************************************
     */
    public function databaseAjaxDatatable($request)
    {
        $data = $this->candidateRepository->getDatabaseCandidate($request);
        foreach ($data as $key => $database) {
            if ($database->applyStatus == ApplyJobStatusConstants::HIRED) {
                unset($data[$key]);
            }
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'name',
                function ($row) {
                    $userName = isset($row->first_name) ? getTitle($row->title) . ' ' . strip_tags(ucfirst($row->first_name)) . ' ' .
                    strip_tags(ucfirst($row->last_name)) : '--';
                    return $userName;
                }
            )
            ->addColumn(
                'education',
                function ($row) {
                    return isset($row->education) ? $row->education : '--';
                }
            )
            ->addColumn(
                'experience',
                function ($row) {
                    return isset($row->experience) ? explode("-", $row->experience)[0].' Years '. explode("-", $row->experience)[1].' Months' : '--';
                }
            )
            ->addColumn(
                'contacts',
                function ($data) {
                return '<a href="mailto:'.strip_tags($data->email).'"><i class="fa fa-envelope"></i> ' . strip_tags($data->email) . '</a><br>
                        <a href="tel:'.strip_tags($data->phone).'"><i class="fa fa-phone"></i> ' . strip_tags($data->phone).'</a>';
                }
            )
            ->addColumn(
                'status',
                function ($row) {
                    return getActiveInactiveStatusBadge($row->status);
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    $button .= '<a class=" btn btn-sm btn-warning btn-warning  text-white" title="View"
                    href="' . route('viewCandidate', base64_encode($row->id)) . '" title="View Candidate">
                    <i class="bi bi-eye"></i></a>&nbsp;&nbsp;';
                    if ($row->resume_file != null) {
                        $button .= '<a class="btn btn-sm btn-primary btn-blue" href="'.route('downloadResume', $row->resume_file).'" title="Download Resume" download>
                            <i class="bi bi-download"></i></a>&nbsp;&nbsp;';
                    }
                    return $button;
                }
            )
            ->rawColumns(['action', 'name', 'education', 'experience', 'contacts', 'status'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }

    /**
     *****************************************
     * Function use to get user details by id
     * ---------------------------------------
     * @param int $candidateId
     * @return data
     **************************************
     */
    public function getUserDetails($candidateId)
    {
        return $this->candidateRepository->getById($candidateId);
    }
}
