@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="page-content bg-white">
  <!-- inner page banner -->
  <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
    <div class="container">
      <div class="dez-bnr-inr-entry">
        <h1 class="text-white">ABOUT US</h1>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
          <ul class="list-inline">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>ABOUT US</li>
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
          <!-- <h1 class="text-center">KNOW US</h1> -->
          <p class="subtitle">WE Are offering you Solutions Improve and Stimulate your Business</p>

          <div class="section-one">
            <div class="text">
              <p><span style="font-weight: bold; color: black;">Liftale Staffing Service</span> is an established professional recruitment & executive search firm catering to human resource needs of the IT and Non-IT organizations.
                To cope with the market standards and considering the increasing demand from the IT and Non-IT organizations, we aim to provide recruitment solutions for these organizations across the PAN India.
              </p>
              <p>
                We generate opportunities for people to exceed their own expectations, and advance careers, companies and communities. At Liftale staffing Services, we are passionate about connecting great talent with great organizations across the India.
              </p>
              <p>
                Our clients are re-inventing the way the economy works, and our associates bring deep competencies that help our clients change the marketplace. Together, we generate opportunities for everyone to thrive in ways, big and small, which make a huge difference. We drive the world–and its workforce—forward.
              </p>
            </div>
            <div class="image">
              <img src="public/frontend/assets/images/aboutus-page.jpg" alt="Business Meeting">
            </div>
          </div>

          <div class="section-two">
            <div class="vision">
              <h2 class="vision-heading">OUR VISION</h2>
              <h3 class="vision-h3">Empowering Workforces. Elevating Futures.</h3>
              <p class="ml-15">At Liftale Staffing Services, our vision is to be a trusted bridge between talent and opportunity—empowering businesses to grow and individuals to thrive.</p>
              <p class="ml-15">We envision a world where hiring isn’t just about filling positions, but about building meaningful partnerships that create lasting impact. By combining industry expertise, people-first values, and innovative recruitment strategies, we strive to redefine how talent connects with potential.</p>

              <p class="vision-p"><span style="font-weight: bold; color: black;">Our commitment is simple:</span>
                <br>To lift people, businesses, and communities—one successful placement at a time.
              </p>

            </div>
            <div class="mission">
              <h2 class="vision-heading">OUR MISSION</h2>
              <h3 class="vision-h31">Connecting Talent with Purpose.Driving Success Through People.</h3>
              <p class="ml-15"><span style="font-weight: bold; color: black;"> Liftale Staffing Services</span>, our mission is to deliver exceptional staffing solutions that align the right people with the right opportunities. We are dedicated to helping businesses thrive by providing high-quality talent, and to helping individuals grow by connecting them with roles that match their skills, goals, and potential.</p>
              <ul class="core-commitments ml-15">
                <li>
                  <strong>Integrity in Every Interaction</strong><br>
                  We build trust through transparency, accountability, and ethical practices.
                </li>
                <li>
                  <strong>Excellence in Service Delivery</strong><br>
                  We go beyond filling roles—we craft staffing solutions that solve real business challenges.
                </li>
                <li>
                  <strong>Empowerment Through Opportunity</strong><br>
                  We uplift lives and careers by opening doors to meaningful employment and long-term success.
                </li>
              </ul>
              <p class="ml-15">Our mission is not just to staff positions—it’s to make a lasting difference in the careers, companies, and communities we serve.</p>

            </div>

          </div>

          <div class="section-three">
            <div class="core-image">
              <img src="public/frontend/assets/images/about-details-bottom.jpg" alt="Core Values">
            </div>
            <div class="core-text">
              <h2 class="vision-heading">VALUES:</h2>
              <h3 class="vision-h32">Empowering Workforces.Elevating Futures.</h3>
              <p class="ml-15">At <span style="font-weight: bold; color: black;">Liftale Staffing Service ,</span>
                our values are the foundation of everything we do. They guide how we work, who we partner with, and the impact we strive to make each day.
              </p>
              <ul class="core-commitments ml-15">
                <li>
                  <strong>Integrity:</strong><br>
                  We act with honesty, transparency, and accountability—earning the trust of clients and candidates alike.
                </li>
                <li>
                  <strong>Excellence:</strong><br>
                  We are committed to delivering high-quality staffing solutions, continuously raising the bar in everything we do.
                </li>
                <li>
                  <strong>Partnership:</strong><br>
                  We build strong, long-term relationships based on mutual respect, collaboration, and shared success.
                </li>
                <li>
                  <strong>Diversity & Inclusion:</strong><br>
                  We champion a workforce that reflects the diversity of the world we live in—because different perspectives drive innovation and growth.
                </li>
                <li>
                  <strong>Empowerment:</strong><br>
                  We believe in lifting others. Whether it's a business achieving its goals or a candidate advancing their career, we exist to create opportunity.
                </li>
                <li>
                  <strong>Accountability:</strong><br>
                  We take ownership of our results and follow through on our promises, always delivering on what we commit to.
                </li>
              </ul>
              <p class="ml-15">
                These values aren’t just words on a page—they are embedded in our culture and evident in every interaction. At Liftale, we don’t just fill jobs—we build futures, grounded in purpose and principle.
              </p>
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

  .vision-p {
    font-weight: bold;
    color: black;
  }

  .container-ab {
    max-width: 1200px;
    margin: auto;
    padding: 40px 20px;
  }

  .know-us h1 {
    text-align: center;
    font-size: 32px;
    letter-spacing: 2px;
    color: #003366;
    margin-bottom: 10px;
  }

  .vision-h3 {
    /* text-align: center; */
    font-size: 15px;
    margin-right: 39%;
    color: black;

  }

  .vision-h31 {
    /* text-align: center; */
    font-size: 14.4px;
    margin-right: 14%;
    color: black;

  }

  .vision-h32 {
    /* text-align: center; */
    font-size: 15px;
    margin-right: 54%;
    color: black;

  }


  .subtitle {
    text-align: center;
    font-size: 14px;
    color: #444;
    margin-bottom: 40px;
  }

  /* Section 1 - Intro */
  .section-one {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    align-items: flex-start;
    margin-bottom: 50px;
  }

  .section-one .text {
    flex: 2;
  }

  .section-one .text p {
    line-height: 1.6;
    margin-bottom: 15px;
    font-size: 15px;
    color: #222;
  }

  .section-one .image {
    flex: 1;
  }

  .section-one .image img {
    max-width: 100%;
    border-radius: 6px;
  }

  /* Section 2 - Vision & Mission */
  .section-two {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    margin-bottom: 50px;
  }

  .section-two .vision,
  .section-two .mission {
    flex: 1;
    min-width: 280px;
  }

  .section-two h2 {
    font-size: 18px;
    color: #003366;
    margin-bottom: 8px;
  }

  .section-two p {
    font-size: 14px;
    color: #222;
    line-height: 1.6;
  }

  /* Section 3 - Core Values */
  .section-three {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    align-items: flex-start;
  }

  .section-three .core-image {
    flex: 1;
    min-width: 250px;
  }

  .section-three .core-image img {
    width: 100%;
    border-radius: 6px;
  }

  .section-three .core-text {
    flex: 2;
  }

  .section-three .core-text h2 {
    font-size: 20px;
    color: #003366;
    margin-bottom: 15px;
  }

  .section-three .core-text p {
    margin-bottom: 12px;
    line-height: 1.6;
    font-size: 14px;
  }

  .section-three .core-text strong {
    font-weight: bold;
    color: #333;
  }

  /* Responsive */
  @media (max-width: 768px) {

    .section-one,
    .section-two,
    .section-three {
      flex-direction: column;
    }
  }

  .core-commitments {
    list-style-type: disc;
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



@endsection
@section('script')
<script>
  $(function() {});
</script>
@endsection