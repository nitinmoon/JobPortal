@extends('frontend.layouts.app')

@section('title', 'Candidate Resume')
@section('style')
<style>
    .profile-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-wrapper img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }

    .upload-link {
        position: absolute;
        top: 10px;
        /* bottom: 10px; */
        /* right: 10px; */
        background: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        padding: 8px;
        cursor: pointer;
        color: #fff;
    }

    .upload-link input[type="file"] {
        display: none;
    }
</style>
@endsection
@section('content')
<!-- Content -->
<div class="page-content">
    <!-- inner page banner -->
    <div class="overlay-black-dark profile-edit p-t50 p-b20" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 candidate-info">
                    <div class="candidate-detail">
                        <div class="canditate-des text-center">
                            <a href="javascript:void(0);">
                                <img alt="" src="{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}">
                            </a>
                            <!-- <div class="upload-link" title="update" data-bs-toggle="tooltip" data-placement="right">
                                <input type="file" class="update-flie">
                                <i class="fa fa-camera"></i>
                            </div> -->
                        </div>
                        <div class="text-white browse-job text-left">
                            <h4 class="m-b0">{{ isset($userDetails->id) ? $userDetails->first_name.' '.$userDetails->middle_name.' '.$userDetails->last_name : '' }}
                                <a class="m-l15 font-16 text-white" href="{{ route('candidateProfile') }}"><i class="fas fa-pencil-alt"></i></a>
                            </h4>
                            <p class="m-b15">{{ isset($candidateDetails->designation->name) ? $candidateDetails->designation->name : '--' }}</p>
                            <ul class="clearfix">
                                <li><i class="ti-location-pin"></i> {{ isset($userDetails->address) ? $userDetails->address.', '.$userDetails->city_name.', '.$userDetails->state_name.', '.$userDetails->country_name.' - '.$userDetails->zip : '' }}</li>
                                <li><i class="ti-mobile"></i> {{ isset($userDetails->phone) ? $userDetails->phone : '' }}</li>
                                <li><i class="ti-briefcase"></i> {{ isset($candidateDetails->experience) ? $candidateDetails->experience : '--' }}</li>
                                <li><i class="ti-email"></i> {{ isset($userDetails->email) ? $userDetails->email : '' }}</li>
                            </ul>
                            <!-- <div class="progress-box m-t10">
                                <div class="progress-info">Profile Strength (Average)<span>70%</span></div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" style="width: 80%" role="progressbar"></div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-5">
                    <a href="javascript:void(0);">
                        <div class="pending-info text-white p-a25">
                            <h5>Pending Action</h5>
                            <ul class="list-check secondry">
                                <li>Verify Mobile Number</li>
                                <li>Add Preferred Location</li>
                                <li>Add Resume</li>
                            </ul>
                        </div>
                    </a>
                </div> -->
            </div>
        </div>
        <!-- Modal -->
        <!-- <div class="modal fade browse-job modal-bx-info editor" id="profilename" tabindex="-1" role="dialog" aria-labelledby="ProfilenameModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ProfilenameModalLongTitle">Basic Details</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="email" class="form-control" placeholder="Enter Your Name">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Fresher
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Experienced
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Select Your Country</label>
                                        <select>
                                            <option>India</option>
                                            <option>Australia</option>
                                            <option>Bahrain</option>
                                            <option>China</option>
                                            <option>Dubai</option>
                                            <option>France</option>
                                            <option>Germany</option>
                                            <option>Hong Kong</option>
                                            <option>Kuwait</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Select Your Country</label>
                                        <input type="text" class="form-control" placeholder="Select Your Country">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Select Your City</label>
                                        <input type="text" class="form-control" placeholder="Select Your City">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Telephone Number</label>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                <input type="text" class="form-control" placeholder="Country Code">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                <input type="text" class="form-control" placeholder="Area Code">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                <input type="text" class="form-control" placeholder="Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <h6 class="m-a0 font-14">info@example.com</h6>
                                        <a href="#">Change Email Address</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="site-button">Save</button>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Modal End -->
    </div>
    <!-- inner page banner END -->
    <!-- contact area -->
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full browse-job content-inner-2 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 m-b30">
                        <div class="sticky-top bg-white">
                            <div class="candidate-info onepage">
                                <ul>
                                    <li><a class="scroll-bar nav-link" href="#resume_headline_bx">
                                            <span>Resume Headline</span></a></li>
                                    <li><a class="scroll-bar nav-link" href="#key_skills_bx">
                                            <span>Key Skills</span></a></li>
                                    <li><a class="scroll-bar nav-link" href="#employment_bx">
                                            <span>Employment</span></a></li>
                                    <li><a class="scroll-bar nav-link" href="#education_bx">
                                            <span>Education</span></a></li>
                                    <li><a class="scroll-bar nav-link" href="#profile_summary_bx">
                                            <span>Profile Summary</span></a></li>
                                    <li><a class="scroll-bar nav-link" href="#desired_career_profile_bx">
                                            <span>Desired Career Profile</span></a></li>
                                    <li><a class="scroll-bar nav-link" href="#personal_details_bx">
                                            <span>Personal Details</span></a></li>
                                    <li><a class="scroll-bar nav-link" href="#attach_resume_bx">
                                            <span>Attach Resume</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
                        <div id="resume_headline_bx" class="job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b15">Resume Headline</h5>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#resumeheadline" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                            </div>
                            <p class="m-b0">{{ isset($candidateDetails->resume_headline) ? $candidateDetails->resume_headline : '' }}</p>
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info editor" id="resumeheadline" tabindex="-1" role="dialog" aria-labelledby="ResumeheadlineModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ResumeheadlineModalLongTitle">Resume Headline</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editResumeHeadlineForm" action="{{ route('updateCandidateDetails') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>It is the first thing recruiters notice in your profile. Write concisely what makes you unique and right person for the job you are looking for.</p>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" placeholder="Enter Resume Headline" name="resume_headline">{{ isset($candidateDetails->resume_headline) ? $candidateDetails->resume_headline : '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="site-button">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                        </div>
                        <div id="key_skills_bx" class="job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b15">Key Skills</h5>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#keyskills" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                            </div>
                            <div class="job-time me-auto">
                                @if(isset($candidateDetails->skills) && $candidateDetails->skills != null)
                                <a href="javascript:void(0);">{!! getJobSkills($candidateDetails->skills) !!}</a>
                                @endif
                            </div>
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info editor" id="keyskills" tabindex="-1" role="dialog" aria-labelledby="KeyskillsModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="KeyskillsModalLongTitle">Key Skills</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editSkillsForm" action="{{ route('updateCandidateDetails') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>It is the first thing recruiters notice in your profile. Write concisely what makes you unique and right person for the job you are looking for.</p>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2">
                                                        <label for="inputEmail5" class="form-label">Skills <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10">
                                                        <select class="form-control skills-select" multiple="multiple" name="skills[]" id="skills" data-error="#error_skills" data-placeholder="Enter your skills" style="width:100% !important;">
                                                            @if (isset($skills))
                                                            <option value="">Select skills</option>
                                                            @foreach($skills as $skill)
                                                                <option value="{{ $skill->name }}" {{ (isset($candidateDetails->skills) && $candidateDetails->skills != '' && in_array($skill->id, explode(',', $candidateDetails->skills))) ? 'selected' : '' }}>{{ $skill->name }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="error" id="error_skills"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="site-button">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                        </div>
                        <div id="employment_bx" class="job-bx table-job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b15">Employment</h5>
                                <a href="javascript:void(0);" data-url="{{ route('addEmploymentModal') }}" class="site-button add-btn button-sm add-employment"><i class="fas fa-plus m-r5"></i> Add</a>
                            </div>
                            <p>Mention your employment details including your current and previous company work experience</p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Organization</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Experience</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($employmentDetails)> 0)
                                    @foreach($employmentDetails as $employment)
                                    <tr>
                                        <td>{{ $employment->designation->name }}</td>
                                        <td>{{ $employment->organization }}</td>
                                        <td>{{ getMonth($employment->work_from) }}</td>
                                        <td>{{ getMonth($employment->work_till) }}</td>
                                        <td>{{ $employment->experience }}</td>
                                        <td><a class="m-l15 font-14 edit-employment" href="javascript:void(0);" data-url="{{ route('editEmploymentModal', $employment->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="6">No data found!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <!-- <h6 class="font-14 m-b0">Junior Software DeveloperEdit</h6>
                            <p class="m-b0">W3itexperts</p>
                            <p class="m-b0">Oct 2021 to Present (3 years 4 months)</p>
                            <p class="m-b0">Available to join in 1 Months</p>
                            <p class="m-b0">Junior Software Developer</p> -->
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info editor" id="employmentModal" tabindex="-1" role="dialog" aria-labelledby="EmploymentModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" id="employmentModalBody">
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                        </div>
                        <div id="education_bx" class="job-bx table-job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b15">Education</h5>
                                <a href="javascript:void(0);" data-url="{{ route('addEducationModal') }}"  class="site-button add-btn button-sm add-education"><i class="fas fa-plus m-r5"></i> Add</a>
                            </div>
                            <p>Mention your education details including your current and previous company work experience</p>
                            <!-- Modal -->
                             <div class="modal fade modal-bx-info editor" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" id="educationModalBody">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal fade modal-bx-info editor" id="education" tabindex="-1" role="dialog" aria-labelledby="EducationModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="EducationModalLongTitle">Education</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Education</label>
                                                            <select>
                                                                <option>Doctorate/PhD</option>
                                                                <option>Masters/Post-Graduation</option>
                                                                <option>Graduation/Diploma</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Course</label>
                                                            <input type="email" class="form-control" placeholder="Select Course">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>University/Institute</label>
                                                            <input type="email" class="form-control" placeholder="Select University/Institute">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="site-button">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Modal End -->
                             <div class="table table-responsive" style="x-overflow:scroll;width:100%">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Education</th>
                                        <th style="min-width: 150px !important;">College / Institute</th>
                                        <th style="min-width: 150px !important;">Board / University</th>
                                        <th>Year of Passing</th>
                                        <th>Percentage / CGPA</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($educationDetails)> 0)
                                    @foreach($educationDetails as $education)
                                    <tr>
                                        <td>{{ $education->education }}</td>
                                        <td>{{ $education->college }}</td>
                                        <td>{{ $education->university }}</td>
                                        <td>{{ getMonth($education->year_of_passing) }}</td>
                                        <td>{{ $education->percentage }}</td>
                                        <td><a class="m-l15 font-14 edit-education" href="javascript:void(0);" data-url="{{ route('editEducationModal', $education->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="6">No data found!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">London - 12th</label>
                                        <span class="clearfix font-13">2019</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">London - 10th</label>
                                        <span class="clearfix font-13">2021</span>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="clearfix">Add Doctorate/PhD</a>
                            <a href="javascript:void(0);" class="clearfix">Add Masters/Post-Graduation</a>
                            <a href="javascript:void(0);" class="clearfix">Add Graduation/Diploma</a> -->
                        </div>
                        <!-- <div id="it_skills_bx" class="job-bx table-job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b15">IT Skills</h5>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#itskills" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                            </div>
                            <p>Mention your employment details including your current and previous company work experience</p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Skills</th>
                                        <th>Version</th>
                                        <th>Last Used</th>
                                        <th>Experience</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bootstrap</td>
                                        <td>3</td>
                                        <td>2018</td>
                                        <td>1 Year 5 Months</td>
                                        <td><a class="m-l15 font-14" data-bs-toggle="modal" data-bs-target="#itskills" href="#"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Bootstrap</td>
                                        <td>4</td>
                                        <td>2019</td>
                                        <td>5 Year 5 Months</td>
                                        <td><a class="m-l15 font-14" data-bs-toggle="modal" data-bs-target="#itskills" href="#"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>html</td>
                                        <td>5</td>
                                        <td>2017</td>
                                        <td>2 Year 7 Months</td>
                                        <td><a class="m-l15 font-14" data-bs-toggle="modal" data-bs-target="#itskills" href="#"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>css</td>
                                        <td>3</td>
                                        <td>2020</td>
                                        <td>0 Year 5 Months</td>
                                        <td><a class="m-l15 font-14" data-bs-toggle="modal" data-bs-target="#itskills" href="#"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>photoshop</td>
                                        <td>64bit</td>
                                        <td>2019</td>
                                        <td>1 Year 0 Months</td>
                                        <td><a class="m-l15 font-14" data-bs-toggle="modal" data-bs-target="#itskills" href="#"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal fade modal-bx-info editor" id="itskills" tabindex="-1" role="dialog" aria-labelledby="ItskillsModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ItskillsModalLongTitle">IT Skills</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>IT Skills</label>
                                                            <input type="email" class="form-control" placeholder="Enter IT Skills">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Version</label>
                                                            <input type="email" class="form-control" placeholder="Enter Version">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Last Used</label>
                                                            <select>
                                                                <option>2021</option>
                                                                <option>2020</option>
                                                                <option>2019</option>
                                                                <option>2018</option>
                                                                <option>2017</option>
                                                                <option>2016</option>
                                                                <option>2015</option>
                                                                <option>2014</option>
                                                                <option>2013</option>
                                                                <option>2012</option>
                                                                <option>2011</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>Experience</label>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <select>
                                                                        <option>2021</option>
                                                                        <option>2020</option>
                                                                        <option>2019</option>
                                                                        <option>2018</option>
                                                                        <option>2017</option>
                                                                        <option>2016</option>
                                                                        <option>2015</option>
                                                                        <option>2014</option>
                                                                        <option>2013</option>
                                                                        <option>2012</option>
                                                                        <option>2011</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <select>
                                                                        <option>january</option>
                                                                        <option>february</option>
                                                                        <option>March</option>
                                                                        <option>April</option>
                                                                        <option>May</option>
                                                                        <option>Jun</option>
                                                                        <option>July</option>
                                                                        <option>August</option>
                                                                        <option>September</option>
                                                                        <option>October</option>
                                                                        <option>November</option>
                                                                        <option>December</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="site-button">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div id="projects_bx" class="job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b15">Projects</h5>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#projects" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                            </div>
                            <h6 class="font-14 m-b0">Job BoardEdit</h6>
                            <p class="m-b0">w3itexpert (Offsite)</p>
                            <p class="m-b0">Dec 2021 to Present (Full Time)</p>
                            <p class="m-b0">Job Board Template</p>
                            <div class="modal fade modal-bx-info editor" id="projects" tabindex="-1" role="dialog" aria-labelledby="ProjectsModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ProjectsModalLongTitle">Add Projects</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Project Title</label>
                                                            <input type="email" class="form-control" placeholder="Enter Project Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Tag this project with your Employment/Education</label>
                                                            <select>
                                                                <option>Class 12th</option>
                                                                <option>Class 10th</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Client</label>
                                                            <input type="email" class="form-control" placeholder="Enter Client Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Project Status</label>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="inprogress" name="example1">
                                                                        <label class="form-check-label" for="inprogress">In Progress</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="finished" name="example1">
                                                                        <label class="form-check-label" for="finished">Finished</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>Started Working From</label>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <select>
                                                                        <option>2021</option>
                                                                        <option>2020</option>
                                                                        <option>2019</option>
                                                                        <option>2018</option>
                                                                        <option>2017</option>
                                                                        <option>2016</option>
                                                                        <option>2015</option>
                                                                        <option>2014</option>
                                                                        <option>2013</option>
                                                                        <option>2012</option>
                                                                        <option>2011</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <select>
                                                                        <option>january</option>
                                                                        <option>february</option>
                                                                        <option>March</option>
                                                                        <option>April</option>
                                                                        <option>May</option>
                                                                        <option>Jun</option>
                                                                        <option>July</option>
                                                                        <option>August</option>
                                                                        <option>September</option>
                                                                        <option>October</option>
                                                                        <option>November</option>
                                                                        <option>December</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>Worked Till</label>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <select>
                                                                        <option>2021</option>
                                                                        <option>2020</option>
                                                                        <option>2019</option>
                                                                        <option>2018</option>
                                                                        <option>2017</option>
                                                                        <option>2016</option>
                                                                        <option>2015</option>
                                                                        <option>2014</option>
                                                                        <option>2013</option>
                                                                        <option>2012</option>
                                                                        <option>2011</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <select>
                                                                        <option>january</option>
                                                                        <option>february</option>
                                                                        <option>March</option>
                                                                        <option>April</option>
                                                                        <option>May</option>
                                                                        <option>Jun</option>
                                                                        <option>July</option>
                                                                        <option>August</option>
                                                                        <option>September</option>
                                                                        <option>October</option>
                                                                        <option>November</option>
                                                                        <option>December</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Details of Project</label>
                                                            <textarea class="form-control" placeholder="Type Description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="site-button">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div id="profile_summary_bx" class="job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b15">Profile Summary</h5>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#profilesummary" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                            </div>
                            <p class="m-b0">{{ isset($candidateDetails->profile_summary) ? $candidateDetails->profile_summary : '' }}</p>
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info editor" id="profilesummary" tabindex="-1" role="dialog" aria-labelledby="ProfilesummaryModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ProfilesummaryModalLongTitle">Profile Summary</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editProfileSummaryForm" action="{{ route('updateCandidateDetails') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Your Profile Summary should mention the highlights of your career and education, what your professional interests are, and what kind of a career you are looking for. Write a meaningful summary of more than 50 characters.</p>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" placeholder="Enter Profile Summary" name="profile_summary">{{ isset($candidateDetails->profile_summary) ? $candidateDetails->profile_summary : '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="site-button">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                        </div>
                        <!-- <div id="accomplishments_bx" class="job-bx m-b30">
                            <h5 class="m-b10">Accomplishments</h5>
                            <div class="list-row">
                                <div class="list-line">
                                    <div class="d-flex">
                                        <h6 class="font-14 m-b5">Online Profile</h6>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#accomplishments" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                                    </div>
                                    <p class="m-b0">Add link to Online profiles (e.g. Linkedin, Facebook etc.).</p>
                                    <div class="modal fade modal-bx-info editor" id="accomplishments" tabindex="-1" role="dialog" aria-labelledby="AccomplishmentsModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="AccomplishmentsModalLongTitle">Online Profiles</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Social Profile</label>
                                                                    <input type="email" class="form-control" placeholder="Social Profile Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="email" class="form-control" placeholder="www.google.com">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" placeholder="Type Description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="site-button">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-line">
                                    <div class="d-flex">
                                        <h6 class="font-14 m-b5">Work Sample</h6>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#worksample" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                                    </div>
                                    <p class="m-b0">Add link to your Projects (e.g. Github links etc.).</p>
                                    <div class="modal fade modal-bx-info editor" id="worksample" tabindex="-1" role="dialog" aria-labelledby="WorksampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="WorksampleModalLongTitle">Work Sample</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Work Title</label>
                                                                    <input type="email" class="form-control" placeholder="Enter Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="email" class="form-control" placeholder="www.google.com">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Duration From</label>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>2021</option>
                                                                                <option>2020</option>
                                                                                <option>2019</option>
                                                                                <option>2018</option>
                                                                                <option>2017</option>
                                                                                <option>2016</option>
                                                                                <option>2015</option>
                                                                                <option>2014</option>
                                                                                <option>2013</option>
                                                                                <option>2012</option>
                                                                                <option>2011</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>january</option>
                                                                                <option>february</option>
                                                                                <option>March</option>
                                                                                <option>April</option>
                                                                                <option>May</option>
                                                                                <option>Jun</option>
                                                                                <option>July</option>
                                                                                <option>August</option>
                                                                                <option>September</option>
                                                                                <option>October</option>
                                                                                <option>November</option>
                                                                                <option>December</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Duration To</label>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>2021</option>
                                                                                <option>2020</option>
                                                                                <option>2019</option>
                                                                                <option>2018</option>
                                                                                <option>2017</option>
                                                                                <option>2016</option>
                                                                                <option>2015</option>
                                                                                <option>2014</option>
                                                                                <option>2013</option>
                                                                                <option>2012</option>
                                                                                <option>2011</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>january</option>
                                                                                <option>february</option>
                                                                                <option>March</option>
                                                                                <option>April</option>
                                                                                <option>May</option>
                                                                                <option>Jun</option>
                                                                                <option>July</option>
                                                                                <option>August</option>
                                                                                <option>September</option>
                                                                                <option>October</option>
                                                                                <option>November</option>
                                                                                <option>December</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="check1" name="example1">
                                                                        <label class="form-check-label" for="check1">I am currently working on this</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" placeholder="Type Description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="site-button">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-line">
                                    <div class="d-flex">
                                        <h6 class="font-14 m-b5">White Paper / Research Publication / Journal Entry</h6>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#journalentry" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                                    </div>
                                    <p class="m-b0">Add links to your Online publications.</p>
                                    <div class="modal fade modal-bx-info editor" id="journalentry" tabindex="-1" role="dialog" aria-labelledby="JournalentryModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="JournalentryModalLongTitle">White Paper / Research Publication / Journal Entry</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input type="email" class="form-control" placeholder="Enter Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="email" class="form-control" placeholder="www.google.com">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Published On</label>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>2021</option>
                                                                                <option>2020</option>
                                                                                <option>2019</option>
                                                                                <option>2018</option>
                                                                                <option>2017</option>
                                                                                <option>2016</option>
                                                                                <option>2015</option>
                                                                                <option>2014</option>
                                                                                <option>2013</option>
                                                                                <option>2012</option>
                                                                                <option>2011</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>january</option>
                                                                                <option>february</option>
                                                                                <option>March</option>
                                                                                <option>April</option>
                                                                                <option>May</option>
                                                                                <option>Jun</option>
                                                                                <option>July</option>
                                                                                <option>August</option>
                                                                                <option>September</option>
                                                                                <option>October</option>
                                                                                <option>November</option>
                                                                                <option>December</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" placeholder="Type Description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="site-button">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-line">
                                    <div class="d-flex">
                                        <h6 class="font-14 m-b5">Presentation</h6>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#presentation" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                                    </div>
                                    <p class="m-b0">Add links to your Online presentations (e.g. Slideshare presentation links etc.).</p>
                                    <div class="modal fade modal-bx-info editor" id="presentation" tabindex="-1" role="dialog" aria-labelledby="PresentationModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="PresentationModalLongTitle">Presentation</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input type="email" class="form-control" placeholder="Enter Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="email" class="form-control" placeholder="www.google.com">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" placeholder="Type Description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="site-button">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-line">
                                    <div class="d-flex">
                                        <h6 class="font-14 m-b5">Patent</h6>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#patent" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                                    </div>
                                    <p class="m-b0">Add details of Patents you have filed.</p>
                                    <div class="modal fade modal-bx-info editor" id="patent" tabindex="-1" role="dialog" aria-labelledby="PatentModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="PatentModalLongTitle">Patent</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input type="email" class="form-control" placeholder="Enter Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="email" class="form-control" placeholder="www.google.com">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Patent Office</label>
                                                                    <input type="email" class="form-control" placeholder="Enter Patent Office">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <div class="form-check">
                                                                                <input type="radio" class="form-check-input" id="check2" name="example1">
                                                                                <label class="form-check-label" for="check2">Patent Issued</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <div class="form-check">
                                                                                <input type="radio" class="form-check-input" id="check3" name="example1">
                                                                                <label class="form-check-label" for="check3">Patent pending</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Application Number</label>
                                                                    <input type="email" class="form-control" placeholder="Enter Application Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Published On</label>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>2021</option>
                                                                                <option>2020</option>
                                                                                <option>2019</option>
                                                                                <option>2018</option>
                                                                                <option>2017</option>
                                                                                <option>2016</option>
                                                                                <option>2015</option>
                                                                                <option>2014</option>
                                                                                <option>2013</option>
                                                                                <option>2012</option>
                                                                                <option>2011</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <select>
                                                                                <option>january</option>
                                                                                <option>february</option>
                                                                                <option>March</option>
                                                                                <option>April</option>
                                                                                <option>May</option>
                                                                                <option>Jun</option>
                                                                                <option>July</option>
                                                                                <option>August</option>
                                                                                <option>September</option>
                                                                                <option>October</option>
                                                                                <option>November</option>
                                                                                <option>December</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" placeholder="Type Description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="site-button">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-line">
                                    <div class="d-flex">
                                        <h6 class="font-14 m-b5">Certification</h6>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#certification" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                                    </div>
                                    <p class="m-b0">Add details of Certification you have filed.</p>
                                    <div class="modal fade modal-bx-info editor" id="certification" tabindex="-1" role="dialog" aria-labelledby="CertificationModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="CertificationModalLongTitle">Certification</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Certification Name</label>
                                                                    <input type="text" class="form-control" placeholder="Enter Certification Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Certification Body</label>
                                                                    <input type="text" class="form-control" placeholder="Enter Certification Body">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Year Onlabel</label>
                                                                    <select>
                                                                        <option>2021</option>
                                                                        <option>2020</option>
                                                                        <option>2019</option>
                                                                        <option>2018</option>
                                                                        <option>2017</option>
                                                                        <option>2016</option>
                                                                        <option>2015</option>
                                                                        <option>2014</option>
                                                                        <option>2013</option>
                                                                        <option>2012</option>
                                                                        <option>2011</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="site-button">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div id="desired_career_profile_bx" class="job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b30">Desired Career Profile</h5>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#desiredprofile" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info editor" id="desiredprofile" tabindex="-1" role="dialog" aria-labelledby="DesiredprofileModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="DesiredprofileModalLongTitle">Desired Career Profile </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editCareerProfileForm" action="{{ route('updateCandidateDetails') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3">
                                                        <label for="inputEmail5" class="form-label">Job Category <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <select class="js-example-basic-single" data-error="#error_job_category_id" name="job_category_id" data-placeholder="Select Category">
                                                            <option value="">Select</option>
                                                            @foreach($jobCategories as $category)
                                                            <option value="{{ $category->id }}" {{ isset($candidateDetails->job_category_id) && $category->id == $candidateDetails->job_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error" id="error_job_category_id"></span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-3 col-md-3">
                                                        <label for="inputEmail5" class="form-label">Designation <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <select class="js-example-basic-single" data-error="#error_designation_id" name="designation_id" data-placeholder="Select Designation">
                                                            <option value="">Select</option>
                                                            @foreach($designations as $designation)
                                                            <option value="{{ $designation->id }}" {{ isset($candidateDetails->designation_id) && $candidateDetails->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error" id="error_designation_id"></span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-3 col-md-3">
                                                        <label for="inputEmail5" class="form-label">Job Type <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <select class="js-example-basic-single" data-error="#error_job_type_id" name="job_type_id" data-placeholder="Select Job Type">
                                                            <option value="">Select</option>
                                                            @foreach($jobTypes as $jobType)
                                                            <option value="{{ $jobType->id }}" {{ isset($candidateDetails->job_type_id) && $candidateDetails->job_type_id == $jobType->id ? 'selected' : '' }}>{{ $jobType->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error" id="error_job_type_id"></span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-3 col-md-3">
                                                        <label for="inputEmail5" class="form-label">Work Type <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <select class="js-example-basic-single" data-error="#error_work_type_id" name="work_type_id" data-placeholder="Select Work Type">
                                                            <option value="">Select</option>
                                                            @foreach($jobWorkTypes as $jobWorkType)
                                                            <option value="{{ $jobWorkType->id }}" {{ isset($candidateDetails->work_type_id) && $candidateDetails->work_type_id == $jobWorkType->id ? 'selected' : '' }}>{{ $jobWorkType->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error" id="error_work_type_id"></span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-3 col-md-3">
                                                        <label for="inputEmail5" class="form-label">Current Salary <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9">
                                                        <input type="text" class="form-control" name="current_salary" id="current_salary" placeholder="Enter Current Salary" value="{{ isset($candidateDetails->current_salary) && $candidateDetails->current_salary != '' ? $candidateDetails->current_salary : '' }}">
                                                        <span class="error" id="error_current_salary"></span>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Preferred Shift</label>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="morning" name="shift" value="1" {{ isset($candidateDetails->shift) && $candidateDetails->shift == '1' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="morning">Morning</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="evening" name="shift" value="2" {{ isset($candidateDetails->shift) && $candidateDetails->shift == '2' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="evening">Evening</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="any" name="shift" value="3" {{ isset($candidateDetails->shift) && $candidateDetails->shift == '3' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="any">Any</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Availability to Join</label>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <select name="availability_to_join">
                                                                        <option value="">Select</option>
                                                                        <option value="1" {{ isset($candidateDetails->availability_to_join) && $candidateDetails->availability_to_join == '1' ? 'selected' : '' }}>15 Days</option>
                                                                        <option value="2" {{ isset($candidateDetails->availability_to_join) && $candidateDetails->availability_to_join == '2' ? 'selected' : '' }}>1 Month</option>
                                                                        <option value="3" {{ isset($candidateDetails->availability_to_join) && $candidateDetails->availability_to_join == '3' ? 'selected' : '' }}>2 Months</option>
                                                                        <option value="4" {{ isset($candidateDetails->availability_to_join) && $candidateDetails->availability_to_join == '4' ? 'selected' : '' }}>3 Months</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Expected Salary</label>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <input type="text" class="form-control" name="expected_salary" id="expected_salary" placeholder="Enter Expected Salary" value="{{ isset($candidateDetails->expected_salary) && $candidateDetails->expected_salary != '' ? $candidateDetails->expected_salary : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="site-button">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                            <!-- Details -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Job Category</label>
                                        <span class="clearfix font-13">{{ isset($candidateDetails->job_category_id) && $candidateDetails->job_category_id != '' ? $candidateDetails->jobCategory->name : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Role</label>
                                        <span class="clearfix font-13">{{ isset($candidateDetails->designation_id) && $candidateDetails->designation_id != '' ? $candidateDetails->designation->name : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Work Type</label>
                                        <span class="clearfix font-13">{{ isset($candidateDetails->work_type_id) ? $candidateDetails->workType->name : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Availability to Join</label>
                                        <span class="clearfix font-13">{{ isset($candidateDetails->availability_to_join) && $candidateDetails->availability_to_join != '' ? availabilityToJoin($candidateDetails->availability_to_join) : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Job Type</label>
                                        <span class="clearfix font-13">{{ isset($candidateDetails->job_type_id) ? $candidateDetails->jobType->name : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Preferred Shift</label>
                                       <span class="clearfix font-13">
                                        @if(isset($candidateDetails->shift))
                                            @if($candidateDetails->shift == '1')
                                                Morning
                                            @elseif($candidateDetails->shift == '2')
                                                Evening
                                            @else
                                                Any
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Current Salary</label>
                                        <span class="clearfix font-13">{{ isset($candidateDetails->current_salary) && $candidateDetails->current_salary != '' ? $candidateDetails->current_salary.' LPA' : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Expected Salary</label>
                                        <span class="clearfix font-13">{{ isset($candidateDetails->job_category_id) && $candidateDetails->expected_salary != '' ? $candidateDetails->expected_salary.' LPA' : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Details End -->
                        </div>
                        <div id="personal_details_bx" class="job-bx m-b30">
                            <div class="d-flex">
                                <h5 class="m-b30">Personal Details</h5>
                                <!-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#personaldetails" class="site-button add-btn button-sm"><i class="fas fa-pencil-alt m-r5"></i> Edit</a> -->
                            </div>
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info editor" id="personaldetails" tabindex="-1" role="dialog" aria-labelledby="PersonaldetailsModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="PersonaldetailsModalLongTitle">Personal Details</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Date of Birth</label>
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                    <select>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                        <option>6</option>
                                                                        <option>7</option>
                                                                        <option>8</option>
                                                                        <option>9</option>
                                                                        <option>10</option>
                                                                        <option>11</option>
                                                                        <option>12</option>
                                                                        <option>13</option>
                                                                        <option>14</option>
                                                                        <option>15</option>
                                                                        <option>16</option>
                                                                        <option>17</option>
                                                                        <option>18</option>
                                                                        <option>19</option>
                                                                        <option>20</option>
                                                                        <option>21</option>
                                                                        <option>22</option>
                                                                        <option>23</option>
                                                                        <option>24</option>
                                                                        <option>25</option>
                                                                        <option>26</option>
                                                                        <option>27</option>
                                                                        <option>28</option>
                                                                        <option>29</option>
                                                                        <option>30</option>
                                                                        <option>31</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                    <select>
                                                                        <option>january</option>
                                                                        <option>february</option>
                                                                        <option>March</option>
                                                                        <option>April</option>
                                                                        <option>May</option>
                                                                        <option>Jun</option>
                                                                        <option>July</option>
                                                                        <option>August</option>
                                                                        <option>September</option>
                                                                        <option>October</option>
                                                                        <option>November</option>
                                                                        <option>December</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                    <select>
                                                                        <option>2021</option>
                                                                        <option>2020</option>
                                                                        <option>2019</option>
                                                                        <option>2018</option>
                                                                        <option>2017</option>
                                                                        <option>2016</option>
                                                                        <option>2015</option>
                                                                        <option>2014</option>
                                                                        <option>2013</option>
                                                                        <option>2012</option>
                                                                        <option>2011</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="male" name="example1">
                                                                        <label class="form-check-label" for="male">Male</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="female" name="example1">
                                                                        <label class="form-check-label" for="female">Female</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Permanent Address</label>
                                                            <input type="email" class="form-control" placeholder="Enter Your Permanent Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Hometown</label>
                                                            <input type="email" class="form-control" placeholder="Enter Hometown">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Pincode</label>
                                                            <input type="email" class="form-control" placeholder="Enter Pincode">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Marital Status</label>
                                                            <select>
                                                                <option>Married</option>
                                                                <option>Single / Unmarried</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Passport Number</label>
                                                            <input type="email" class="form-control" placeholder="Enter Passport Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>What assistance do you need</label>
                                                            <textarea class="form-control" placeholder="Type Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label>Work Permit for Other Countries</label>
                                                            <select>
                                                                <option>India</option>
                                                                <option>Australia</option>
                                                                <option>Bahrain</option>
                                                                <option>China</option>
                                                                <option>Dubai</option>
                                                                <option>France</option>
                                                                <option>Germany</option>
                                                                <option>Hong Kong</option>
                                                                <option>Kuwait</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="site-button">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                            <!-- Details -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Date of Birth</label>
                                        <span class="clearfix font-13">{{ isset($userDetails->dob) ? date('d/m/Y', strtotime($userDetails->dob)) : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Email</label>
                                        <span class="clearfix font-13">{{ isset($userDetails->email) ? $userDetails->email : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Permanent Address</label>
                                        <span class="clearfix font-13">{{ isset($userDetails->address) ? $userDetails->address.', '.$userDetails->city_name.', '.$userDetails->state_name.', '.$userDetails->country_name.' - '.$userDetails->zip : '--' }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Gender</label>
                                        <span class="clearfix font-13">{{ isset($userDetails->gender) ? getGender($userDetails->gender) : '' }}</span>
                                    </div>
                                    <div class="clearfix m-b20">
                                        <label class="m-b0">Phone</label>
                                        <span class="clearfix font-13">{{ isset($userDetails->phone) ? $userDetails->phone : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Details End -->
                        </div>
                        <div id="attach_resume_bx" class="job-bx m-b30">
                            <form id="uploadResumeForm" class="attach-resume" action="{{ route('updateCandidateDetails') }}" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <h5 class="m-b10">Attach Resume</h5>
                                    @if(!empty($candidateDetails) && !empty($candidateDetails->resume_file))
                                        <a href="{{ route('downloadCandidateResume', $candidateDetails->resume_file) }}" class="site-button add-btn button-sm" download><i class="fas fa-download m-r5"></i> Download Resume</a>
                                    @endif
                                </div>
                                <p>Resume is the most important document recruiters look for. Recruiters generally do not look at profiles without resumes.</p>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <p class="m-auto align-self-center">
                                                    <i class="fa fa-upload"></i>
                                                    Upload Resume File size is 3 MB
                                                </p>
                                                <input type="file" class="site-button form-control" id="customFile" name="resume_file" data-error="#error_resume_file">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-center">
                                    If you do not have a resume document, you may write your brief professional profile <a class="site-button-link" href="javascript:void(0);">here</a>.
                                </p>
                                <span class="error" id="error_resume_file"></span>
                                <div class="col-lg-12 text-right">
                                    <input type="hidden" name="userId" value="{{ isset($userDetails->id) ? $userDetails->id : 0 }}" />
                                    <button type="submit" class="site-button m-b30">Upload Resume</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
<!-- Content END-->
@endsection
@section('script')
<script src="{{ asset('frontend/assets/js/custom-js/candidate.js') }}"></script>
<script>
    $(function() {
        $(".skills-select, .job_tags-select").select2({
            dropdownParent: $('#keyskills'),
            tags: true,
            placeholder: " Enter / Select your skills",
        });

        document.querySelectorAll('ul a[data-page]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                alert(page);
            });
        });

        $("#close").click(function() {
            $('#output').attr('src', "{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}");
            $("#select_img").removeClass('d-none');
            $("#upload_img").addClass('d-none');
            $("#close").addClass('d-none');
        });
    });
</script>
@endsection