<div class="candidate-info company-info">
        <div class="candidate-detail text-center">
                <form action="{{ route('updateUserProfileImage', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" id="updateUserProfileImg">
                @csrf
                        <div class="canditate-des">
                                <a href="javascript:void(0);">
                                        <img alt="" src="{{ asset('frontend/assets/images/logo/icon3.jpg') }}" id="output">
                                </a>
                                <div class="upload-link" title="update" data-bs-toggle="tooltip" data-placement="right">
                                        <input type="file" name="profile_photo" accept="image/jpg, image/jpeg, image/png" id="profile_photo">
                                        <i class="fas fa-pencil-alt"></i>
                                </div>
                                <div class="col-md-12 text-center mt-2">
                                        <button type="submit" id="upload_img" class="btn btn-info btn-sm d-none p-2"><i class="bi bi-upload" aria-hidden="true"></i></button>
                                        <button type="button" id="close" class="btn btn-danger btn-sm d-none p-2"><i class="bi bi-x" aria-hidden="true"></i></button>
                                        <span id="imageUplaoderro" class="badge bg-danger mt-3"></span>
                                </div>
                        </div>
                        <div class="candidate-title">
                                <h4 class="m-b5"><a href="javascript:void(0);">@COMPANY</a></h4>
                        </div>
                </form>
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
                <li><a href="{{ route('companyTransactions') }}" class="{{ (Request::routeIs('companyTransactions')) ? 'active' : '' }}">
                                <i class="fa fa-random" aria-hidden="true"></i>
                                <span>Transactions</span></a></li>
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
@section('script')
<script>
</script>
@endsection