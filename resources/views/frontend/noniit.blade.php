@extends('frontend.layouts.app')

@section('title', 'NonIt')

@section('content')
<div class="page-content bg-white">
  <!-- inner page banner -->
  <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
    <div class="container">
      <div class="dez-bnr-inr-entry">
        <h1 class="text-white">NON-IT Industires</h1>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
          <ul class="list-inline">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>NON-IT Industires</li>
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
            <div class="row">
              <div class="col-md-6">
                <h2 class="vision-heading ">1. Manufacturing</h2>
                <p>
                  Manufacturing forms the backbone of our economic system. The goods rolling off production lines nationwide helps keeping the economy humming while providing the products consumers and businesses need to live and work comfortably. Appliances, heating and cooling units, lawn and garden equipment, lighting – the items we buy for home and work come from manufacturers large and small.
                </p>
                <p>The vast variety of products manufactured throughout the country demand an enormous range of fasteners, MRO, and safety supplies to put them together. From standard fasteners and customized parts, to cleaning supplies and tools, manufacturers need to know they’ll have the parts they need to keep producing their products and meet customer demand.</p>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <img src="public/frontend/assets/images/aboutus-page.jpg" alt="Business Meeting">
              </div>
            </div>
          </div>

          <div class="category">
            <div class="row">
              <div class="col-md-6 d-flex align-items-center">
                <img src="public/frontend/assets/images/aboutus-page.jpg" alt="Business Meeting">
              </div>
              <div class="col-md-6">
                <h2 class="vision-heading ">2.Automotive</h2>
                <p>
                  <span style="font-weight: bold;"> Staffing Services</span> Solutions works closely with a range of international automotive clients and tiered suppliers, helping them to source the skilled and experienced staff and/or contractors for all of their design, process and automotive engineering roles. We are committed to delivering consistent and cost-effective staffing solutions on every occasion, and have established a strong market presence.
                </p>
                <p>Our automotive recruitment teams have good experience in sourcing high-quality personnel within the core functions of design, quality, project management, engineering, operations and maintenance. Automotive include the following disciplines.</p>
                <ul>
                  <li>Design</li>
                  <li>Quality / Supplier Quality</li>
                  <li>Lean / Continuous Improvement</li>
                  <li>Procurement</li>
                  <li>Manufacturing</li>
                  <li>Maintenance</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="category">
            <div class="row">
              <div class="col-md-6">
                <h2 class="vision-heading ">3.FMCG</h2>
                <p>Now in the changing scenario, store visits by consumers are shrinking. As more consumer products companies have a direct relationship with the purchasers of their products, even as robust data analytics allow personalization and localization, leading to ever more differentiated shopper segments, and a changing job profiles.
                </p>
                <p>O&G Skills has a combination of Subject Matter Experts and Sourcing/Talent Mapping Experts and Contract Staffing Experts in the FMCG/Retail sector, which is good for any kind conceivable hiring solution required by any client in this industry. Whether it is a long-standing skills/technology or new upcoming one, our experts are completely clued on and up to date and ready to close your position.</p>
                <ul>
                  <li>Area Sales Manager</li>
                  <li>AVP Marketing Communications</li>
                  <li>General Manager Sales</li>
                  <li>Brand Manager (Nutrition)</li>
                  <li>Brand Manager (Fashion)</li>
                  <li>Sales Manager (Lighting)</li>
                  <li>Head Regional Operations</li>
                  <li>Senior Designer – Apparels</li>
                  <li>Head of Modern Trade</li>
                  <li>Category Manager</li>
                  <li>Brand Manager (FMCG)</li>
                </ul>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <img src="public/frontend/assets/images/aboutus-page.jpg" alt="Business Meeting">
              </div>
            </div>
          </div>

          <div class="category">
            <div class="row">
              <div class="col-md-6 d-flex align-items-center">
                <img src="public/frontend/assets/images/aboutus-page.jpg" alt="Business Meeting">
              </div>
              <div class="col-md-6">
                <h2 class="vision-heading ">4. Healthcare</h2>
                <p><span style="font-weight: bold;">Liftale Staffing Services </span>
                  is catering in India and within multiple industries. Within Healthcare, Liftale Staffing Services, Health has been attracting and retaining healthcare professionals. Liftale Staffing Services has proven time and time again to develop strong, long-term and mutually beneficial relationships across all sub-sectors of healthcare. We have the expertise to identify critical talent within a range of healthcare environments.
                </p>
                <p>Through our Core Staffing capability, we can connect you with quality and dependable healthcare professionals. Liftale Staffing Services Health Recruiters work to provide support across the healthcare industry and deliver highly qualified staffing services to your team.</p>
                <ul>
                  <li>Allied & Healthcare Professionals</li>
                  <li>Pharma & Biotech</li>
                  <li>Revenue Cycle Management</li>
                  <li>Pharmacy</li>
                  <li>Member Support Services</li>
                  <li>Administrative & Clerical</li>
                  <li>Operations</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="category">
            <div class="row">
              <div class="col-md-6">
                <h2 class="vision-heading ">5. Engineering</h2>
                <p>The right asset can determine the success of your critical projects and programs.<span style="font-weight: bold;">Liftale Staffing Services</span> has the expertise to match the right engineers with your organization in the shortest amount of time possible.</p>
                <ul>
                  <li>Mechanical engineer</li>
                  <li>Civil engineer</li>
                  <li>Designer/drafter</li>
                  <li>Electrical engineer</li>
                  <li>Electrical/mechanical assembler</li>
                  <li>Electrical technician</li>
                </ul>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <img src="public/frontend/assets/images/aboutus-page.jpg" alt="Business Meeting">
              </div>
            </div>
          </div>
          <div class="category">
            <div class="row">
              <div class="col-md-6 d-flex align-items-center">
                <img src="public/frontend/assets/images/aboutus-page.jpg" alt="Business Meeting">
              </div>
              <div class="col-md-6">
                <h2 class="vision-heading ">6.Chemical</h2>
                <p><span style="font-weight: bold;"> Liftale Staffing Services</span> workforce solutions experts have transformed the talent acquisition and mobility strategies of companies in the energy, process and infrastructure sectors and have good experience in the chemicals industry.
                </p>
                <p>
                  Our chemicals recruitment specialists are passionate about improving the lives of workers in the chemicals sector and companies in need of the absolute best talent for their projects.
                </p>
                <p>Our talented recruitment team will work alongside you to create an effective talent acquisition and pipeline strategy to ensure you will always have access to the best chemicals Engineers and permanent employees available.</p>
                <ul>
                  <li>Sales</li>
                  <li>Marketing</li>
                  <li>Manufacturing</li>
                  <li>Research & Development</li>
                  <li>Administration</li>
                  <li>Business Management</li>
                </ul>
              </div>
            </div>
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