<?php

namespace App\Services;

use App\Mail\OtpVerificationEmail;
use App\Repositories\EmployerRepository;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class EmployerService
{
    private $employerRepository;

    public function __construct(
        EmployerRepository $employerRepository
    ) {
        $this->employerRepository = $employerRepository;
    }

    /**
     * **********************************************
     * method used to send employer otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function sendEmployerOtp($inputArray)
    {
        $otp = $this->employerRepository->sendEmployerOtp($inputArray);
        if ($otp == 'Invalid_User') {
            return 'Invalid_User';
        }
        return $this->employerOtpEmail($otp, $inputArray['email']);
    }

    /**
     * **********************************************
     * method used to send employer otp email
     * ----------------------------------------------
     * @param string $otp
     * @return data
     * *************************************************
     */
    public function employerOtpEmail($otp, $email)
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
     * method used to verify employer otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function verifyEmployerOtp($inputArray)
    {
        return $this->employerRepository->verifyEmployerOtp($inputArray);
    }

     /**
     ****************************************
     * Function use to get employer listing
     * --------------------------------------
     * @return data
     ****************************************
     */
    public function employerAjaxDatatable($request)
    {
        $data = $this->employerRepository->getEmployer($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'action',
                function ($row) {
                    $button = '';
                    if ($row->deleted_at == null) {
                        $button .= '<a class=" btn btn-sm btn-warning btn-warning  text-white" title="View"
                        href="' . route('viewEmployer', base64_encode($row->id)) . '" title="View Employer">
                        <i class="bi bi-eye"></i></a>&nbsp;&nbsp;';

                        $button .= '<a class="edit-employer btn btn-sm btn-primary btn-blue"
                            href="'. route('editEmployer', base64_encode($row->id)) .'" title="Edit Employer">
                            <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;';
                    }
                    if ($row->deleted_at == null) {
                        $button .= '<a class="deleteEmployer btn btn-sm btn-danger" data-url="'. route('deleteEmployer', $row->id) .'" title="Delete Employer" href="#" data-bs-toggle="modal" data-bs-target="#deleteCandidateModal">
                        <i class="bi bi-trash"></i></a>&nbsp;&nbsp;';
                    } else {
                        $button .= '<a class="restoreEmployer btn btn-sm btn-success" data-url="'. route('restoreEmployer', $row->id) .'" href="#" title="Restore Employer" data-bs-toggle="modal" data-bs-target="#restoreCandidateModal">
                        <i class="bi bi-upload"></i></a>';
                    }
                    return $button;
                }
            )
            ->addColumn(
                'name',
                function ($row) {
                    $userName = isset($row->first_name) && $row->first_name != null ? getTitle($row->title) . ' ' . strip_tags(ucfirst($row->first_name)).' '.strip_tags(ucfirst($row->last_name)) : explode('@', $row->email)[0];
                    // $userName = isset($row->first_name) ? getTitle($row->title) . ' ' . strip_tags(ucfirst($row->first_name)) . ' ' .strip_tags(ucfirst($row->last_name)) : '--';
                    return $userName;
                }
            )
            ->addColumn(
                'company_name',
                function ($row) {
                    return isset($row->company_name) ? $row->company_name : '--';
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
                    if ($row->deleted_at == null) {
                        $activeChecked = "";
                                if ($row->status == 1) {
                                    $activeChecked = 'checked';
                                }
                        return '<input type="hidden" name="_token" value="'.csrf_token().'">
                        <label class="switch">
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" class="change-employer-status" name="status" data-url="'. route('changeEmployerStatus') .'" id="' . $row->id . '" '.$activeChecked.'>
                        <span class="slider round"></span>
                        <input type="hidden" name="action" value="submit" />
                        </label>';
                    } else {
                        return getActiveInactiveStatusBadge($row->status);
                    }
                }
            )
            ->rawColumns(['action', 'name', 'company_name', 'contact_person', 'contacts', 'status'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }

    /**
     *********************************
     * Method use to delete employer
     * -------------------------------
     * @param int employerId
     * @return data
     *********************************
     */
    public function deleteEmployer($employerId)
    {
        return $this->employerRepository->getById($employerId)->delete();
    }

    /**
     ********************************
     * Method to restore employer
     * ------------------------------
     * @param int employerId
     * @return data
     ********************************
     */
    public function restoreEmployer($employerId)
    {
        return $this->employerRepository->getModel()->where('id', $employerId)->withTrashed()->restore();
    }

     /**
     * *****************************************
     * Function used to change employer status
     * -----------------------------------------
     * @param object $request
     * @return data
     * *****************************************
     */
    public function changeEmployerStatus($request)
    {
        $inputArray = $request->all();
        $getData = $this->employerRepository->getById($inputArray['employerId']);
        $inputArray['updated_by'] = auth()->user()->id;
        return $this->employerRepository->update($getData, $inputArray);
    }

    /**
     * **********************************************
     * method used to resend employer otp
     * ----------------------------------------------
     * @param array $inputArray
     * @return data
     * *************************************************
     */
    public function resendEmployerOtp($inputArray)
    {
        $otp = $this->employerRepository->resendEmployerOtp($inputArray);
        return $this->employerOtpEmail($otp, $inputArray['email']);
    }

    /**
     * ************************************
     * method used to get employer details
     * ------------------------------------
     * @param int $employerId
     * @return data
     * ************************************
     */
    public function getEmployerDetails($employerId)
    {
        return $this->employerRepository->getEmployerDetails($employerId);
    }

    /**
     **************************************
     * Function use to add update employer
     * ------------------------------------
     * @param array $inputArray
     * @return data
     **************************************
     */
    public function addUpdateEmployer($inputArray)
    {
        $this->employerRepository->addUpdateEmployer($inputArray);
    }

    /**
     *******************************************
     * Function use to update employer profile
     * -----------------------------------------
     * @param array $inputArray
     * @return data
     *******************************************
     */
    public function updateEmployerProfile($inputArray)
    {
        $this->employerRepository->updateEmployerProfile($inputArray);
    }

    /**
     * *******************************
     * method used to search employer
     * -------------------------------
     * @param       searchString
     * @return      data
     * @description (search using first name, last name)
     * ***************************************************
     */
    public function autoCompleteSearchEmployer($searchString = null)
    {
        return $this->employerRepository->autoCompleteSearchEmployer($searchString);
    }

    /**
     *****************************************
     * Function use to get user details by id
     * ---------------------------------------
     * @param int $employerId
     * @return data
     **************************************
     */
    public function getUserDetails($employerId)
    {
        return $this->employerRepository->getById($employerId);
    }
}
