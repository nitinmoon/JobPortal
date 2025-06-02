<?php

namespace App\Services;

use App\Models\Constants\JobStatusConstants;
use App\Repositories\ContactRepository;
use Yajra\DataTables\Facades\DataTables;

class ContactService
{
    private $contactRepository;

    public function __construct(
        ContactRepository $contactRepository,
    ) {
        $this->contactRepository = $contactRepository;
    }

    /**
     *****************************************
     * Function use to get contact Listing
     * ----------------------------------------
     * @return data
     *****************************************
     */
    public function contactAjaxDatatable($request)
    {
        $data = $this->contactRepository->getContacts($request);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'name',
                function ($row) {
                    return isset($row->name) && $row->name != null ? $row->name : '--';
                }
            )
            ->addColumn(
                'email',
                function ($row) {
                    return isset($row->email) && $row->email != null ? $row->email : '--';
                }
            )
            ->addColumn(
                'message',
                function ($row) {
                    return isset($row->message) && $row->message != null ? $row->message : '--';
                }
            )
            ->rawColumns(['message', 'name', 'email'])
            ->removeColumn('created_at', 'updated_at', 'id')
            ->make(true);
    }
}
