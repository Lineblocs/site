@extends('layouts.app_new', ['show_drift' => FALSE]) 
@section('title') 
Service Level Agreement 
@endsection @section('metaDescription') 
Service Level Agreement 
@endsection 
@section('content')
<link rel="stylesheet" href="/css/legal.css" />

<body>
    <div class="container legal">
        <div class="effective-date">
            <i>Last Updated: August 4, 2023</i>
        </div>
        <div class="inner">
        @include('layouts.sidebar')
            <div class="content terms-page">
                <div class="lb-col lb-tiny-24 lb-mid-14">
                    <div class="lb-rtxt">
                        <h2>
                            {{strtoupper(\App\Helpers\MainHelper::getSiteName())}} SERVICE LEVEL AGREEMENT
                        </h2>
                        <p>
                        {{\App\Helpers\MainHelper::getSiteName()}} is dedicated to providing Service Level Agreements (SLAs) and sharing Service Level Objectives (SLOs) for all of our paid, widely accessible services. We invite our customers to refer to our comprehensive "well architected documentation" for additional information on SLOs.
                        </p>
                        <p><span>Note -&nbsp;The percentages below are provided for illustration only and subject to the applicable full SLA terms.</span></p>
                    </div>
                    <div class="table-container sla-card">
                        <li class="lb-xbcol m-card m-list-card">
                            <div class="m-card-container">
                                <div class="m-hd">
                                    <h3 class="m-category">
                                        <span>VoIP services</span>
                                    </h3>
                                </div>
                                <div class="m-card-main">
                                    <div class="m-content">
                                        <div class="m-content-hd">
                                            <div class="m-content-type"></div>
                                        </div>
                                        <div class="m-headline-container">
                                            <div>
                                                <h2 class="m-headline"><a href="https://aws.amazon.com/alexaforbusiness/sla/?did=sla_card&amp;trk=sla_card" target="_blank" rel="noopener"></a></h2>
                                                <div class="m-desc">
                                                    <div class="table-responsive">
                                                        <table class="lb-tbl-p" style="min-width: 100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Monthly Uptime Percentage</th>
                                                                    <th>Service Credit Percentage</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Less than 99.9% but greater than or equal to 99.0%</td>
                                                                    <td>10%</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Less than 99.0% but equal to or greater than 95.0%</td>
                                                                    <td>25%</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Less than 95.0%</td>
                                                                    <td>100%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p><a class="test sla-link" href="/pages/sla/voip" rel="noopener" target="_blank">Full SLA</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-ft">
                                     
                                    <div class="m-ft-cta"></div>
                                </div>
                            </div>
                        </li>
                    </div>
                </div>

                <!---->
            </div>
        </div>
        <button
            onclick="function topFunction() {
               document.body.scrollTop = 0; // For Safari
                 document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
         }
         topFunction()"
            id="scrollToTop"
            title="Go to top"
        >
            <i class="far fa-arrow-alt-circle-up"></i>
        </button>
    </div>

    @section('scripts')
    <script>
        jQuery(function () {
            jQuery("#selectbox").change(function () {
                location.href = jQuery(this).val();
            });
            let mybutton = document.getElementById("scrollToTop");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction();
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }
        });
    </script>
    @endsection
</body>
@endsection
