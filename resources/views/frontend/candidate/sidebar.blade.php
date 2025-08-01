
<div class="candidate-info">
    <div class="candidate-detail text-center">
        <div class="canditate-des">
            <form action="{{ route('updateCandidateProfilePhoto') }}" id="updateCandidateProfile" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" id="defaultImg" value="{{ asset(config('constants.DEFAULT_PROFILE')) }}">
                <div class="profile-wrapper position-relative d-inline-block">
                    <img id="profilePreview" src="{{ !empty(Auth::user()->profile_photo) ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents(config('constants.PROFILE_PATH') . '/' . Auth::user()->profile_photo)) : asset(config('constants.DEFAULT_PROFILE')) }}" 
                        alt="Profile Image"
                        class="rounded-circle profile-img">

                    <div class="mt-2 d-flex justify-content-center gap-2">
                        <label class="btn btn-sm btn-outline-primary mb-0">
                            <i class="fa fa-upload"></i> Upload
                            <input type="file" name="profile_photo" id="profileImageInput" data-error="#error_profile_photo" accept="image/*" class="d-none">
                        </label>

                        <button type="button" id="removeProfileImage" class="btn btn-sm btn-outline-danger">
                            <i class="fa fa-times"></i> Remove
                        </button>
                    </div>
                    <span class="error" id="error_profile_photo"></span>
                </div>

                <button type="submit" id="updateProfileBtn" class="btn btn-primary mt-3 d-none">Update</button>
            </form>
        </div>
        <div class="candidate-title">
            <div class="">
                <h4 class="m-b5"><a href="javascript:void(0);">{{ isset($userDetails->first_name) ? $userDetails->first_name.' '.$userDetails->last_name : '' }}</a></h4>
                <p class="m-b0"><a href="javascript:void(0);">{{ isset($userDetails->role_id) ? $userDetails->role->name : '' }}</a></p>
            </div>
        </div>
    </div>
    <ul>
        <li><a href="{{ route('candidateProfile') }}" class="{{ Request::routeIs('candidateProfile') ? 'active' : '' }}">
                <i class="far fa-user" aria-hidden="true"></i>
                <span>Profile</span></a></li>
        <li><a href="{{ route('myResume') }}" class="{{ Request::routeIs('myResume') ? 'active' : '' }}">
                <i class="far fa-file-alt" aria-hidden="true"></i>
                <span>My Resume</span></a></li>
        <!-- <li><a href="jobs-saved-jobs.html">
                <i class="far fa-heart" aria-hidden="true"></i>
                <span>Saved Jobs</span></a></li> -->
        <li><a href="{{ route('appliedJobs') }}" class="{{ Request::routeIs('appliedJobs') ? 'active' : '' }}">
                <i class="fa fa-briefcase" aria-hidden="true"></i>
                <span>Applied Jobs</span></a></li>
        <!-- <li><a href="jobs-alerts.html">
                <i class="far fa-bell" aria-hidden="true"></i>
                <span>Job Alerts</span></a></li> -->
        <!-- <li><a href="jobs-cv-manager.html">
                <i class="far fa-id-card" aria-hidden="true"></i>
                <span>CV Manager</span></a></li> --> 
        <li><a href="{{ route('cadidateChangePassword') }}" class="{{ Request::routeIs('cadidateChangePassword') ? 'active' : '' }}">
                <i class="fa fa-key" aria-hidden="true"></i>
                <span>Change Password</span></a></li>
        <li><a href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                <span>Log Out</span></a></li>
    </ul>
</div>
