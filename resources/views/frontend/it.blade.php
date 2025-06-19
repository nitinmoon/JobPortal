@extends('frontend.layouts.app')

@section('title', 'IT')

@section('content')
<div class="page-content bg-white">
  <!-- inner page banner -->
  <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
    <div class="container">
      <div class="dez-bnr-inr-entry">
        <h1 class="text-white">IT Industires</h1>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
          <ul class="list-inline">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>IT Industires</li>
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
          <div class="category">
            <h2 class="vision-heading ">1. Business Operations</h2>
            <p>
              Every product or project requires leadership with vision and focus. As a result, we concentrate on finding highly skilled managers who excel at planning, organizing, and executing effective tech strategies. To do so, we look for experts in time management, problem-solving, and communication, ensuring that each candidate is quality-focused with an in-depth understanding of the latest technology trends.
            </p>
            <ul>
              <li>Project Manager/Coordinator</li>
              <li>Business Analyst</li>
              <li>Program Manager</li>
              <li>Product Manager</li>
              <li>IT Trainer</li>
              <li>CRM</li>
              <li>ERP</li>
            </ul>
          </div>

          <div class="category">
            <h2 class="vision-heading ">2. Software Development</h2>
            <p>
              Whether you are looking to elevate your capabilities or automate processes, finding the right developers can significantly impact the experience for your end user. From enterprise to SaaS solutions, mobile to desktop, our staff connects with unique developers who are up-to-date on the latest coding languages and user experience best practices.
            </p>
            <ul>
              <li>Application Developer</li>
              <li>Mobile Developer</li>
              <li>Front End Developer</li>
              <li>Back End Developer</li>
              <li>Full Stack Developer</li>
              <li>Software Engineer</li>
              <li>Cloud Engineer</li>
              <li>DevOps</li>
              <li>Machine Learning</li>
            </ul>
          </div>

          <div class="category">
            <h2 class="vision-heading ">3. Quality Assurance</h2>
            <p>
              Every great piece of software starts with a clear process and plan. For each phase of the lifecycle to be a success, Quality Assurance is critical. We provide expertise in all facets of QA—enabling our clients to create and deliver high quality products and services that meet the needs and expectations of their customers.
            </p>
            <ul>
              <li>QA Leads & Managers</li>
              <li>Scrum Master</li>
              <li>Software Quality Engineers</li>
              <li>QA Analysts & Testers</li>
              <li>Database Tester / ETL Engineer</li>
              <li>SDET</li>
              <li>Automation Testers</li>
              <li>Performance Testers</li>
              <li>UAT Testers</li>
              <li>OTT/Set-Top Box Testers</li>
            </ul>
          </div>

          <div class="category">
            <h2 class="vision-heading ">4. Infrastructure</h2>
            <p>
              When you rely on infrastructure and technical support talent to keep your business operational, it is critical that your IT staff are committed to implementing high-quality and up-to-date solutions. As a result, our specialized recruiters look for professionals who understand how to streamline operations and reduce costs—all while monitoring and managing the tech you need for day-to-day operations. Whether you are looking to implement a new system or hire in-house staff, our individualized approach can help you find the necessary technical support.
            </p>
            <ul>
              <li>Cybersecurity</li>
              <li>Cloud Infrastructure & DevOps</li>
              <li>Security Engineer/Architect</li>
              <li>Systems/Network Engi neer</li>
              <li>Systems/Network Administration</li>
              <li>Network Operations Center</li>
              <li>Performance Testers</li>
              <li>Desktop Support</li>
              <li>Help Desk</li>
            </ul>
          </div>

          <div class="category">
            <h2 class="vision-heading ">5. Data Management</h2>
            <ul>
              <li>Business Intelligence</li>
              <li>Big Data</li>
              <li>Database Developer</li>
              <li>Data Warehouse</li>
              <li>Data Analyst</li>
              <li>Data Science</li>
              <li>Data Extraction & ETL</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Browse Jobs END -->
  </div>
</div>
<style>
  .vision-heading {
    display: inline-block;
    font-size: 28px;
    font-weight: bold;
    border-bottom: 3px solid #000;
    padding-bottom: 5px;
    margin-bottom: 20px;
  }

  .section {
    max-width: 1100px;
    margin: auto;
  }

  .category {
    background: #ffffff;
    border-left: 5px solid #0056b3;
    padding: 20px;
    margin-top: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
  }

  .category h2 {
    margin-top: 0;
    color: #0056b3;
    font-size: 22px;
  }

  .category p {
    margin: 10px 0;
    font-size: 15px;
    line-height: 1.6;
  }

  .category ul {
    margin: 10px 0 0 20px;
    padding-left: 10px;
  }

  .category ul li {
    margin-bottom: 5px;
    font-size: 14px;
  }
</style>

@endsection
@section('script')
<script>
  $(function() {});
</script>
@endsection