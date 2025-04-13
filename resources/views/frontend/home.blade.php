@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="page-content">
    <!-- Section Banner -->
    <div class="dez-bnr-inr dez-bnr-inr-md main-slider" style="background-image:url('{{ asset('frontend/assets/images/main-slider/slide2.jpg') }}');">
        <div class="container">
            <div class="dez-bnr-inr-entry align-m">
                <div class="find-job-bx">
                    <a href="javascript:void(0);" class="site-button button-sm">Find Jobs, Employment & Career Opportunities</a>
                    <h2>Search Between More Then <br /> <span class="text-primary">50,000</span> Open Jobs.</h2>
                    <form class="dezPlaceAni" action="category-all-jobs.html">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Job Title, Keywords, or Phrase</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label>City, State or ZIP</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <select>
                                        <option>Select Sector</option>
                                        <option>Construction</option>
                                        <option>Corodinator</option>
                                        <option>Employer</option>
                                        <option>Financial Career</option>
                                        <option>Information Technology</option>
                                        <option>Marketing</option>
                                        <option>Quality check</option>
                                        <option>Real Estate</option>
                                        <option>Sales</option>
                                        <option>Supporting</option>
                                        <option>Teaching</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <button type="submit" class="site-button btn-block">Find Job</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Section Banner END -->


    <!-- Partners -->
    <div class="section-full content-inner-1 partners bg-white style-1">
        <div class="container">
            <div
                class="our-partners item-center owl-loaded owl-theme owl-carousel owl-none mfp-gallery owl-dots-none">
                <div class="item">
                    <a href="javascript:void(0);" class="partners-media">
                        <img src="{{ asset('frontend/assets/images/svg/partner1.svg') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" class="partners-media">
                        <img src="{{ asset('frontend/assets/images/svg/partner2.svg') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" class="partners-media">
                        <img src="{{ asset('frontend/assets/images/svg/partner3.svg') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" class="partners-media">
                        <img src="{{ asset('frontend/assets/images/svg/partner4.svg') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" class="partners-media">
                        <img src="{{ asset('frontend/assets/images/svg/partner5.svg') }}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" class="partners-media">
                        <img src="{{ asset('frontend/assets/images/svg/partner6.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Partners End-->

    <!-- About Work -->
    <div class="section-full about-work content-inner-1 bg-white">
        <div class="container">
            <div class="section-head text-center style-1">
                <h6>How It Work</h6>
                <h2 class="section-title">Follow Easy 4 Steps</h2>
                <p>It is a long established fact that a reader will be distracted by the
                    readable content of a page when looking at its layout.</p>
            </div>
            <div class="row sp20  about-work-inner">
                <div class="col-lg-3 col-md-6 col-sm-6 m-b20 icon-wrapper">
                    <div class="icon-bx-wraper style-1">
                        <div class="icon-content">
                            <a href="javascript:void(0);" class="icon-box text-white m-b20">
                                <svg width="31" height="32" viewBox="0 0 31 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M30.2807 28.9357L22.7865 21.1419C24.7134 18.8515 25.7691 15.9697 25.7691 12.9695C25.7691 5.96007 20.0659 0.257202 13.056 0.257202C6.04609 0.257202 0.342865 5.96007 0.342865 12.9695C0.342865 19.979 6.04609 25.6819 13.056 25.6819C15.6876 25.6819 18.1954 24.8882 20.3395 23.3815L27.8906 31.2344C28.2062 31.5622 28.6307 31.7429 29.0856 31.7429C29.5162 31.7429 29.9247 31.5788 30.2348 31.2803C30.8937 30.6463 30.9147 29.5951 30.2807 28.9357ZM13.056 3.57347C18.2374 3.57347 22.4527 7.78844 22.4527 12.9695C22.4527 18.1507 18.2374 22.3656 13.056 22.3656C7.87457 22.3656 3.65934 18.1507 3.65934 12.9695C3.65934 7.78844 7.87457 3.57347 13.056 3.57347Z"
                                        fill="white" />
                                </svg>
                            </a>
                            <a href="company-manage-job.html" class="dez-tilte">Search Jobs</a>
                            <p class="dz-text">The standard chunk of used below of those interested.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 m-b20 icon-wrapper">
                    <div class="icon-bx-wraper style-1">
                        <div class="icon-content">
                            <a href="javascript:void(0);" class="icon-box text-white m-b20">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M37.8429 12.621L27.4057 2.18384C27.3186 2.09369 27.2138 2.0224 27.098 1.9744C26.9822 1.92639 26.8577 1.9027 26.7324 1.90479H9.68476C8.67441 1.90479 7.70544 2.30615 6.99102 3.02057C6.2766 3.735 5.87524 4.70396 5.87524 5.71431V38.2857C5.87524 39.2961 6.2766 40.2651 6.99102 40.9795C7.70544 41.6939 8.67441 42.0953 9.68476 42.0953H34.3124C35.3227 42.0953 36.2917 41.6939 37.0061 40.9795C37.7205 40.2651 38.1219 39.2961 38.1219 38.2857V13.2943C38.1211 13.0419 38.0209 12.8 37.8429 12.621ZM34.8705 12.3419H29.1133C28.7345 12.3419 28.3711 12.1914 28.1032 11.9235C27.8353 11.6556 27.6848 11.2922 27.6848 10.9134V5.15622L34.8705 12.3419ZM34.3124 40.1905H9.68762C9.18244 40.1905 8.69796 39.9898 8.34075 39.6326C7.98354 39.2754 7.78286 38.7909 7.78286 38.2857V5.71431C7.78286 5.20914 7.98354 4.72466 8.34075 4.36744C8.69796 4.01023 9.18244 3.80955 9.68762 3.80955H25.7829V10.9134C25.7829 11.7974 26.134 12.6453 26.7592 13.2704C27.3843 13.8955 28.2321 14.2467 29.1162 14.2467H36.22V38.2857C36.22 38.5361 36.1706 38.784 36.0747 39.0153C35.9788 39.2466 35.8383 39.4567 35.6611 39.6336C35.4839 39.8105 35.2736 39.9508 35.0422 40.0463C34.8108 40.1419 34.5628 40.1909 34.3124 40.1905Z"
                                        fill="white" />
                                    <path
                                        d="M18.1743 16.5715C18.9372 16.5715 19.6829 16.3452 20.3172 15.9214C20.9515 15.4976 21.4459 14.8952 21.7378 14.1904C22.0298 13.4856 22.1061 12.71 21.9573 11.9618C21.8085 11.2136 21.4411 10.5263 20.9017 9.98691C20.3623 9.44748 19.675 9.08012 18.9268 8.93129C18.1786 8.78246 17.403 8.85885 16.6982 9.15079C15.9934 9.44272 15.391 9.9371 14.9672 10.5714C14.5434 11.2057 14.3171 11.9515 14.3171 12.7143C14.3184 13.7369 14.7252 14.7173 15.4483 15.4403C16.1714 16.1634 17.1517 16.5702 18.1743 16.5715ZM18.1743 10.7619C18.5604 10.7619 18.9379 10.8764 19.259 11.091C19.58 11.3055 19.8303 11.6104 19.9781 11.9672C20.1258 12.3239 20.1645 12.7165 20.0892 13.0952C20.0138 13.4739 19.8279 13.8218 19.5548 14.0949C19.2818 14.3679 18.9339 14.5539 18.5552 14.6292C18.1765 14.7045 17.7839 14.6659 17.4271 14.5181C17.0704 14.3703 16.7655 14.1201 16.5509 13.799C16.3364 13.4779 16.2219 13.1005 16.2219 12.7143C16.2227 12.1968 16.4286 11.7006 16.7946 11.3346C17.1606 10.9686 17.6567 10.7627 18.1743 10.7619Z"
                                        fill="white" />
                                    <path
                                        d="M12.5924 23.9524C12.845 23.9524 13.0872 23.852 13.2658 23.6734C13.4444 23.4948 13.5448 23.2526 13.5448 23V22.419C13.546 21.4833 13.9183 20.5863 14.5799 19.9247C15.2416 19.263 16.1386 18.8908 17.0743 18.8895H19.2743C20.21 18.8908 21.107 19.263 21.7686 19.9247C22.4303 20.5863 22.8025 21.4833 22.8038 22.419V23C22.8038 23.2526 22.9041 23.4948 23.0828 23.6734C23.2614 23.852 23.5036 23.9524 23.7562 23.9524C24.0088 23.9524 24.251 23.852 24.4296 23.6734C24.6082 23.4948 24.7086 23.2526 24.7086 23V22.419C24.7068 20.9783 24.1337 19.5971 23.115 18.5784C22.0962 17.5596 20.715 16.9865 19.2743 16.9847H17.0743C15.6336 16.9865 14.2524 17.5596 13.2336 18.5784C12.2149 19.5971 11.6418 20.9783 11.64 22.419V23C11.64 23.2526 11.7403 23.4948 11.9189 23.6734C12.0976 23.852 12.3398 23.9524 12.5924 23.9524Z"
                                        fill="white" />
                                    <path
                                        d="M12.0619 30.921H23.6191C23.8716 30.921 24.1139 30.8207 24.2925 30.642C24.4711 30.4634 24.5714 30.2212 24.5714 29.9686C24.5714 29.716 24.4711 29.4738 24.2925 29.2952C24.1139 29.1166 23.8716 29.0162 23.6191 29.0162H12.0619C11.8093 29.0162 11.5671 29.1166 11.3885 29.2952C11.2099 29.4738 11.1095 29.716 11.1095 29.9686C11.1095 30.2212 11.2099 30.4634 11.3885 30.642C11.5671 30.8207 11.8093 30.921 12.0619 30.921Z"
                                        fill="white" />
                                    <path
                                        d="M30.1571 34.0314H12.0619C11.8093 34.0314 11.5671 34.1317 11.3885 34.3103C11.2099 34.4889 11.1095 34.7312 11.1095 34.9838C11.1095 35.2363 11.2099 35.4786 11.3885 35.6572C11.5671 35.8358 11.8093 35.9361 12.0619 35.9361H30.1571C30.4097 35.9361 30.652 35.8358 30.8306 35.6572C31.0092 35.4786 31.1095 35.2363 31.1095 34.9838C31.1095 34.7312 31.0092 34.4889 30.8306 34.3103C30.652 34.1317 30.4097 34.0314 30.1571 34.0314Z"
                                        fill="white" />
                                </svg>
                            </a>
                            <a href="company-manage-job.html" class="dez-tilte">Cv/Resume</a>
                            <p class="dz-text">The standard chunk of used below of those interested.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 m-b20 icon-wrapper">
                    <div class="icon-bx-wraper style-1">
                        <div class="icon-content">
                            <a href="javascript:void(0);" class="icon-box text-white m-b20">
                                <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_27_56)">
                                        <path
                                            d="M25.1269 17.5621C24.4543 17.2424 23.768 16.967 23.0697 16.7363C25.3313 15.0388 26.7969 12.3358 26.7969 9.29688C26.7969 4.17061 22.6263 0 17.5 0C12.3737 0 8.20313 4.17061 8.20313 9.29688C8.20313 12.3391 9.67204 15.0448 11.9378 16.742C9.86187 17.4254 7.91397 18.4889 6.20909 19.8912C3.08288 22.4627 0.909252 26.0494 0.0887347 29.9908C-0.168433 31.2258 0.139662 32.4943 0.933862 33.4709C1.72416 34.4427 2.89605 35 4.14894 35H20.9863C21.7414 35 22.3535 34.3879 22.3535 33.6328C22.3535 32.8777 21.7414 32.2656 20.9863 32.2656H4.14894C3.56529 32.2656 3.21317 31.9398 3.05526 31.7457C2.78257 31.4104 2.67703 30.9739 2.76569 30.5481C4.18449 23.733 10.1957 18.7547 17.1376 18.5868C17.2578 18.5914 17.3786 18.5938 17.5 18.5938C17.6226 18.5938 17.7446 18.5914 17.866 18.5866C19.9933 18.6365 22.0393 19.122 23.953 20.0318C24.635 20.3558 25.4505 20.0659 25.7747 19.3838C26.0989 18.7019 25.8089 17.8863 25.1269 17.5621ZM17.8335 15.851C17.7225 15.849 17.6114 15.848 17.5 15.848C17.3897 15.848 17.2793 15.8491 17.1691 15.8511C13.7037 15.6782 10.9375 12.8045 10.9375 9.29688C10.9375 5.67827 13.8814 2.73438 17.5 2.73438C21.1186 2.73438 24.0625 5.67827 24.0625 9.29688C24.0625 12.8036 21.2977 15.6768 17.8335 15.851Z"
                                            fill="white" />
                                        <path
                                            d="M33.6328 27.1387H29.873V23.3789C29.873 22.6238 29.261 22.0117 28.5059 22.0117C27.7508 22.0117 27.1387 22.6238 27.1387 23.3789V27.1387H23.3789C22.6238 27.1387 22.0117 27.7508 22.0117 28.5059C22.0117 29.261 22.6238 29.873 23.3789 29.873H27.1387V33.6328C27.1387 34.3879 27.7508 35 28.5059 35C29.261 35 29.873 34.3879 29.873 33.6328V29.873H33.6328C34.3879 29.873 35 29.261 35 28.5059C35 27.7508 34.3879 27.1387 33.6328 27.1387Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_27_56">
                                            <rect width="35" height="35" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="company-manage-job.html" class="dez-tilte">Create Account</a>
                            <p class="dz-text">The standard chunk of used below of those interested.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 m-b20 icon-wrapper">
                    <div class="icon-bx-wraper style-1">
                        <div class="icon-content">
                            <a href="javascript:void(0);" class="icon-box text-white m-b20">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M31.6207 16.8638C31.5825 16.334 31.1227 15.9363 30.5921 15.9736C30.0623 16.0118 29.6637 16.4723 29.7018 17.0021C29.7255 17.3294 29.7374 17.6653 29.7374 17.9999C29.7374 25.6683 23.4989 31.9068 15.8306 31.9068C8.1623 31.9068 1.92375 25.6682 1.92375 17.9999C1.92375 10.3317 8.1623 4.09311 15.8306 4.09311C18.8675 4.09311 21.7517 5.05414 24.1711 6.87222C24.5959 7.19129 25.1987 7.10572 25.5179 6.68111C25.8371 6.25642 25.7515 5.65342 25.3268 5.33434C22.5714 3.26385 19.2876 2.16943 15.8306 2.16943C7.10163 2.16936 0 9.271 0 17.9999C0 26.7289 7.10163 33.8304 15.8306 33.8304C24.5597 33.8304 31.6612 26.729 31.6612 17.9999C31.6612 17.6193 31.6474 17.2371 31.6207 16.8638Z"
                                        fill="white" />
                                    <path
                                        d="M34.9028 4.34322C33.4397 2.88022 31.0591 2.88022 29.596 4.34322L15.7367 18.2024L10.8237 13.2893C9.36065 11.8263 6.98001 11.8263 5.51694 13.2893C4.05388 14.7523 4.05388 17.133 5.51694 18.5961L13.9784 27.0575C14.4632 27.5423 15.1 27.7847 15.7367 27.7847C16.3735 27.7847 17.0103 27.5423 17.4951 27.0575L34.9028 9.64984C36.3657 8.18685 36.3657 5.80635 34.9028 4.34322ZM33.5425 8.28965L16.1348 25.6975C15.9154 25.9168 15.5582 25.9168 15.3388 25.6975L6.87735 17.2359C6.16431 16.5229 6.16431 15.3628 6.87735 14.6498C7.23383 14.2931 7.70205 14.115 8.1704 14.115C8.63875 14.115 9.10703 14.2932 9.46344 14.6498L14.5176 19.704C14.8433 20.0296 15.2764 20.2089 15.7368 20.2089C16.1974 20.2089 16.6305 20.0295 16.9561 19.7039L30.9564 5.70348C31.6692 4.99044 32.8295 4.99044 33.5425 5.70348C34.2555 6.41652 34.2555 7.57661 33.5425 8.28965Z"
                                        fill="white" />
                                </svg>
                            </a>
                            <a href="company-manage-job.html" class="dez-tilte">Apply Them</a>
                            <p class="dz-text">The standard chunk of used below of those interested.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="back-circle"></div>
    </div>
    <!-- About Work END -->

    <!-- Job Category -->
    <div class="section-full job-category content-inner-1 bg-white">
        <div class="container">
            <div class="section-head text-center style-1">
                <h6>Jobs Category</h6>
                <h2 class="section-title-3">Choose Your Desire Category </h2>
                <p>There are many variations of passages of available, but the majority have suffered
                    some form, by injected humour, or look even slightly believable.</p>
            </div>
            <div class="row sp20 wrapper-spacing">
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-calculator fa-2x"></i> <!-- Accounting Icon with increased size -->
                            <h5 class="job-name">Accounting</h5>
                            <span>100+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-code fa-2x"></i> <!-- Development Icon with increased size -->
                            <h5 class="job-name">Development</h5>
                            <span>200+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-laptop fa-2x"></i> <!-- Technology Icon with increased size -->
                            <h5 class="job-name">Technology</h5>
                            <span>150+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-newspaper fa-2x"></i> <!-- Media & News Icon with increased size -->
                            <h5 class="job-name">Media & News</h5>
                            <span>100+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-heartbeat fa-2x"></i> <!-- Medical Icon with increased size -->
                            <h5 class="job-name">Medical</h5>
                            <span>110+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-university fa-2x"></i> <!-- Government Icon with increased size -->
                            <h5 class="job-name">Government</h5>
                            <span>250+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-palette fa-2x"></i>
                            <!-- Design & Creative Icon with increased size -->
                            <h5 class="job-name">Design & Creative</h5>
                            <span>150+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-bullhorn fa-2x"></i> <!-- Marketing Icon with increased size -->
                            <h5 class="job-name">Marketing</h5>
                            <span>150+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-phone-alt fa-2x"></i>
                            <!-- Telemarketing Icon with increased size -->
                            <h5 class="job-name">Telemarketing</h5>
                            <span>100+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-laptop-code fa-2x"></i>
                            <!-- Software & Web Icon with increased size -->
                            <h5 class="job-name">Software & Web</h5>
                            <span>200+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-cogs fa-2x"></i> <!-- Engineering Icon with increased size -->
                            <h5 class="job-name">Engineering</h5>
                            <span>250+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 m-b20 job-wraper">
                    <a href="company-manage-job.html" class="job-bx-wraper">
                        <div class="icon-content">
                            <i class="fa fa-chalkboard-teacher fa-2x"></i>
                            <!-- Teaching & Education Icon with increased size -->
                            <h5 class="job-name">Teaching & Education</h5>
                            <span>150+ Posted New Jobs</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <!-- Job Category END -->
    <!-- inner page banner END -->
    <div class="content-block">
        <div class="section-full content-inner">
            <div class="container">
                <div class="row align-items-center m-b50">
                    <div class="col-md-12 col-lg-6 m-b20">
                        <h2 class="m-b5">About Us</h2>
                        <h3 class="fw4">We create unique experiences</h3>
                        <p class="m-b15">Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type and. It is a long established
                            fact that a reader will be distracted by the readable content of a page when looking
                            at its layout. The point of using Lorem Ipsum is that it has a more-or-less.</p>
                        <p class="m-b15">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The point of using Lorem
                            Ipsum is that it has a more-or-less.</p>
                        <a href="javascript:void(0);" class="site-button">Read More</a>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <img src="{{ asset('frontend/assets/images/our-work/pic1.jpg') }}" alt="" />
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Why Chose Us -->
    <div class="section-full content-inner-2 call-to-action overlay-black-dark text-white text-center bg-img-fix" style="background-image: url('{{ asset('frontend/assets/images/background/bg4.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="m-b10">Make a Difference with Your Online Resume!</h2>
                    <p class="m-b0">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
                    <a href="register.html" class="site-button m-t20 outline outline-2 radius-xl">Create an Account</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Latest Blog -->
    <div class="section-full content-inner-2 bg-white">
        <div class="container">
            <div class="section-head text-black text-center">
                <h2 class="text-uppercase m-b0">Our Latest Blog</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                    been the industry's standard dummy.</p>
            </div>
            <div
                class="blog-carousel owl-carousel owl-btn-center-lr owl-btn-3 owl-theme owl-btn-center-lr owl-btn-1">
                <div class="item">
                    <div class="blog-post blog-grid blog-style-1">
                        <div class="dez-post-media dez-img-effect radius-sm"> <a href="blog-details.html"><img
                                    src="{{ asset('frontend/assets/images/blog/grid/pic4.jpg') }}" alt=""></a> </div>
                        <div class="dez-info">
                            <div class="dez-post-meta">
                                <ul class="d-flex align-items-center">
                                    <li class="post-date"><i class="fa fa-calendar"></i>September 18, 2021</li>
                                    <li class="post-comment"><i class="far fa-comments"></i><a href="#">5k</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dez-post-title ">
                                <h5 class="post-title font-20"><a href="blog-details.html">Do you have a job
                                        that the average person doesn even know exists?</a></h5>
                            </div>
                            <div class="dez-post-text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy.</p>
                            </div>
                            <div class="dez-post-readmore blog-share">
                                <a href="blog-details.html" title="READ MORE" rel="bookmark"
                                    class="site-button-link"><span class="fw6">READ MORE</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="blog-post blog-grid blog-style-1">
                        <div class="dez-post-media dez-img-effect radius-sm"> <a href="blog-details.html"><img
                                    src="{{ asset('frontend/assets/images/blog/grid/pic3.jpg') }}" alt=""></a> </div>
                        <div class="dez-info">
                            <div class="dez-post-meta">
                                <ul class="d-flex align-items-center">
                                    <li class="post-date"><i class="fa fa-calendar"></i>September 18, 2021</li>
                                    <li class="post-comment"><i class="far fa-comments"></i><a href="#">5k</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dez-post-title ">
                                <h5 class="post-title font-20"><a href="blog-details.html">Do you have a job
                                        that the average person doesn even know exists?</a></h5>
                            </div>
                            <div class="dez-post-text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy.</p>
                            </div>
                            <div class="dez-post-readmore blog-share">
                                <a href="blog-details.html" title="READ MORE" rel="bookmark"
                                    class="site-button-link"><span class="fw6">READ MORE</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="blog-post blog-grid blog-style-1">
                        <div class="dez-post-media dez-img-effect radius-sm"> <a href="blog-details.html"><img
                                    src="{{ asset('frontend/assets/images/blog/grid/pic2.jpg') }}" alt=""></a> </div>
                        <div class="dez-info">
                            <div class="dez-post-meta">
                                <ul class="d-flex align-items-center">
                                    <li class="post-date"><i class="fa fa-calendar"></i>September 18, 2021</li>
                                    <li class="post-comment"><i class="far fa-comments"></i><a href="#">5k</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dez-post-title ">
                                <h5 class="post-title font-20"><a href="blog-details.html">Do you have a job
                                        that the average person doesn even know exists?</a></h5>
                            </div>
                            <div class="dez-post-text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy.</p>
                            </div>
                            <div class="dez-post-readmore blog-share">
                                <a href="blog-details.html" title="READ MORE" rel="bookmark"
                                    class="site-button-link"><span class="fw6">READ MORE</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="blog-post blog-grid blog-style-1">
                        <div class="dez-post-media dez-img-effect radius-sm"> <a href="blog-details.html"><img
                                    src="{{ asset('frontend/assets/images/blog/grid/pic1.jpg') }}" alt=""></a> </div>
                        <div class="dez-info">
                            <div class="dez-post-meta">
                                <ul class="d-flex align-items-center">
                                    <li class="post-date"><i class="fa fa-calendar"></i>September 18, 2021</li>
                                    <li class="post-comment"><i class="far fa-comments"></i><a href="#">5k</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dez-post-title ">
                                <h5 class="post-title font-20"><a href="blog-details.html">Do you have a job
                                        that the average person doesn even know exists?</a></h5>
                            </div>
                            <div class="dez-post-text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy.</p>
                            </div>
                            <div class="dez-post-readmore blog-share">
                                <a href="blog-details.html" title="READ MORE" rel="bookmark"
                                    class="site-button-link"><span class="fw6">READ MORE</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Latest Blog -->


    <!-- Latest jobs -->
    <div class="section-full latest-jobs content-inner-1 ">
        <div class="container">
            <div class="latest-jobs-inner">
                <div class="section-head style-1">
                    <h6>Latest Job</h6>
                    <h2 class="section-title-3">New Job Offer</h2>
                    <p class="dz-text-2">More Than +500 Job Offer Everyday</p>
                </div>
                <a href="javascript:void(0);" class="site-button style-1">View More..</a>
            </div>
            <div class="row sp20 m-b20">
                <div class="col-xl-4 col-md-6">
                    <div class="job-wrapper m-b20">
                        <div class="jobs-profile d-flex align-items-center">
                            <div class="dz-icon"><img src="{{ asset('frontend/assets/images/icons/google.png') }}" alt=""></div>
                            <div class="Profile-inner">
                                <h5 class="profile-name">Google , New York</h5>
                                <span class="profile-positions">Sr. Product Designer</span>
                            </div>
                        </div>
                        <div class="Profile-inner-2">
                            <p>It is a long established fact that a reader
                                of a page when looking at its layout.</p>
                            <div class="dz-buttons d-flex align-items-center">
                                <a href="javascript:void(0);" class="site-button style-1">Apply Now</a>
                                <div class="dz-salary"><span>$560</span>/ Hour</div>
                            </div>
                        </div>
                        <div class="dz-timing"><span>2 Day ago</span><a href="javascript:void(0);">Full Time</a></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="job-wrapper m-b20">
                        <div class="jobs-profile d-flex align-items-center">
                            <div class="dz-icon"><img src="{{ asset('frontend/assets/images/icons/microsoft.png') }}" alt=""></div>
                            <div class="Profile-inner">
                                <h5 class="profile-name">Microsoft , California</h5>
                                <span class="profile-positions">Web Designer</span>
                            </div>
                        </div>
                        <div class="Profile-inner-2">
                            <p>It is a long established fact that a reader
                                of a page when looking at its layout.</p>
                            <div class="dz-buttons d-flex align-items-center">
                                <a href="javascript:void(0);" class="site-button style-1">Apply Now</a>
                                <div class="dz-salary"><span>$560</span>/ Hour</div>
                            </div>
                        </div>
                        <div class="dz-timing"><span>1 Day ago</span><a href="javascript:void(0);">Full Time</a></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="job-wrapper m-b20">
                        <div class="jobs-profile d-flex align-items-center">
                            <div class="dz-icon"><img src="{{ asset('frontend/assets/images/icons/amazon.png') }}" alt=""></div>
                            <div class="Profile-inner">
                                <h5 class="profile-name">Amazon , Southfield</h5>
                                <span class="profile-positions">IT Management</span>
                            </div>
                        </div>
                        <div class="Profile-inner-2">
                            <p>It is a long established fact that a reader
                                of a page when looking at its layout.</p>
                            <div class="dz-buttons d-flex align-items-center">
                                <a href="javascript:void(0);" class="site-button style-1">Apply Now</a>
                                <div class="dz-salary"><span>$560</span>/ Hour</div>
                            </div>
                        </div>
                        <div class="dz-timing"><span>2 Day ago</span><a href="javascript:void(0);">Full Time</a></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="job-wrapper m-b20">
                        <div class="jobs-profile d-flex align-items-center">
                            <div class="dz-icon"><img src="{{ asset('frontend/assets/images/icons/github.png') }}" alt=""></div>
                            <div class="Profile-inner">
                                <h5 class="profile-name">Github , Southfield</h5>
                                <span class="profile-positions">Sr. Product Designer</span>
                            </div>
                        </div>
                        <div class="Profile-inner-2">
                            <p>It is a long established fact that a reader
                                of a page when looking at its layout.</p>
                            <div class="dz-buttons d-flex align-items-center">
                                <a href="javascript:void(0);" class="site-button style-1">Apply Now</a>
                                <div class="dz-salary"><span>$560</span>/ Hour</div>
                            </div>
                        </div>
                        <div class="dz-timing"><span>2 Day ago</span><a href="javascript:void(0);">Full Time</a></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="job-wrapper m-b20">
                        <div class="jobs-profile d-flex align-items-center">
                            <div class="dz-icon"><img src="{{ asset('frontend/assets/images/icons/dropbox.png') }}" alt=""></div>
                            <div class="Profile-inner">
                                <h5 class="profile-name">Dropbox , New York</h5>
                                <span class="profile-positions">Web Designer</span>
                            </div>
                        </div>
                        <div class="Profile-inner-2">
                            <p>It is a long established fact that a reader
                                of a page when looking at its layout.</p>
                            <div class="dz-buttons d-flex align-items-center">
                                <a href="javascript:void(0);" class="site-button style-1">Apply Now</a>
                                <div class="dz-salary"><span>$560</span>/ Hour</div>
                            </div>
                        </div>
                        <div class="dz-timing"><span>1 Day ago</span><a href="javascript:void(0);">Full Time</a></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="job-wrapper m-b20">
                        <div class="jobs-profile d-flex align-items-center">
                            <div class="dz-icon"><img src="{{ asset('frontend/assets/images/icons/adobe.png') }}" alt=""></div>
                            <div class="Profile-inner">
                                <h5 class="profile-name">Adobe , California</h5>
                                <span class="profile-positions">IT Management</span>
                            </div>
                        </div>
                        <div class="Profile-inner-2">
                            <p>It is a long established fact that a reader
                                of a page when looking at its layout.</p>
                            <div class="dz-buttons d-flex align-items-center">
                                <a href="javascript:void(0);" class="site-button style-1">Apply Now</a>
                                <div class="dz-salary"><span>$560</span>/ Hour</div>
                            </div>
                        </div>
                        <div class="dz-timing"><span>2 Day ago</span><a href="javascript:void(0);">Full Time</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Latest jobs END -->

    <!-- Reviews Testimonial -->
    <div class="section-full content-inner-2 testimonials bg-white">
        <div class="container">
            <div class="section-head style-1 text-center">
                <h6>Clents Testimonials</h6>
                <h2 class="section-title-3">What A Job Holder Says About Us</h2>
                <p class="dz-text-2">There are many variations of passages of available, but the majority have suffered
                    some form, by injected humour, or look even slightly believable.</p>
            </div>
            <div class="review-testimonial owl-carousel owl-btn-center-lr owl-btn-3 owl-theme owl-btn-center-lr owl-btn-1 owl-dots-none">
                <div class="item">
                    <div class="testimonial-wrapper">
                        <div class="testimonial-inner">
                            <div class="bg-img">
                                <svg width="64" height="46" viewBox="0 0 64 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M50.6293 17.2257C50.5004 15.8322 50.599 12.0441 54.2279 6.77654C54.5024 6.37904 54.4526 5.84295 54.1117 5.50214C52.6322 4.02264 51.7162 3.08904 51.0737 2.43575C50.2289 1.57434 49.8432 1.18184 49.2787 0.670045C48.9018 0.331244 48.3315 0.325345 47.9506 0.657445C41.6254 6.16134 34.6 17.5343 35.6166 31.4679C36.2123 39.6495 42.1801 45.588 49.8061 45.588C57.6322 45.588 63.9994 39.2218 63.9994 31.3956C63.9994 23.8458 58.0737 17.6544 50.6293 17.2257ZM49.8061 43.588C43.2572 43.588 38.1293 38.4298 37.6108 31.3234C36.4672 15.6525 45.7826 5.47284 48.5971 2.77754C48.8715 3.04805 49.185 3.36634 49.6469 3.83704C50.2035 4.40345 50.9653 5.17884 52.1176 6.33514C47.7123 13.1222 48.5434 17.9581 48.9076 18.6515C49.0805 18.9806 49.435 19.2023 49.8061 19.2023C56.5297 19.2023 61.9994 24.672 61.9994 31.3956C61.9994 38.1183 56.5297 43.588 49.8061 43.588Z" fill="#2E55FA" />
                                    <path d="M15.1137 17.2257C14.9838 15.8361 15.0795 12.0509 18.7123 6.77654C18.9858 6.37904 18.9369 5.84294 18.5961 5.50214C17.1195 4.02554 16.2045 3.09294 15.5629 2.43964C14.7153 1.57634 14.3285 1.18274 13.7641 0.670039C13.3871 0.331239 12.8168 0.326339 12.436 0.656439C6.11077 6.16034 -0.915635 17.5314 0.0989652 31.4679C0.696665 39.6485 6.66537 45.588 14.2914 45.588C22.1176 45.588 28.4848 39.2218 28.4848 31.3956C28.4848 23.8449 22.559 17.6525 15.1137 17.2257ZM14.2914 43.588C7.74357 43.588 2.61267 38.4298 2.09316 31.3224C0.952565 15.6476 10.268 5.47184 13.0824 2.77754C13.3578 3.04804 13.6723 3.36834 14.1352 3.84004C14.6908 4.40644 15.4516 5.18084 16.602 6.33514C12.1967 13.1232 13.0278 17.9581 13.392 18.6505C13.5649 18.9796 13.9203 19.2023 14.2914 19.2023C21.0151 19.2023 26.4848 24.672 26.4848 31.3956C26.4848 38.1183 21.0151 43.588 14.2914 43.588Z" fill="#2E55FA" />
                                </svg>
                            </div>
                            <div class="testimonial-pic style-1">
                                <div class="testimonial-pic-circle"></div>
                                <div class="profile-pic">
                                    <img src="{{ asset('frontend/assets/images/testimonials/pic4.png') }}" alt="">
                                </div>
                            </div>
                            <div class="profile-info">
                                <h5 class="profile-name">Andnew Smith</h5>
                                <span>One Year With Us</span>
                            </div>
                            <p class="dz-text-3">It is a long established fact that a reader
                                will be distracted by readable content
                                of a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-wrapper">
                        <div class="testimonial-inner">
                            <div class="bg-img">
                                <svg width="64" height="46" viewBox="0 0 64 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M50.6293 17.2257C50.5004 15.8322 50.599 12.0441 54.2279 6.77654C54.5024 6.37904 54.4526 5.84295 54.1117 5.50214C52.6322 4.02264 51.7162 3.08904 51.0737 2.43575C50.2289 1.57434 49.8432 1.18184 49.2787 0.670045C48.9018 0.331244 48.3315 0.325345 47.9506 0.657445C41.6254 6.16134 34.6 17.5343 35.6166 31.4679C36.2123 39.6495 42.1801 45.588 49.8061 45.588C57.6322 45.588 63.9994 39.2218 63.9994 31.3956C63.9994 23.8458 58.0737 17.6544 50.6293 17.2257ZM49.8061 43.588C43.2572 43.588 38.1293 38.4298 37.6108 31.3234C36.4672 15.6525 45.7826 5.47284 48.5971 2.77754C48.8715 3.04805 49.185 3.36634 49.6469 3.83704C50.2035 4.40345 50.9653 5.17884 52.1176 6.33514C47.7123 13.1222 48.5434 17.9581 48.9076 18.6515C49.0805 18.9806 49.435 19.2023 49.8061 19.2023C56.5297 19.2023 61.9994 24.672 61.9994 31.3956C61.9994 38.1183 56.5297 43.588 49.8061 43.588Z" fill="#2E55FA" />
                                    <path d="M15.1137 17.2257C14.9838 15.8361 15.0795 12.0509 18.7123 6.77654C18.9858 6.37904 18.9369 5.84294 18.5961 5.50214C17.1195 4.02554 16.2045 3.09294 15.5629 2.43964C14.7153 1.57634 14.3285 1.18274 13.7641 0.670039C13.3871 0.331239 12.8168 0.326339 12.436 0.656439C6.11077 6.16034 -0.915635 17.5314 0.0989652 31.4679C0.696665 39.6485 6.66537 45.588 14.2914 45.588C22.1176 45.588 28.4848 39.2218 28.4848 31.3956C28.4848 23.8449 22.559 17.6525 15.1137 17.2257ZM14.2914 43.588C7.74357 43.588 2.61267 38.4298 2.09316 31.3224C0.952565 15.6476 10.268 5.47184 13.0824 2.77754C13.3578 3.04804 13.6723 3.36834 14.1352 3.84004C14.6908 4.40644 15.4516 5.18084 16.602 6.33514C12.1967 13.1232 13.0278 17.9581 13.392 18.6505C13.5649 18.9796 13.9203 19.2023 14.2914 19.2023C21.0151 19.2023 26.4848 24.672 26.4848 31.3956C26.4848 38.1183 21.0151 43.588 14.2914 43.588Z" fill="#2E55FA" />
                                </svg>
                            </div>
                            <div class="testimonial-pic style-1">
                                <div class="testimonial-pic-circle"></div>
                                <div class="profile-pic">
                                    <img src="{{ asset('frontend/assets/images/testimonials/pic5.png') }}" alt="">
                                </div>
                            </div>
                            <div class="profile-info">
                                <h5 class="profile-name">Max Makina</h5>
                                <span>One Year With Us</span>
                            </div>
                            <p class="dz-text-3">It is a long established fact that a reader
                                will be distracted by readable content
                                of a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-wrapper">
                        <div class="testimonial-inner">
                            <div class="bg-img">
                                <svg width="64" height="46" viewBox="0 0 64 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M50.6293 17.2257C50.5004 15.8322 50.599 12.0441 54.2279 6.77654C54.5024 6.37904 54.4526 5.84295 54.1117 5.50214C52.6322 4.02264 51.7162 3.08904 51.0737 2.43575C50.2289 1.57434 49.8432 1.18184 49.2787 0.670045C48.9018 0.331244 48.3315 0.325345 47.9506 0.657445C41.6254 6.16134 34.6 17.5343 35.6166 31.4679C36.2123 39.6495 42.1801 45.588 49.8061 45.588C57.6322 45.588 63.9994 39.2218 63.9994 31.3956C63.9994 23.8458 58.0737 17.6544 50.6293 17.2257ZM49.8061 43.588C43.2572 43.588 38.1293 38.4298 37.6108 31.3234C36.4672 15.6525 45.7826 5.47284 48.5971 2.77754C48.8715 3.04805 49.185 3.36634 49.6469 3.83704C50.2035 4.40345 50.9653 5.17884 52.1176 6.33514C47.7123 13.1222 48.5434 17.9581 48.9076 18.6515C49.0805 18.9806 49.435 19.2023 49.8061 19.2023C56.5297 19.2023 61.9994 24.672 61.9994 31.3956C61.9994 38.1183 56.5297 43.588 49.8061 43.588Z" fill="#2E55FA" />
                                    <path d="M15.1137 17.2257C14.9838 15.8361 15.0795 12.0509 18.7123 6.77654C18.9858 6.37904 18.9369 5.84294 18.5961 5.50214C17.1195 4.02554 16.2045 3.09294 15.5629 2.43964C14.7153 1.57634 14.3285 1.18274 13.7641 0.670039C13.3871 0.331239 12.8168 0.326339 12.436 0.656439C6.11077 6.16034 -0.915635 17.5314 0.0989652 31.4679C0.696665 39.6485 6.66537 45.588 14.2914 45.588C22.1176 45.588 28.4848 39.2218 28.4848 31.3956C28.4848 23.8449 22.559 17.6525 15.1137 17.2257ZM14.2914 43.588C7.74357 43.588 2.61267 38.4298 2.09316 31.3224C0.952565 15.6476 10.268 5.47184 13.0824 2.77754C13.3578 3.04804 13.6723 3.36834 14.1352 3.84004C14.6908 4.40644 15.4516 5.18084 16.602 6.33514C12.1967 13.1232 13.0278 17.9581 13.392 18.6505C13.5649 18.9796 13.9203 19.2023 14.2914 19.2023C21.0151 19.2023 26.4848 24.672 26.4848 31.3956C26.4848 38.1183 21.0151 43.588 14.2914 43.588Z" fill="#2E55FA" />
                                </svg>
                            </div>
                            <div class="testimonial-pic style-1">
                                <div class="testimonial-pic-circle"></div>
                                <div class="profile-pic">
                                    <img src="{{ asset('frontend/assets/images/testimonials/pic3.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="profile-info">
                                <h5 class="profile-name">Makima Smith</h5>
                                <span>One Year With Us</span>
                            </div>
                            <p class="dz-text-3">It is a long established fact that a reader
                                will be distracted by readable content
                                of a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reviews Testimonial END -->
</div>
@endsection
@section('script')
<script>
    $(function() {
    });
</script>
@endsection