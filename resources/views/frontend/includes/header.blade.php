<header class="site-header mo-left header fullwidth">
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container clearfix">
                <!-- Website Logo -->
                <div class="logo-header mostion logo-dark">
                    <a href="index.html"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a>
                </div>
                <!-- <div class="logo-header mostion logo-white">
                    <a href="index.html"><img src="{{ asset('frontend/assets/images/logo-white.png') }}" alt=""></a>
                </div> -->

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Extra Nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <!-- <a href="javascript:void(0);" class="layout-btn">
								<input type="checkbox">
								<span class="mode-label"></span>
							</a> -->
                        <a href="{{ route('authType', ['flag' => base64_encode('signup')]) }}" class="site-button"><i class="fa fa-user"></i> Sign Up</a>
                        <a href="{{ route('authType', ['flag' => base64_encode('login')]) }}" class="site-button"><i class="fa fa-lock"></i> Login</a>
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
                        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">Industries</a>
        <ul class="dropdown-menu">
            <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="{{ route('it') }}">IT Industries</a>
                <a class="dropdown-item dropdown-toggle" href="{{ route('noniit') }}">Non-IT Industries</a>
               
        </ul>
    </li>
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">Staffing Solutionss</a>
        <ul class="dropdown-menu">
            <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="{{route('executive')}}">Executive Search</a>
                <a class="dropdown-item dropdown-toggle" href="{{route('Permanent')}}">Permanent Staffing</a>
                <a class="dropdown-item dropdown-toggle" href="{{route('Contract')}}">Contract-to-Hire</a>
               
        </ul>
    </li>
                        <li class="">
                            <a href="{{ route('client') }}">Clinet</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header END -->
</header>