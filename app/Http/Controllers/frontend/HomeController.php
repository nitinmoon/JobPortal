<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * **********************************
     * Method is used to view home page
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
     * ***************************************
     * Method is used to view auth type page
     * ---------------------------------------
     * @return view
     * ***************************************
     */
    public function authType($flag)
    {
        $type = base64_decode($flag);
        return view('frontend.auth.auth-type', compact('type'));
    }
}
