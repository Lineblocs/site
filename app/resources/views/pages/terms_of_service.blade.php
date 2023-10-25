@extends('layouts.app_new', ['show_drift' => FALSE])
@section('title')
Terms of Service
@endsection

@section('metaDescription')
Terms of Service
@endsection

@section('content')

 <link rel="stylesheet" href="/css/legal.css">

<body>
  
  <div class="container legal">
    <div class="effective-date">
      <i>Last Updated: September 20, 2020</i>
    </div>
    <div class="inner">
    @include('layouts.sidebar')
      <div class="content terms-page">
        {!! $content['terms_of_service'] !!}
      </div>
    </div>
    <button onclick="function topFunction() {
               document.body.scrollTop = 0; // For Safari
                 document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
         }
         topFunction()" id="scrollToTop" title="Go to top"><i class="far fa-arrow-alt-circle-up"></i></button>
  </div>

     @section('scripts')
     <script>
       jQuery(function () {
          jQuery("#selectbox").change(function () {
              location.href = jQuery(this).val();
          })
         let mybutton = document.getElementById("scrollToTop");

         // When the user scrolls down 20px from the top of the document, show the button
         window.onscroll = function() {scrollFunction()};

         function scrollFunction() {
           if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
             mybutton.style.display = "block";
           } else {
             mybutton.style.display = "none";
           }
         }
      })
     </script>
     @endsection


</body>
@endsection