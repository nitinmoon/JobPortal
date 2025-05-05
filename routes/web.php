<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\backend\CandidateController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DesignationController;
use App\Http\Controllers\backend\EmployerController;
use App\Http\Controllers\backend\JobCategoryController;
use App\Http\Controllers\backend\JobController;
use App\Http\Controllers\backend\JobTypeController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\CandidateController as FrontendCandidateController;
use App\Http\Controllers\frontend\EmployerController as FrontendEmployerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\JobController as FrontendJobController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Backend Auth Routes
|--------------------------------------------------------------------------
|
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/console', function () {
        return redirect(route('adminLogin'));
    });
    Route::prefix('console')->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('/login', 'index')->name('adminLogin');
            Route::post('/check-admin-login', 'checkLogin')->name('checkAdminLogin');
            Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
            Route::post('/send-reset-password-link', 'sendResetPasswordLink')
                ->name('sendResetPasswordLink');
            Route::get('/reset-password/{token?}', 'resetPassword')->name('console/resetPassword');
            Route::post('/update-reset-password', 'updateResetPassword')->name('updateResetPassword');
        });
    });
});

/*
|--------------------------------------------------------------------------
| After Login Backend Routes
|--------------------------------------------------------------------------
|
*/
Route::middleware(['isAdminLoggedIn'])->group(function () {
    Route::prefix('console')->group(function () {
        /*
        | Dashboard Routes
        */
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::post('/update-admin-profile', 'updateAdminProfile')->name('updateAdminProfile');
            Route::post('/change-password', 'changePassword')->name('changePassword');
            Route::get('/get-apply-job-count', 'getApplyJobCount')->name('getApplyJobCount');
            Route::post('update-admin-profile-image/{id}', 'updateAdminProfileImage')->name('updateAdminProfileImage');
        });

        /*
        | Logout Routes
        */
        Route::controller(LoginController::class)->group(function () {
            Route::get('/admin-logout', 'logout')->name('adminLogout');
        });

        /*
        | Job Type Routes
        */
        Route::controller(JobTypeController::class)->group(function () {
            Route::get('/job-types', 'index')->name('jobTypes');
            Route::get('/add-job-type-modal', 'addJobTypeModal')->name('addJobTypeModal');
            Route::post('/add-update-job-type', 'addUpdateJobType')->name('addUpdateJobType');
            Route::get('/edit-job-type-modal/{id}', 'editJobTypeModal')->name('editJobTypeModal');
            Route::post('/change-job-type-status', 'changeJobTypeStatus')->name('changeJobTypeStatus');
            Route::get('/delete-job-type/{id}', 'deleteJobType')->name('deleteJobType');
            Route::get('/restore-job-type/{id}', 'restoreJobType')->name('restoreJobType');
        });

        /*
        | Job Category Routes
        */
        Route::controller(JobCategoryController::class)->group(function () {
            Route::get('/job-category', 'index')->name('jobCategories');
            Route::get('/add-job-category-modal', 'addJobCategoryModal')->name('addJobCategoryModal');
            Route::post('/add-update-job-category', 'addUpdateJobCategory')->name('addUpdateJobCategory');
            Route::get('/edit-job-category-modal/{id}', 'editJobCategoryModal')->name('editJobCategoryModal');
            Route::post('/change-job-category-status', 'changeJobCategoryStatus')->name('changeJobCategoryStatus');
            Route::get('/delete-job-category/{id}', 'deleteJobCategory')->name('deleteJobCategory');
            Route::get('/restore-job-category/{id}', 'restoreJobCategory')->name('restoreJobCategory');
        });

        /*
        | Candidate Routes
        */
        Route::controller(CandidateController::class)->group(function () {
            Route::get('/candidates', 'index')->name('candidates');
            Route::get('/add-candidate-form', 'addcandidateForm')->name('addcandidateForm');
            Route::get('/delete-candidate/{id}', 'deleteCandidate')->name('deleteCandidate');
            Route::get('/restore-candidate/{id}', 'restoreCandidate')->name('restoreCandidate');
            Route::post('/change-candidate-status', 'changeCandidateStatus')->name('changeCandidateStatus');
            Route::get('/view-candidate/{id}', 'viewCandidate')->name('viewCandidate');
            Route::get('/autocomplete-search-candidate', 'autoCompleteSearchCandidate')->name('autoCompleteSearchCandidate');
            Route::get('/get-apply-jobs', 'getApplyJobListing')->name('getApplyJobListing');
        });

        /*
        | Employer Routes
        */
        Route::controller(EmployerController::class)->group(function () {
            Route::get('/employers', 'index')->name('employers');
            Route::get('/delete-employer/{id}', 'deleteEmployer')->name('deleteEmployer');
            Route::get('/restore-employer/{id}', 'restoreEmployer')->name('restoreEmployer');
            Route::post('/change-employer-status', 'changeEmployerStatus')->name('changeEmployerStatus');
            Route::get('/view-employer/{id}', 'viewEmployer')->name('viewEmployer');
            Route::get('/add-employer-form', 'addEmployer')->name('addEmployer');
            Route::post('/add-update-employer', 'addUpdateEmployer')->name('addUpdateEmployer');
            Route::get('/edit-employer/{id}', 'editEmployer')->name('editEmployer');
            Route::get('/my-profile', 'myProfile')->name('adminMyProfile');
            Route::post('/update-employer-profile', 'updateEmployerProfile')->name('updateEmployerProfile');
            Route::get('/autocomplete-search-employer', 'autoCompleteSearchEmployer')->name('autoCompleteSearchEmployer');
        });

        /*
        | Designation Routes
        */
        Route::controller(DesignationController::class)->group(function () {
            Route::get('/designations', 'index')->name('designations');
            Route::get('/add-designation-modal', 'addDesignationModal')->name('addDesignationModal');
            Route::post('/add-update-designation', 'addUpdateDesignation')->name('addUpdateDesignation');
            Route::get('/edit-designation-modal/{id}', 'editDesignationModal')->name('editDesignationModal');
            Route::post('/change-designation-status', 'changeDesignationStatus')->name('changeDesignationStatus');
            Route::get('/delete-designation/{id}', 'deleteDesignation')->name('deleteDesignation');
            Route::get('/restore-designation/{id}', 'restoreDesignation')->name('restoreDesignation');
        });

        /*
        | Job Routes
        */
        Route::controller(JobController::class)->group(function () {
            Route::get('/jobs-list', 'index')->name('jobsList');
            Route::get('/add-job', 'addJob')->name('addJob');
            Route::post('/add-update-job', 'addUpdateJob')->name('addUpdateJob');
            Route::get('/edit-job/{id}', 'editJob')->name('editJob');
            Route::post('/change-job-status', 'changeJobStatus')->name('changeJobStatus');
            Route::get('/delete-job/{id}', 'deleteJob')->name('deleteJob');
            Route::get('/restore-job/{id}', 'restoreJob')->name('restoreJob');
            Route::get('/view-detail-job/{id}', 'jobDetails')->name('viewdetailJob');
            Route::get('/download-resume/{id?}', 'downloadResume')->name('downloadResume');
        });
    });
});

