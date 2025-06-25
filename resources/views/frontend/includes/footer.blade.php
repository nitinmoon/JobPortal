<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12">
                    <div class="widget">
                        <div class="logo-white">
                            <img class="logo m-b15" src="{{ asset('frontend/assets/images/footer-logo.png') }}" width="180" alt="" />
                        </div>
                         <p><span style="font-weight: bold;">Liftale Staffing Service</span> is an established professional recruitment & executive search firm catering to human resource needs of the IT and Non-IT organizations.
                        </p>
                        <!-- <div class="subscribe-form m-b20">
                            <form class="dzSubscribe" action="script/mailchamp.php" method="post">
                                <div class="dzSubscribeMsg"></div>
                                <div class="input-group">
                                    <input name="dzEmail" required="required" class="form-control" placeholder="Your Email Address" type="email">
                                    <span class="input-group-btn">
                                        <button name="submit" value="Submit" type="submit" class="site-button radius-xl">Subscribe</button>
                                    </span>
                                </div>
                            </form>
                        </div> -->
                        <!-- <ul class="list-inline m-a0">
                            <li><a target="_blank" href="https://www.facebook.com/" class="site-button white facebook circle "><i class="fab fa-facebook-f"></i></a></li>
                            <li><a target="_blank" href="https://www.google.com/" class="site-button white google-plus circle "><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a target="_blank" href="https://www.linkedin.com/" class="site-button white linkedin circle "><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a target="_blank" href="https://www.instagram.com/" class="site-button white instagram circle "><i class="fab fa-instagram"></i></a></li>
                            <li><a target="_blank" href="https://twitter.com/" class="site-button white twitter circle "><i class="fab fa-twitter"></i></a></li>
                        </ul> -->
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-8 col-sm-8 col-12">
                    <div class="widget border-0">
                        <h5 class="m-b30 text-white">Main Links</h5>
                        <ul class="list-2 list-line">
                            <li><a href="{{ route('privacy') }}">Privacy & Policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms and Conditions</a></li>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('jobs') }}">Jobs</a></li>
                            <li><a href="{{ route('it') }}">IT Industries</a></li>
                            <li><a href="{{ route('noniit') }}">Non-IT Industries</a></li>
                            <li><a href="{{ route('executive') }}">Executive Search</a></li>
                            <li><a href="{{ route('Permanent') }}">Permanent Staffing</a></li>
                            <li><a href="{{ route('Contract') }}">Contract-to-Hire</a></li>
                            <li><a href="{{ route('client') }}">Client</a></li>
                            <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="widget border-0">
                        <h5 class="m-b30 text-white">Quick Links</h5>
                        <ul class="list-2 w10 list-line">
                            <li><a href="{{ route('candidateRegister') }}">Candidate Register</a></li>
                            <li><a href="{{ route('employerRegister') }}">Employer Register</a></li>
                            <li><a href="{{ route('candidateLogin') }}">Candidate Login</a></li>
                            <li><a href="{{ route('employerLogin') }}">Employer Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <span> Copyright ©{{ date('Y') }} @
                        <a href="https://liftale.com/" target="_blank">Liftale </a> All rights reserved Designed & Maintained by webpixabyte.com</span>
                </div>
            </div>
        </div>
    </div>
</footer>