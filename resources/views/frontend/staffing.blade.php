@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')


<section class="staffing-section">
    <h2 class="main-title">STAFFING SOLUTIONS</h2>
    <p class="sub-heading">WE Are offering you Solutions Improve and Stimulate your Business</p>
    
    <div class="intro-text">
      <p>
        ANAXTURIA Services offers contingent staffing, direct placement, and managed services throughout the India. 
        We provide flexible, scalable solutions to companies of every size. We provide the agility businesses need with a 
        continuum of staffing solutions. By leveraging our trusted brands, we have built a deeper talent pool to provide 
        our clients access to the people they need, faster. We effectively assess and develop skills, keeping our associates 
        ahead of the curve, so they can get the jobs done each time, every time.
      </p>
    </div>

    <div class="grid">
      <div class="grid-item">
        <h3 class="title">EXECUTIVE SEARCH</h3>
        <p>
          Executives with class-leading leadership hiring solutions. We focus on choosing visionary leaders to help your 
          organization achieve unparalleled excellence. At ANAXTURIA Services, you get access to leaders who possess 
          the perfect balance of expertise and experience.
        </p>
      </div>
      <div class="grid-item">
        <img src="https://i.ibb.co/j8N9TwM/recruitment.png" alt="Recruitment Graphic" class="image">
      </div>
    </div>

    <div class="grid">
      <div class="grid-item">
        <img src="https://i.ibb.co/6JhWj3z/team-digital.png" alt="Digital Team" class="image">
      </div>
      <div class="grid-item">
        <h3 class="title">PERMANENT RECRUITMENT</h3>
        <p>
          At ANAXTURIA Services, we provide permanent recruitment workforce solutions with proven expertise in recruiting, 
          assessing and qualifying candidates for permanent openings. Our process delivers on-the-job success for the long term.
        </p>
      </div>
    </div>
  </section>
  <style>
    .staffing-section {
  max-width: 1000px;
  margin: 40px auto;
  padding: 20px;
}

.main-title {
  text-align: center;
  font-size: 32px;
  font-weight: 700;
  letter-spacing: 1px;
  margin-bottom: 5px;
}

.sub-heading {
  text-align: center;
  font-size: 14px;
  color: #6c7a89;
  margin-bottom: 30px;
}

.intro-text {
  text-align: justify;
  margin-bottom: 40px;
}

.grid {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 40px;
  gap: 20px;
  align-items: center;
}

.grid-item {
  flex: 1 1 45%;
}

.image {
  width: 100%;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.title {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 10px;
  color: #2e3b4e;
  text-transform: uppercase;
  border-bottom: 1px dashed #ccc;
  display: inline-block;
  padding-bottom: 5px;
}

@media (max-width: 768px) {
  .grid {
    flex-direction: column;
  }

  .grid-item {
    flex: 1 1 100%;
  }
}
  </style>


@endsection
@section('script')
<script>
    $(function() {
    });
</script>
@endsection