/*
| Common Ajax Routes
*/
Route::controller(AjaxController::class)->group(function () {
    Route::get('/get-state', 'getState')->name('getState');
    Route::get('/get-city', 'getCity')->name('getCity');
    Route::get('/autocomplete-location', 'autocompleteLocation')->name('autocompleteLocation');
    Route::get('/autocomplete-search-apply-candidate', 'autocompleteSearchApplyCandidate')
        ->name('autocompleteSearchApplyCandidate');
});

/*
|--------------------------------------------------------------------------
| Frontend Auth Routes
|--------------------------------------------------------------------------
|
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/employer', function () {
        return redirect(route('employerLogin'));
    });
    Route::get('/candidate', function () {
        return redirect(route('candidateLogin'));
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/auth-type/{flag}', 'authType')->name('authType');
        Route::prefix('employer')->group(function () {
            Route::get('/employer-register', 'register')->name('employerRegister');
            Route::get('/employer-login', 'login')->name('employerLogin');
        });
        Route::prefix('candidate')->group(function () {
            Route::get('/candidate-register', 'register')->name('candidateRegister');
            Route::get('/candidate-login', 'login')->name('candidateLogin');
        });
        Route::post('/verify-email', 'verifyEmail')->name('verifyEmail');
        Route::post('/verify-otp', 'verifyOtp')->name('verifyOtp');
        Route::post('/register-user', 'registerUser')->name('registerUser');
        Route::post('/check-login', 'checkLogin')->name('checkLogin');
    });
});

/*
|--------------------------------------------------------------------------
| Frontend Home Routes
|--------------------------------------------------------------------------
|
*/
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index')->name('home');
});

/*
|--------------------------------------------------------------------------
| Frontend Job Routes
|--------------------------------------------------------------------------
|
*/
Route::controller(FrontendJobController::class)->group(function () {
    Route::get('/jobs', 'index')->name('jobs');
});

/*
|--------------------------------------------------------------------------
| Frontend Logout Routes
|--------------------------------------------------------------------------
|
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Frontend Employer Routes
|--------------------------------------------------------------------------
|
*/
Route::middleware(['isEmployerLoggedIn'])->group(function () {
    Route::prefix('employer')->group(function () {
        Route::controller(FrontendEmployerController::class)->group(function () {
            Route::get('/my-profile', 'myProfile')->name('myProfile');
            Route::get('/company-profile', 'companyProfile')->name('companyProfile');
            Route::get('/company-job-post', 'companyJobPost')->name('companyJobPost');
            Route::post('/add-update-job', 'addUpdateJob')->name('addUpdateJob');
            Route::get('/company-transactions', 'companyTransactions')->name('companyTransactions');
            Route::get('/company-manage-jobs', 'companyManageJobs')->name('companyManageJobs');
            Route::get('/company-resume', 'companyResume')->name('companyResume');
            Route::get('/employer-change-password', 'employerChangePassword')->name('employerChangePassword');
            Route::post('/update-profile', 'updateProfile')->name('updateProfile');
            Route::post('/update-company-profile', 'updateCompanyProfile')->name('updateCompanyProfile');
            Route::post('/update-company-logo', 'updateCompanyLogo')->name('updateCompanyLogo');
            Route::post('/change-employer-password', 'changeEmployerPassword')->name('changeEmployerPassword');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Frontend Candidate Routes
|--------------------------------------------------------------------------
|
*/
Route::middleware(['isCandidateLoggedIn'])->group(function () {
    Route::prefix('candidate')->group(function () {
        Route::controller(FrontendCandidateController::class)->group(function () {
            Route::get('/candidate-profile', 'myProfile')->name('candidateProfile');
            Route::post('/update-cadidate-profile', 'updateCandidateProfile')->name('updateCandidateProfile');
            Route::get('/my-resume', 'myResume')->name('myResume');
            Route::get('/cadidate-change-password', 'cadidateChangePassword')->name('cadidateChangePassword');
            Route::post('/change-candidate-password', 'changeCandidatePassword')->name('changeCandidatePassword');
            Route::post('/update-candidate-profile', 'updateCandidateProfilePhoto')->name('updateCandidateProfilePhoto');
        });
    });
});
