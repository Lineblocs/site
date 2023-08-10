@extends('layouts.app_new', ['show_drift' => FALSE])
@section('title')
Service Level Agreement
@endsection

@section('metaDescription')
Service Level Agreement
@endsection

@section('content')

            <link rel="stylesheet" href="/css/legal.css">

<body>
  <div class="mobile-navbar">
    <select class="browser-default" id="selectbox">
      <option value="/pages/privacy-policy">PRIVACY POLICY</option>
      <option value="/pages/tos">TERMS OF SERVICE</option>
      <option value="/pages/tos" selected="">SERVICE LEVEL AGREEMENT</option>
    </select>
  </div>
  <div class="container legal">
    <div class="effective-date">
      <i>Last Updated: August 4, 2023</i>
    </div>
    <div class="inner">
      <div class="sidebar">
        <p><a href="/pages/privacy-policy">PRIVACY POLICY</a></p>
        <p><a href="/pages/tos" >TERMS OF SERVICE</a></p>
        <p><a href="/pages/tos" class="active" >SERVICE LEVEL AGREEMENT</a></p>
      </div>
      <div class="content terms-page">
        <h2>LINEBLOCS SERVICE LEVEL AGREEMENT</h2>      
            <div>
                <h1>Service Level Agreement (SLA) for Lineblocs Ltd.</h1>
                <p>This Service Level Agreement (SLA) is entered into by and between Lineblocs Ltd. (hereinafter referred to as "Client" or "Customer") and [Service Provider Name] (hereinafter referred to as "Service Provider" or "Vendor") on this [Date] to establish the terms and conditions under which the services provided by the Service Provider will be delivered and the service levels that must be met.</p>
        
                <h2>1. Service Description:</h2>
                <p>The Service Provider agrees to provide the following services to the Client:</p>
                <p>[Describe the services being offered in detail, including but not limited to maintenance, technical support, updates, etc.]</p>
        
                <h2>2. Service Level Objectives:</h2>
                <p>The Service Provider commits to meeting the following service level objectives:</p>
                <p>a. <strong>Response Time:</strong> The Service Provider will respond to service requests and incidents within [X] hours of receipt during normal business hours (e.g., 8:00 AM to 6:00 PM, Monday to Friday, excluding public holidays).</p>
                <p>b. <strong>Resolution Time:</strong> The Service Provider will use all reasonable efforts to resolve service requests and incidents within [Y] hours of their acknowledgment.</p>
                <p>c. <strong>Uptime and Availability:</strong> The Service Provider will strive to maintain a system uptime of [Z]% during any given month. Downtime for scheduled maintenance and circumstances beyond the Service Provider's control (e.g., force majeure events) will not be counted towards downtime.</p>
        
                <h2>3. Escalation Procedures:</h2>
                <p>In the event that the Service Provider fails to meet the specified service level objectives, the following escalation procedures will be implemented:</p>
                <p>a. <strong>Level 1 Escalation:</strong> If the Service Provider does not meet the response or resolution time targets, the matter will be escalated to a higher-level technical support team.</p>
                <p>b. <strong>Level 2 Escalation:</strong> If the issue persists and is not resolved within a reasonable time, it will be further escalated to a senior technical team or management.</p>
                <p>c. <strong>Level 3 Escalation:</strong> If the issue remains unresolved after Level 2 escalation, the Service Provider's management will directly engage with the Client's management to expedite resolution.</p>
        
                <h2>4. Reporting:</h2>
                <p>The Service Provider will provide regular service performance reports to the Client, which will include:</p>
                <p>a. Monthly reports detailing the service level achievements and any instances of SLA breaches.</p>
                <p>b. Detailed information about incidents, response times, resolution times, and any actions taken to prevent future occurrences.</p>
        
                <h2>5. Maintenance Schedule:</h2>
                <p>The Service Provider will notify the Client of any planned maintenance activities that may impact the services at least [X] days in advance. Maintenance activities will be scheduled during non-business hours to minimize disruption.</p>
        
                <h2>6. Force Majeure:</h2>
                <p>Neither party shall be liable for any delay or failure to perform its obligations under this SLA due to unforeseen circumstances beyond its reasonable control, such as natural disasters, acts of terrorism, or government regulations (force majeure events).</p>
        
                <h2>7. Termination:</h2>
                <p>Either party may terminate this SLA with [X] days' prior written notice in the event of a repeated failure to meet the service level objectives or any other material breach of the agreement.</p>
        
                <h2>8. Review and Amendments:</h2>
                <p>This SLA will be reviewed on an annual basis, or more frequently if necessary, and may be amended by mutual agreement between the Client and the Service Provider.</p>
        
              
        
            </div>
        
               
 
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