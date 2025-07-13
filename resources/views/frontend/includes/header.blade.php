<header class="site-header mo-left header fullwidth">
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container clearfix">
                <!-- Website Logo -->
                <div class="logo-header mostion logo-dark">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a>
                </div>

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Extra Nav -->
                <div class="extra-nav text-end">
                    <div class="extra-cell">
                        @if(isset(auth()->user()->id))
                        <nav class="header-nav ms-auto mt-2">
                            <ul class="d-flex">
                                <li class="nav-item dropdown pe-3" style="list-style: none !important;">
                                    <a class="nav-link nav-profile d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::EMPLOYER)
                                            <img src="{{ !empty(getCompanyDetails(auth()->user()->id)['company_logo']) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.COMPANY_LOGO_PATH').'/'.getCompanyDetails(Auth::user()->id)['company_logo']))  : asset(config('constants.DEFAULT_COMPANY_LOGO')) }}" alt="Profile" class="rounded-circle">
                                        @else
                                            <img src="{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="Profile" class="rounded-circle">
                                        @endif
                                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ isset(auth()->user()->first_name) && auth()->user()->first_name != null ? auth()->user()->first_name.' '.auth()->user()->last_name : ucFirst(explode('@', auth()->user()->email)[0]) }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                        <li class="dropdown-header">
                                            <h6>{{ isset(auth()->user()->first_name) && auth()->user()->first_name != null ? auth()->user()->first_name.' '.auth()->user()->last_name :  ucFirst(explode('@', auth()->user()->email)[0]) }}</h6>
                                            <span>{{ auth()->user()->role->name }}</span>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ auth()->user()->role_id == 1 ? route('adminMyProfile') : (auth()->user()->role_id == 2 ? route('myProfile') : route('candidateProfile')) }}">
                                                <i class="bi bi-person"></i>&emsp;
                                                <span>My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ auth()->user()->role_id == '1' ? route('adminLogout') : route('logout') }}">
                                                <i class="bi bi-box-arrow-right"></i>&emsp;
                                                <span>Sign Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        @else
                        <nav class="header-nav ms-auto mt-3">
                        <a href="{{ route('authType', ['flag' => base64_encode('signup')]) }}" class="site-button"><i class="fa fa-user"></i> Sign Up</a>
                        <a href="{{ route('authType', ['flag' => base64_encode('login')]) }}" class="site-button"><i class="fa fa-lock"></i> Login</a>
                        </nav>
                        @endif
                    </div>
                </div>
                <!-- Main Nav -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="index.html"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt="dddd"></a>
                    </div>
                    <div class="logo-header logo-white">
                        <a href="index.html"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt="vv"></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::routeIs('home') ? 'active' : ''  }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="{{ Request::routeIs('about') ? 'active' : ''  }}">
                            <a href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="{{ Request::routeIs('jobs') ? 'active' : ''  }}">
                            <a href="{{ route('jobs') }}">Jobs</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">Industries</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{ route('it') }}">IT Industries</a>
                                    <a class="dropdown-item" href="{{ route('noniit') }}">Non-IT
                                        Industries</a>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">Staffing Solutions</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{route('executive')}}">Executive
                                        Search</a>
                                    <a class="dropdown-item" href="{{route('Permanent')}}">Permanent
                                        Staffing</a>
                                    <a class="dropdown-item"
                                        href="{{route('Contract')}}">Contract-to-Hire</a>
                                    <a class="dropdown-item"
                                        href="{{route('recruitmentProcess')}}">Recruitment Process Outsourcing</a>

                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route('client') }}">Client</a>
                        </li>
                        <li class="{{ Request::routeIs('contactUs') ? 'active' : ''  }}">
                            <a href="{{ route('contactUs') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header END -->
</header>