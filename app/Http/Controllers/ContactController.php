<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactService;

    public function __construct(
        ContactService $contactService
    ) {
        $this->contactService = $contactService;
    }

    /**
     * **************************************
     * Method is used to view contact list
     * --------------------------------------
     * @param object $request
     * @return view
     * **************************************
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->contactService->contactAjaxDatatable($request);
        }
        return view('backend.contact.index');
    }
}
