<div class="candidate-info company-info">
        <div class="candidate-detail text-center">
                <div class="canditate-des">
                        <form action="{{ route('updateCompanyLogo') }}" id="updateCompanyLogo" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php
                                $logo = getCompanyLogo(Auth::user()->id);
                                @endphp
                                <div class="profile-wrapper" style="position: relative; display: inline-block;">
                                        <a href="javascript:void(0);">
                                                <img id="logoPreview" src="{{ !empty($logo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.COMPANY_LOGO_PATH').'/'.$logo))  : asset(config('constants.DEFAULT_COMPANY_LOGO')) }}" alt="Profile Image" style="width: 150px; height: 145px; border-radius: 50%; object-fit: cover;">
                                        </a>
                                        <label class="upload-link" title="Update" data-bs-toggle="tooltip" data-placement="right" style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.6); border-radius: 50%; color: #fff; cursor: pointer;">
                                                <i class="fa fa-camera"></i>
                                                <input type="file" id="logoImageInput" name="company_logo" class="update-file" accept="image/*" style="display: none;">
                                        </label>
                                </div>

                                <button type="submit" id="updateLogoBtn" class="btn btn-primary mt-3 d-none">Update</button>
                        </form>
                </div>
        </div>
        <ul>
                <li><a href="{{ route('myProfile') }}" class="{{ (Request::routeIs('myProfile')) ? 'active' : '' }}">
                                <i class="far fa-user" aria-hidden="true"></i>
                                <span>My Profile</span></a></li>
                <li><a href="{{ route('companyProfile') }}" class="{{ (Request::routeIs('companyProfile')) ? 'active' : '' }}">
                                <i class="far fa-user" aria-hidden="true"></i>
                                <span>Company Profile</span></a></li>
                <li><a href="{{ route('companyJobPost') }}" class="{{ (Request::routeIs('companyJobPost')) ? 'active' : '' }}">
                                <i class="far fa-file-alt" aria-hidden="true"></i>
                                <span>Post A Job</span></a></li>
                <!-- <li><a href="{{ route('companyTransactions') }}" class="{{ (Request::routeIs('companyTransactions')) ? 'active' : '' }}">
                                <i class="fa fa-random" aria-hidden="true"></i>
                                <span>Transactions</span></a></li> -->
                <li><a href="{{ route('companyManageJobs') }}" class="{{ (Request::routeIs('companyManageJobs')) ? 'active' : '' }}">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span>Manage jobs</span></a></li>
                <li><a href="{{ route('companyResume') }}" class="{{ (Request::routeIs('companyResume')) ? 'active' : '' }}">
                                <i class="far fa-id-card" aria-hidden="true"></i>
                                <span>Resume</span></a></li>
                <li><a href="{{ route('employerChangePassword') }}" class="{{ (Request::routeIs('employerChangePassword')) ? 'active' : '' }}">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <span>Change Password</span></a></li>
                <li><a href="index.html">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span>Log Out</span></a></li>
        </ul>
</div>