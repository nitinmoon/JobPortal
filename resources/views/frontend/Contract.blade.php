@extends('frontend.layouts.app')

@section('title', 'Contract-to-Hire')

@section('content')
<style>
    .contract-hero {
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
        padding: 40px 20px;
        text-align: center;
    }

    .contract-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #343a40;
    }

    .contract-section {
        padding: 40px 20px;
        background: #fff;
        border-bottom: 1px solid #dee2e6;
    }

    .contract-section h2 {
        font-size: 1.75rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 20px;
    }

    .contract-section p {
        font-size: 1rem;
        /* color: #495057; */
        color: #000;
        line-height: 1.6;
    }

    .contract-section ul {
        list-style-type: disc;
        padding-left: 20px;
        font-size: 14px;
        line-height: 1.6;
    }

    .contract-section ul li {
        padding-left: 30px;
        position: relative;
        margin-bottom: 15px;
    }

    .contract-section ul li::before {

        position: absolute;
        left: 0;
        font-weight: bold;
        color: black;
    }

    .highlight-box {
        background: #f1f3f5;
        padding: 20px;
        border-left: 4px solid #223D78;
        margin-top: 20px;
        border-radius: 5px;
    }

    .contact-cta {
        background: #343a40;
        color: #fff;
        padding: 40px 20px;
        text-align: center;
    }

    .contact-cta h3 {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .contact-cta a {
        background: #ffc107;
        color: #000;
        padding: 10px 25px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 30px;
        transition: 0.3s ease;
    }

    .contact-cta a:hover {
        background: #e0a800;
        color: #fff;
    }

    .core-commitments {
        list-style-type: decimal;
        padding-left: 20px;
        font-size: 14px;
        line-height: 1.6;
    }

    .core-commitments li {
        margin-bottom: 15px;
    }


    .core-commitments strong {
        color: #000;
        font-weight: bold;
    }
</style>
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Contract To Hire</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Contract To Hire</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area -->
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row text-justify">
                    <div class="contract-hero">
                        <h1>Powered by Liftale Staffing Solutions</h1>
                        <p class="ml-15">At Liftale Staffing Services, we understand that making the right hire is critical but sometimes you need more time to be sure. That’s where our Contract to Hire model comes in.</p>
                    </div>

                    <div class="contract-section">
                        <h2>What is Contract to Hire?</h2>
                        <p class="ml-15">
                            Contract to hire staffing allows companies to bring professionals on board for a trial period before making a full-time employment offer. It’s the perfect way to evaluate a candidate’s fit culturally and technically before making a long term commitment.
                        </p>
                    </div>

                    <div class="contract-section">
                        <h2>Why Choose Contract to Hire?</h2>
                        <ul class="core-commitments ml-15">
                            <li>
                                <strong>Risk Mitigation:</strong><br>
                                Evaluate employee performance on the job without the immediate obligation of a full-time hire.
                            </li>
                            <li>
                                <strong>Faster Hiring:</strong><br>
                                We provide pre-vetted candidates ready to step in quickly, helping you fill critical roles faster.
                            </li>
                            <li>
                                <strong>Flexibility:</strong><br>
                                You gain the flexibility to adjust staffing levels based on project needs, budgets, or internal changes.
                            </li>
                            <li>
                                <strong>Better Fit:</strong><br>
                                Assess the candidate’s real-world performance and team dynamics before extending a permanent offer.
                            </li>
                        </ul>
                    </div>

                    <div class="contract-section">
                        <h2>For Employers</h2>
                        <div class="highlight-box">
                            <p>
                                Liftale handles recruitment, screening, onboarding, and payroll during the contract period. You get:
                            </p>
                            <ul>
                                <li>Access to a wide network of skilled professionals</li>
                                <li>Customized talent matching</li>
                                <li>Smooth transition to full-time employment</li>
                            </ul>
                        </div>
                    </div>

                    <div class="contract-section">
                        <h2>For Job Seekers</h2>
                        <div class="highlight-box">
                            <p>
                                A contract to hire role can lead to long term employment. You get:
                            </p>
                            <ul>
                                <li>Opportunity to showcase your skills</li>
                                <li>Insight into company culture</li>
                                <li>Chance to transition into a permanent role with benefits</li>
                            </ul>
                        </div>
                    </div>

                    <div class="contract-section">
                        <h2>Let’s Get Started</h2>
                        <div class="highlight-box">
                            <p>
                                Ready to find the right person or the right position without the pressure of an immediate commitment?
                            </p>
                            <p>Contact <span> Staffing Services</span> today and learn how our<span> Contract to Hire </span> can work for you.</p>
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
        // Add interactive features here if needed
    });
</script>
@endsection