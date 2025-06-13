 @extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

 
 <section class="industry-switcher-section">
    <div class="industry-switcher-buttons">
      <button class="industry-btn active" data-target="it">IT INDUSTRIES</button>
      <button class="industry-btn" data-target="non-it">NON IT INDUSTRIES</button>
    </div>

    <div class="industry-grid" id="it-industry">
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo2.jpg" alt="Marsh"></div>
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo5.jpg" alt="Allianz"></div>
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo7.jpg" alt="Allscripts"></div>
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo8.jpg" alt="Persistent"></div>
     
      
    </div>

    <div class="industry-grid hidden" id="non-it-industry">
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo16.jpg" alt="Non-IT 1"></div>
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo27.jpg" alt="Non-IT 2"></div>
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo15.jpg" alt="Non-IT 3"></div>
      <div class="industry-card"><img src="public/frontend/assets/images/Client-logo33.jpg" alt="Non-IT 4"></div>
    </div>
  </section>
  <style>
    .industry-switcher-section {
  padding: 40px 20px;
  max-width: 1200px;
  margin: auto;
  font-family: 'Segoe UI', sans-serif;
  text-align: center;
}

.industry-switcher-buttons {
  margin-bottom: 30px;
}

.industry-btn {
  background-color: transparent;
  border: 2px solid #00bcd4;
  padding: 10px 20px;
  margin: 0 10px;
  font-size: 14px;
  cursor: pointer;
  transition: 0.3s ease;
}

.industry-btn.active,
.industry-btn:hover {
  background-color: #00bcd4;
  color: white;
}

.industry-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 20px;
}

.industry-card {
  border: 1px solid #ddd;
  padding: 15px;
  background: white;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  transition: transform 0.2s;
}

.industry-card img {
  max-width: 100%;
  height: auto;
}

.industry-card:hover {
  transform: translateY(-5px);
}

.hidden {
  display: none;
}

  </style>
@endsection
@section('script')
<script>
    $(function() {
    });
</script>
@section('script')
<script>
    $(document).ready(function () {
        $('.industry-btn').click(function () {
            // Remove active class from all buttons
            $('.industry-btn').removeClass('active');

            // Add active class to the clicked button
            $(this).addClass('active');

            // Get target from data attribute
            const target = $(this).data('target');

            // Toggle visibility of sections
            if (target === 'it') {
                $('#it-industry').removeClass('hidden');
                $('#non-it-industry').addClass('hidden');
            } else {
                $('#it-industry').addClass('hidden');
                $('#non-it-industry').removeClass('hidden');
            }
        });
    });
</script>
@endsection

@endsection