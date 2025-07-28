@extends('frontend.layouts.app')

@section('title', 'Recruitment Process Outsourcing')

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
                <h1 class="text-white">Recruitment Process Outsourcing (RPO) Services</h1>
                <!-- Breadcrumb row -->
                <div class="breadcrumb-row">
                    <ul class="list-inline">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Recruitment Process Outsourcing</li>
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
                    <p class="exec-subtitle" style="font-weight: bold; color: black;">Streamline Talent Acquisition with Liftale’s Expert RPO Solutions</p>
                    <p class="ml-15">At <span style="font-weight: bold; color: black;">Liftale Staffing Service, </span>our <span style="font-weight: bold; color: black;">Recruitment Process Outsourcing (RPO) </span>model is designed to give your business a competitive edge in today’s dynamic talent market. We act as an extension of your internal recruitment team, offering customized hiring solutions that scale with your business needs.</p>

                    <p class="ml-15">Whether you're a growing startup or an enterprise looking to optimize cost and efficiency, Liftale’s RPO services are built to deliver exceptional results.</p>

                    <div class="contract-section">
                        <h2>What is RPO?</h2>
                        <p class="ml-15"><span style="font-weight: bold; color: black;">Recruitment Process Outsourcing (RPO) </span>is a strategic partnership where Liftale takes full or partial control of your recruitment functions. This includes sourcing, screening, interviewing, onboarding, and analytics—managed entirely by our dedicated team of recruitment specialists.</p>

                    </div>

                    <div class="contract-section">
                        <h2>Why Choose Liftale’s RPO Services?</h2>
                        <ul class="core-commitments ml-15">
                            <li>
                                <strong>Scalable & Flexible Solutions</strong><br>
                                Our RPO model is built to adapt. Whether you need end-to-end recruitment management or support for a specific project or department, we tailor our solutions to match your goals.
                            </li>
                            <li>
                                <strong>Cost-Efficient Hiring</strong><br>
                                Reduce your cost-per-hire and time-to-fill. We optimize processes, leverage smart technology, and tap into our extensive talent pool to deliver quality hires efficiently.
                            </li>
                            <li>
                                <strong>Industry-Specific Expertise</strong><br>
                                From IT and engineering to healthcare and finance, our recruiters have deep knowledge of your sector, ensuring that candidates are not just qualified—but aligned with your business culture.
                            </li>
                            <li>
                                <strong>Technology-Driven Approach</strong><br>
                                We utilize advanced recruitment technologies, ATS platforms, and data analytics to ensure transparency, faster turnarounds, and continuous process improvements.
                            </li>
                            <li>
                                <strong>Enhanced Candidate Experience</strong><br>
                                Liftale ensures that every candidate interaction reflects your employer brand positively. We manage communications, feedback loops, and offer a seamless journey from application to onboarding.
                            </li>
                        </ul>
                    </div>

                    <div class="contract-section">
                        <h2>Our RPO Models</h2>
                        <div class="highlight-box">
                            <p>
                                We offer flexible engagement models to suit your recruitment needs:
                            </p>
                            <ul>
                                <li><span style="font-weight: bold; color: black;">End-to-End RPO: </span>Full ownership of your talent acquisition lifecycle.</li>
                                <li><span style="font-weight: bold; color: black;">Project-Based RPO: </span>Support for short-term or seasonal hiring needs.</li>
                                <li><span style="font-weight: bold; color: black;">Hybrid RPO: </span>A shared model where Liftale collaborates with your internal HR team.</li>
                                <li><span style="font-weight: bold; color: black;">On-Demand RPO: </span>Scalable recruitment support when and where you need it.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="contract-section">
                        <h2>Key Deliverables</h2>
                        <div class="highlight-box">
                            <ul>
                                <li>Workforce Planning & Market Intelligence</li>
                                <li>Employer Branding Support</li>
                                <li>Talent Sourcing & Screening</li>
                                <li>Interview Coordination & Management</li>
                                <li>Compliance & Background Checks</li>
                                <li>Analytics & Reporting</li>
                                <li>Onboarding Coordination</li>
                            </ul>
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