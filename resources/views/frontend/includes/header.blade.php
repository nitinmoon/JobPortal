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
                        <nav class="header-nav ms-auto">
                            <ul class="d-flex">
                                <li class="nav-item dropdown pe-3">
                                    <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                                        <img src="{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="Profile" class="rounded-circle">
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
                                            <a class="dropdown-item d-flex align-items-center" href="{{ auth()->user()->role_id == '1' ? route('adminMyProfile') : route('myProfile') }}">
                                                <i class="bi bi-person"></i>
                                                <span>My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ auth()->user()->role_id == '1' ? route('adminLogout') : route('logout') }}">
                                                <i class="bi bi-box-arrow-right"></i>
                                                <span>Sign Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <!-- <a href="{{ route('logout') }}" class="site-button"><i class="fa fa-lock"></i> Sign Out</a> -->
                        @else
                        <a href="{{ route('authType', ['flag' => base64_encode('signup')]) }}" class="site-button"><i class="fa fa-user"></i> Sign Up</a>
                        <a href="{{ route('authType', ['flag' => base64_encode('login')]) }}" class="site-button"><i class="fa fa-lock"></i> Login</a>
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
                        <li class="{{ Request::routeIs('jobs') ? 'active' : ''  }}">
                            <a href="{{ route('jobs') }}">Jobs</a>
                        </li>
                        <li class="">
                            <a href="#">About Us</a>
                        </li>
                        <li class="">
                            <a href="#">Contact Us</a>
                        </li>
                        <li class="">
                            <a href="#">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header END -->
</header>