@extends('frontend.layouts.app')

@section('title', 'Jobs')

@section('content')
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Contact Us</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
                <!-- Breadcrumb row END -->
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- Filters Search -->
    <!-- <div class="section-full browse-job-find">
        <div class="container">
            <div class="find-job-bx">
                <form class="dezPlaceAni">
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
    </div> -->
    <!-- Filters Search END -->
    <!-- contact area -->
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    <!-- right part start -->
                    <div class="col-lg-4 col-md-6 d-lg-flex d-md-flex">
                        <div class="p-a30 border-1  m-b30 contact-area border-1 align-self-stretch radius-sm">
                            <h4 class="m-b10">Quick Contact</h4>
                            <p>If you have any questions simply use the following contact details.</p>
                            <ul class="no-margin">
                                <li class="icon-bx-wraper left m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-location-pin"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">Address:</h6>
                                        <p>123 West Street, pune, India</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left  m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-email"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">Email:</h6>
                                        <p>info@liftale.com</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-mobile"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">PHONE</h6>
                                        <p>+91 222 333 4444</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="m-t20">
                                <ul class="dez-social-icon dez-social-icon-lg">
                                    <li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f bg-primary"></a></li>
                                    <li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter bg-primary"></a></li>
                                    <li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in bg-primary"></a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/" class="fab fa-instagram bg-primary"></a></li>
                                    <li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g bg-primary"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- right part END -->
                    <!-- Left part start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="p-a30 m-b30 radius-sm bg-gray clearfix">
                            <h4>Send Message Us</h4>
                            <div class="dzFormMsg"></div>
                            <form id="contact-form" action="{{ route('saveContact') }}" method="post">
                                @csrf
                                <!-- <input type="hidden" value="Contact" name="dzToDo"> -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="name" type="text" class="form-control" data-error="#error_name" placeholder="Your Name" >
                                            </div>
                                            <span class="error" id="error_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="email" type="email" class="form-control" data-error="#error_email" placeholder="Your Email Address">
                                            </div>
                                            <span class="error" id="error_email"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="message" rows="4" class="form-control" data-error="#error_message" placeholder="Your Message..."></textarea>
                                            </div>
                                            <span class="error" id="error_message"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="recaptcha-bx">
                                            <div class="input-group">
                                               <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                            </div>
                                            <span id="captchaError" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button name="submit" type="submit" value="Submit" class="site-button "> Submit </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Left part END -->
                    <div class="col-lg-4 col-md-12 d-lg-flex m-b30">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.3825624477!2d75.65046970649679!3d26.88544791796718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1500819483219" class="align-self-stretch radius-sm" style="border:0; width:100%; min-height:350px;" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('frontend/assets/js/custom-js/contact.js') }}"></script>
@endsection
