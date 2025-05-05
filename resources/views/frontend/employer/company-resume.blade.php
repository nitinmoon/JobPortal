@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="page-content">
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full bg-white p-t50 p-b20">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 m-b30">
                        <div class="sticky-top">
                            @include('frontend.employer.sidebar')
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 m-b30">
                        <div class="job-bx submit-resume">
                            <div class="job-bx-title clearfix">
                                <h5 class="font-weight-700 float-start text-uppercase">Resume</h5>
                                <a href="{{ route('companyManageJobs') }}" class="site-button right-arrow button-sm float-end">Back</a>
                            </div>
                            <ul class="post-job-bx browse-job-grid post-resume row">
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">Ali Tufan</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">Tammy Dixon</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">David kamal</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">John Doe</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">Ali Tufan</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">Tammy Dixon</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">David kamal</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-md-6">
                                    <div class="post-bx">
                                        <div class="d-flex m-b20">
                                            <div class="job-post-info">
                                                <h5 class="m-b0"><a href="jobs-profile.html">John Doe</a></h5>
                                                <p class="m-b5 font-13">
                                                    <a href="javascript:void(0);" class="text-primary">UX / UI Designer </a>
                                                    at Atract Solutions
                                                </p>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>Sacramento, California</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $ 2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="job-time m-t15 m-b10">
                                            <a href="javascript:void(0);"><span>PHP</span></a>
                                            <a href="javascript:void(0);"><span>Angular</span></a>
                                            <a href="javascript:void(0);"><span>Bootstrap</span></a>
                                        </div>
                                        <a href="files/pdf-sample.pdf" target="blank" class="job-links">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <div class="pagination-bx float-end">
                                <ul class="pagination">
                                    <li class="previous"><a href="javascript:void(0);"><i class="ti-arrow-left"></i> Prev</a></li>
                                    <li class="active"><a href="javascript:void(0);">1</a></li>
                                    <li><a href="javascript:void(0);">2</a></li>
                                    <li><a href="javascript:void(0);">3</a></li>
                                    <li class="next"><a href="javascript:void(0);">Next <i class="ti-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
@endsection
@section('script')
<script>
    $(function() {

    });
</script>
@endsection