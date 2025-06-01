<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactInputRequest;
use App\Services\JobCategoryService;
use App\Services\JobService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    private $jobService;
    private $jobCategoryService;
    private $userService;

    public function __construct(
        JobService $jobService,
        JobCategoryService $jobCategoryService,
        UserService $userService
    ) {
        $this->jobService = $jobService;
        $this->jobCategoryService = $jobCategoryService;
        $this->userService = $userService;
    }

    /**
     * **********************************
     * Method is used to view home page
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function index()
    {
        $jobCategories = $this->jobCategoryService->getAllJobCategory();
        $jobs = $this->jobService->getAllJobs('6');
        return view('frontend.home', compact('jobs', 'jobCategories'));
    }

    /**
     * **********************************
     * Method is used to view contact page
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function contactUs()
    {
        return view('frontend.contactus');
    }

    /**
     * **********************************
     * Method is used to view contact page
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function saveContact(ContactInputRequest $request)
    {
        // Google reCAPTCHA API key configuration
        $siteKey = env('RECAPTCHA_SITE_KEY');
        $secretKey = env('RECAPTCHA_SITE_SECRET');

        $data = $request->all();
        try {
            if (isset($data['g-recaptcha-response']) && !empty($data['g-recaptcha-response'])) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secretKey,
                    'response' => $_POST['g-recaptcha-response'],
                    'remoteip' => $request->ip(),
                ]);
                $responseBody = $response->json();
                if ($responseBody['success']) {
                    $inputArray = $this->validateContactRequest($request);
                    $contactId = $this->userService->saveContact($inputArray);
                    return response()->json(
                        [
                            'status' => true,
                            'msg' => 'Message sent successfully!',
                        ]
                    );
                }
            } else {
                return response()->json(
                    [
                        'status' => '2',
                        'msg' => 'Please check on the reCAPTCHA box',
                    ]
                );
            }
        } catch (Exception $exception) {
            Log::channel('exceptionLog')->error("Exception: " . $exception->getMessage() . ' in ' . $exception->getFile() . ' StackTrace:' . $exception->getTraceAsString());
            return response()->json(
                [
                    'status' => false,
                    'msg' => $exception->getMessage()
                ]
            );
        }
    }

    /**
     * ***********************************************
     * method used to check required input for contact
     * -----------------------------------------------
     *
     * @param  object $request
     * @return request
     * ***********************************************
     */
    private function validateContactRequest(Request $request)
    {
        return $request->only(['name', 'email', 'message']);
    }

    /**
     * **********************************
     * Method is used to view privacy page
     * ----------------------------------
     * @return view
     * **********************************
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * **********************************************
     * Method is used to view term & condition page
     * ----------------------------------------------
     * @return view
     * **********************************************
     */
    public function terms()
    {
        return view('frontend.terms-and-condition');
    }
}
