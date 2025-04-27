@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="page-content bg-white">
    <!-- contact area -->
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full bg-white browse-job p-t50 p-b20">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 m-b30">
                        <div class="sticky-top">
                            <div class="candidate-info">
                                <div class="candidate-detail text-center">
                                    <div class="canditate-des">
                                        <a href="javascript:void(0);">
                                            <img alt="" src="images/team/pic1.jpg">
                                        </a>
                                        <div class="upload-link" title="update" data-bs-toggle="tooltip" data-placement="right">
                                            <input type="file" class="update-flie">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </div>
                                    <div class="candidate-title">
                                        <div class="">
                                            <h4 class="m-b5"><a href="javascript:void(0);">David Matin</a></h4>
                                            <p class="m-b0"><a href="javascript:void(0);">Web developer</a></p>
                                        </div>
                                    </div>
                                </div>
                                <ul>
                                    <li><a href="jobs-profile.html" class="active">
                                            <i class="far fa-user" aria-hidden="true"></i>
                                            <span>Profile</span></a></li>
                                    <li><a href="jobs-my-resume.html">
                                            <i class="far fa-file-alt" aria-hidden="true"></i>
                                            <span>My Resume</span></a></li>
                                    <li><a href="jobs-saved-jobs.html">
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
                                            <span>CV Manager</span></a></li>
                                    <li><a href="jobs-change-password.html">
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                            <span>Change Password</span></a></li>
                                    <li><a href="index.html">
                                            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                            <span>Log Out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 m-b30">
                        <div class="job-bx job-profile">
                            <div class="job-bx-title clearfix">
                                <h5 class="font-weight-700 float-start text-uppercase">Basic Information</h5>
                                <a href="index.html" class="site-button right-arrow button-sm float-end">Back</a>
                            </div>
                            <form>
                                <div class="row m-b30">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Your Name:</label>
                                            <input type="text" class="form-control" placeholder="Alexander Weir">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Professional title:</label>
                                            <input type="text" class="form-control" placeholder="Web Designer">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Languages:</label>
                                            <input type="text" class="form-control" placeholder="English">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Age:</label>
                                            <input type="text" class="form-control" placeholder="32 Year">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Current Salary($):</label>
                                            <input type="text" class="form-control" placeholder="2000$">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Expected Salary:</label>
                                            <input type="text" class="form-control" placeholder="2500$">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <textarea class="form-control">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="job-bx-title clearfix">
                                    <h5 class="font-weight-700 float-start text-uppercase">Contact Information</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Phone:</label>
                                            <input type="text" class="form-control" placeholder="+1 123 456 7890">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Email Address:</label>
                                            <input type="text" class="form-control" placeholder="info@example.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Country:</label>
                                            <input type="text" class="form-control" placeholder="Country Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Postcode:</label>
                                            <input type="text" class="form-control" placeholder="112233">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>City:</label>
                                            <input type="text" class="form-control" placeholder="London">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Full Address:</label>
                                            <input type="text" class="form-control" placeholder="New york City">
                                        </div>
                                    </div>
                                </div>
                                <button class="site-button m-b30">Save Setting</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
@endsection