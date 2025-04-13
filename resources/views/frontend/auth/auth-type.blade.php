@extends('frontend.layouts.app')

@php $title = $type == 'signup' ? 'Register' : 'Login'; @endphp

@section('title', 'Auth Type '.$title)

@section('content')
<div class="page-content">
    <div class="section-full content-inner-2 browse-job bg-white">
        <div class="container">
            <div class="text-center emp-res">
                <h1>{{ $title }}</h1>
                <p>As</p>
            </div>
            <div class="job-bx max-w800 m-auto">
                <div class="row">
                    <div class="col-lg-6 m-tb10">
                        <div class="create-box bg-gray">
                            <div class="m-b30">
                                <img src="{{ asset('frontend/assets/images/school-bag.png') }}" width="80" alt="">
                            </div>
                            <div class="clearifx">
                                <h6 class="m-b10">I am a Employer</h6>
                                <p class="m-b20">Let's hire your next great candidate.</p>
                                <a href="account-professional.html" class="site-button">{{ $title }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 m-tb10">
                        <div class="create-box bg-gray">
                            <div class="m-b30">
                                <img src="{{ asset('frontend/assets/images/backpack.png') }}" width="80" alt="">
                            </div>
                            <div class="clearifx">
                                <h6 class="m-b10">I am a Candidate</h6>
                                <p class="m-b20">Let's find a perfect job for you.</p>
                                <a href="account-fresher.html" class="site-button">{{ $title }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection