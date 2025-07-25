@extends('frontend.layouts.app')

@section('title', 'Permanent')

@section('content')
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Permanent Staffing</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Permanent Staffing</li>
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
                    <h2 class="perm-heading">Permanent Staffing Services</h2>
                    <p class="perm-subtitle ml-15">Hire Right. Hire Once. With Liftale Staffing Services.</p>
                    <p class="perm-text ml-15">Finding the right person for a long-term role is more than just matching a résumé to a job description—it’s about aligning skills, values, and long-term goals.</p>
                    <p class="perm-text ml-15">At Liftale Staffing Services, we specialize in permanent recruitment that delivers the right talent the first time.</p>

                    <h3 class="perm-subheading">What is Permanent Recruitment?</h3>
                    <p class="perm-text ml-15">Permanent recruitment focuses on identifying, attracting, and hiring full-time employees who are a long-term fit for your organization. Liftale acts as your strategic hiring partner—managing the entire recruitment lifecycle from sourcing to placement.</p>

                    <h3 class="perm-subheading">Why Partner with Liftale?</h3>
                    <ul class="perm-list">
                        <li><strong>Deep Industry Expertise:</strong> We understand the unique challenges across various sectors—whether you're hiring for IT, healthcare, finance, engineering, or more.</li>
                        <li><strong>Precision Talent Matching:</strong> Our recruiters take the time to understand your business, your culture, and your goals—ensuring only the best-fit candidates are presented.</li>
                        <li><strong>Time-Saving Process:</strong> We handle job postings, candidate screening, interviews, reference checks, and offer negotiations—so you can focus on your core business.</li>
                        <li><strong>Quality Over Quantity:</strong> We don’t flood your inbox with résumés. We deliver a curated shortlist of high-potential candidates ready to make an impact.</li>
                    </ul>

                    <h3 class="perm-subheading">Our Permanent Recruitment Process</h3>
                    <ol class="perm-steps">
                        <li><strong>Consultation & Needs Assessment:</strong> We learn your business, your culture, and the key success factors for the role.</li>
                        <li><strong>Strategic Sourcing:</strong> We tap into our vast talent network, job boards, and recruitment channels to identify top candidates.</li>
                        <li><strong>Screening & Shortlisting:</strong> Each candidate is thoroughly vetted through interviews, skill assessments, and background checks.</li>
                        <li><strong>Client Interviews & Selection:</strong> We coordinate interviews, manage feedback, and help you select the ideal candidate.</li>
                        <li><strong>Offer Management & Onboarding Support:</strong> We assist in offer negotiations and ensure a smooth onboarding process.</li>
                    </ol>

                    <h3 class="perm-subheading">For Employers</h3>
                    <p class="perm-text ml-15">Whether you’re scaling fast, replacing a critical role, or building a high-performing team. Our permanent staffing solutions provide you with top-tier talent who are in it for the long haul.</p>

                    <h3 class="perm-subheading">For Job Seekers</h3>
                    <p class="perm-text ml-15">Looking for your next career move? Liftale connects talented professionals with companies that value your skills and ambition. We match you with roles where you can thrive long-term.</p>

                    <div class="perm-contact">
                        <p><strong>Let’s Build Your Team</strong></p>
                        <p>Ready to make your next great hire? <span style="font-weight: bold;"> Contact Liftale Staffing Services </span> today for trusted, tailored permanent recruitment solutions that work.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
<style>
    .perm-section {
        padding: 50px 20px;
        background-color: #ffffff;
    }

    .perm-container {
        max-width: 1400px;
        margin: 0 auto;
        background: #f5f5f5;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.03);
    }

    .perm-heading {
        font-size: 32px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .perm-subtitle {
        font-size: 18px;
        /* color: #7f8c8d; */
        color: #000;
        margin-bottom: 20px;
    }

    .perm-text {
        font-size: 16px;
        /* color: #34495e; */
        color: #000;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .perm-subheading {
        font-size: 22px;
        color: #2d3436;
        margin-top: 30px;
        margin-bottom: 10px;
    }

    .perm-list,
    .perm-steps {
        margin-left: 20px;
        color: #2f3542;
        padding-left: 15px;
        margin-bottom: 20px;
    }

    .perm-list li,
    .perm-steps li {
        margin-bottom: 10px;
        list-style: disc;
    }

    .perm-contact {
        margin-top: 30px;
        background-color: #e2ecf5;
        padding: 20px;
        border-left: 5px solid #2980b9;
    }
</style>

@endsection
@section('script')
<script>
    $(function() {});
</script>
@endsection