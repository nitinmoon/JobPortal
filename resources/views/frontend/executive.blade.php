@extends('frontend.layouts.app')

@section('title', 'executive')

@section('content')
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Executive Search</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Executive Search</li>
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
                    <p class="exec-subtitle">Strategic Leadership Starts with the Right Hire</p>
                    <p class="ml-15"><span style="font-weight: bold; color: black;">Liftale Staffing Service </span>delivers proven leaders who drive transformation</p>

                    <p class="ml-15">Hiring executive talent is one of the most critical decisions your organization will make. At <span style="font-weight: bold;"> Liftale </span>, our <span style="font-weight: bold;">Executive</span> Search service is designed to identify, attract, and secure top-tier leadership for your most vital roles—quietly, confidently, and with precision.</p>

                    <h3 class="exec-subheading">What is Executive Search?</h3>
                    <p class="exec-text ml-15">Executive Search is a highly specialized recruitment process for senior leadership and C-suite roles. It requires discretion, insight, and access to a network of passive candidates who are not actively job-seeking—but are open to the right opportunity.</p>

                    <h3 class="exec-subheading">Why Liftale for Executive Search?</h3>
                    <ul class="exec-list ml-15">
                        <li><strong style="font-weight: bold;">Deep Network of Proven Leaders:</strong> We maintain strong relationships with executives across industries, functions, and geographies.</li>
                        <li><strong style="font-weight: bold;">Industry & Functional Expertise:</strong> From CEOs and CFOs to VPs of Engineering or HR, we understand what world-class leadership looks like—because we’ve helped place it.</li>
                        <li><strong style="font-weight: bold;">Confidential & Discreet:</strong> Your leadership search is handled with the utmost confidentiality to protect internal dynamics and external perception.</li>
                        <li><strong style="font-weight: bold;">Tailored, Research-Driven Approach:</strong> Every search is customized. We perform in-depth market mapping, competitor analysis, and behavioural assessments to ensure a precise fit.</li>
                    </ul>

                    <h3 class="exec-subheading">Our Executive Search Process</h3>
                    <ol class="exec-steps ml-15">
                        <li><strong style="font-weight: bold;">Discovery & Alignment:</strong> We collaborate with your leadership team to define the role, success metrics, and ideal candidate profile.</li>
                        <li><strong style="font-weight: bold;">Research & Sourcing:</strong> Our team conducts market intelligence, targets passive candidates, and begins direct outreach through our global network.</li>
                        <li><strong style="font-weight: bold;">Screening & Evaluation:</strong> Rigorous assessments, interviews, and background checks ensure candidates are both qualified and culturally aligned.</li>
                        <li><strong style="font-weight: bold;">Client Presentation:</strong> You receive a refined shortlist of high-impact leaders, complete with detailed profiles and recommendations.</li>
                        <li><strong style="font-weight: bold;">Offer Management & Onboarding:</strong> We help structure competitive offers and facilitate a smooth transition for both client and candidate.</li>
                    </ol>

                    <h3 class="exec-subheading">For Organizations Seeking Leaders</h3>
                    <p class="exec-text ml-15">Whether you’re a startup scaling fast or an enterprise undergoing transformation, Liftale helps you secure executives who bring vision, execution, and long-term impact.</p>

                    <h4 class="exec-subsubheading">Roles We Commonly Place:</h4>
                    <ul class="exec-list ml-15">
                        <li>Chief Executive Officer (CEO)</li>
                        <li>Chief Operating Officer (COO)</li>
                        <li>Chief Financial Officer (CFO)</li>
                        <li>Chief Technology Officer (CTO)</li>
                        <li>Vice Presidents & Directors</li>
                        <li>Department Heads & Senior Managers</li>
                    </ul>

                    <div class="exec-contact">
                        <p>Your leadership defines your future.</p>
                        <p><strong>Contact Liftale Staffing Services</strong> today to begin a confidential executive search that aligns with your strategy and values.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
<style>
    .exec-section {
        padding: 50px 20px;
        background-color: #f9f9f9;
    }

    .exec-container {
        max-width: 1400px;
        margin: 0 auto;

        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .exec-heading {
        font-size: 32px;
        font-weight: bold;
        color: #223D78;
        margin-bottom: 10px;2c3e50
    }

    .exec-subtitle {
        font-size: 18px;
        color: black;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .exec-text {
        font-size: 16px;
        color: black;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .exec-subheading {
        font-size: 22px;
        /* color: #2d3436; */
        color: #000;
        /* margin-top: 10px; */
        margin-bottom: 10px;
    }

    .exec-subsubheading {
        font-size: 20px;
        /* color: #2d3436; */
        color: #000;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .exec-list,
    .exec-steps {
        margin-left: 20px;
        /* color: #2f3542; */
        color: #000;
        padding-left: 15px;
        margin-bottom: 20px;

    }

    .exec-list li,
    .exec-steps li {
        margin-bottom: 10px;
        list-style: decimal;

    }

    .exec-contact {
        /* margin-top: 30px; */
        background-color: #ecf0f1;
        padding: 20px;
        border-left: 5px solid #223D78;
    }
</style>
@endsection
@section('script')
<script>
    $(function() {});
</script>
@endsection