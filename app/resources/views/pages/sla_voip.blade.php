@extends('layouts.app_new', ['show_drift' => FALSE]) 
@section('title') 
Service Level Agreement 
@endsection 
@section('metaDescription') 
Service Level Agreement 
@endsection 
@section('content')
<body>
    <div class="container legal">
        <div class="inner">
            <div class="content terms-page">
                <div id="aws-page-content" class="lb-page-content" data-page-alert-target="true">
                    <main id="aws-page-content-main" role="main" tabindex="-1">
                        <div class="lb-grid lb-row lb-row-max-large lb-snap">
                            <div class="lb-col lb-tiny-24 lb-mid-24">
                                <div class="lb-txt-none lb-txt">
                                    <div class="lb-col lb-tiny-24 lb-mid-24">
                                        <h1  class="lb-txt-none lb-h1 lb-title">VoIP Level Agreement</h1>
                                        <h4 id="Last_Updated.3A_May_5.2C_2022" class="lb-txt-none lb-h4 lb-title">Last Updated: May 5, 2022</h4>


                                        <h2>1. Service Availability:</h2>
    <p>
        1.1. We guarantee a minimum of 99.9% uptime for our VoIP services, excluding scheduled maintenance windows.
    </p>
    <p>
        1.2. In the event of unscheduled downtime, we will work diligently to restore service within one hour.
    </p>

    <h2>2. Call Quality:</h2>
    <p>
        2.1. We commit to providing high-quality audio and video calls with minimal latency and jitter.
    </p>
    <p>
        2.2. We will maintain a Mean Opinion Score (MOS) of at least 4.0 for voice calls.
    </p>

    <h2>3. Customer Support:</h2>
    <p>
        3.1. Our customer support team will be available 24/7 to address your inquiries and resolve issues promptly.
    </p>
    <p>
        3.2. Initial response times to support requests will be within 4 hours or less.
    </p>

    <h2>4. Security and Privacy:</h2>
    <p>
        4.1. We will employ robust security measures to protect your data and communications.
    </p>
    <p>
        4.2. Customer data will be handled in accordance with applicable data protection regulations.
    </p>

    <h2>5. Scalability:</h2>
    <p>
        5.1. We will ensure our VoIP infrastructure is scalable to meet your growing business needs.
    </p>
    <p>
        5.2. We commit to providing advanced notice of any planned maintenance or upgrades that may affect service availability.
    </p>

    <h2>6. Service Credits:</h2>
    <p>
        6.1. In the event that we fail to meet the above SLA commitments, we will provide service credits as follows:
    </p>
    <p>
        - For uptime below 99.9%: 10% of the monthly service fee credited for every 1% below the target.
    </p>
    <p>
        - For MOS below 4.0: 10% of the monthly service fee credited for each 0.1-point decrease in MOS below the target.
    </p>
    <p>
        - For support response times exceeding 4 hours: 5% of the monthly service fee credited for each hour of delay.
    </p>

    <h2>7. Service Termination:</h2>
    <p>
        7.1. If we consistently fail to meet the SLA commitments, you have the option to terminate the service contract without penalty.
    </p>

    <h2>8. Review and Reporting:</h2>
    <p>
        8.1. We will conduct quarterly performance reviews and provide a detailed SLA compliance report to ensure transparency.
    </p>

    <p>This SLA is subject to periodic review and updates as necessary. Our goal is to provide you with reliable and high-quality VoIP services to support your communication needs.</p>

                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
