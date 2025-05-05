
<div class="candidate-info">
    <div class="candidate-detail text-center">
        <div class="canditate-des">
            <form action="{{ route('updateCandidateProfilePhoto') }}" id="updateCandidateProfile" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="profile-wrapper" style="position: relative; display: inline-block;">
                    <a href="javascript:void(0);">
                        <img id="profilePreview" src="{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="Profile Image" style="width: 150px; height: 145px; border-radius: 50%; object-fit: cover;">
                    </a>

                    <label class="upload-link" title="Update" data-bs-toggle="tooltip" data-placement="right" style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.6); border-radius: 50%; color: #fff; cursor: pointer;">
                        <i class="fa fa-camera"></i>
                        <input type="file" id="profileImageInput" name="profile_photo" class="update-file" accept="image/*" style="display: none;">
                    </label>
                </div>

                <button type="submit" id="updateProfileBtn" class="btn btn-primary mt-3 d-none">Update</button>
            </form>
        </div>
        <div class="candidate-title">
            <div class="">
                <h4 class="m-b5"><a href="javascript:void(0);">David Matin</a></h4>
                <p class="m-b0"><a href="javascript:void(0);">Web developer</a></p>
            </div>
        </div>
    </div>
    <ul>
        <li><a href="{{ route('candidateProfile') }}l" class="active">
                <i class="far fa-user" aria-hidden="true"></i>
                <span>Profile</span></a></li>
        <li><a href="{{ route('myResume') }}">
                <i class="far fa-file-alt" aria-hidden="true"></i>
                <span>My Resume</span></a></li>
        <!-- <li><a href="jobs-saved-jobs.html">
                <i class="far fa-heart" aria-hidden="true"></i>
                <span>Saved Jobs</span></a></li>
        <li><a href="jobs-applied-job.html">
                <i class="fa fa-briefcase" aria-hidden="true"></i>
                <span>Applied Jobs</span></a></li>
        <li><a href="jobs-alerts.html">
                <i class="far fa-bell" aria-hidden="true"></i>
                <span>Job Alerts</span></a></li>
        <li><a href="jobs-cv-manager.html">
                <i class="far fa-id-card" aria-hidden="true"></i>
                <span>CV Manager</span></a></li> -->
        <li><a href="{{ route('cadidateChangePassword') }}">
                <i class="fa fa-key" aria-hidden="true"></i>
                <span>Change Password</span></a></li>
        <li><a href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                <span>Log Out</span></a></li>
    </ul>
</div>
