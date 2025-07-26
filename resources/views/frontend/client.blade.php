 @extends('frontend.layouts.app')

 @section('title', 'Home')

 @section('content')

 <div class="page-content bg-white">
   <!-- inner page banner -->
   <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
     <div class="container">
       <div class="dez-bnr-inr-entry">
         <h1 class="text-white">Client</h1>
         <!-- Breadcrumb row -->
         <div class="breadcrumb-row">
           <ul class="list-inline">
             <li><a href="{{ route('home') }}">Home</a></li>
             <li>Client</li>
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
         <div class="industry-switcher-buttons text-center">
           <button class="industry-btn active" data-target="it">IT INDUSTRIES</button>
           <button class="industry-btn" data-target="non-it">NON IT INDUSTRIES</button>
         </div>

         <div class="industry-grid" id="it-industry">
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo1.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo3.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo4.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo6.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo8.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo9.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo10.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo11.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo12.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo13.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo14.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo15.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo17.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo18.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo19.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo20.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo21.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo22.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo23.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo24.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo25.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo26.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo27.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo28.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo29.jpg') }}" alt="Marsh"></div>
           <!-- <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo30.jpg') }}" alt="Marsh"></div> -->
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo31.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo32.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo33.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo34.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/it-industries/Client-logo35.jpg') }}" alt="Marsh"></div>

         </div>

         <div class="industry-grid hidden" id="non-it-industry">
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/non-it-industires/Client-logo2.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/non-it-industires/Client-logo5.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/non-it-industires/Client-logo7.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/non-it-industires/Client-logo16.jpg') }}" alt="Marsh"></div>
           <div class="industry-card"><img src="{{ asset('frontend/assets/images/non-it-industires/Client-logo30.jpg') }}" alt="Marsh"></div>
         </div>
       </div>
     </div>
     <!-- Browse Jobs END -->
   </div>
 </div>
 <section class="industry-switcher-section">

 </section>
 <style>
   .industry-switcher-section {
     padding: 40px 20px;
     max-width: 1200px;
     margin: auto;
     font-family: "Poppins";
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
     box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
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
   $(function() {});
 </script>
 @section('script')
 <script>
   $(document).ready(function() {
     $('.industry-btn').click(function() {
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