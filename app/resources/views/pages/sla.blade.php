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
                                        <h1  class="lb-txt-none lb-h1 lb-title">Amazon API Gateway Service Level Agreement</h1>
                                        <h4 id="Last_Updated.3A_May_5.2C_2022" class="lb-txt-none lb-h4 lb-title">Last Updated: May 5, 2022</h4>
                                        <div class="lb-rtxt">
                                            <p>
                                                This Amazon API Gateway Service Level Agreement (“SLA”) is a policy governing the use of Amazon API Gateway (“API Gateway”) and applies separately to each account using API Gateway. In the
                                                event of a conflict between the terms of this SLA and the terms of the <a href="https://aws.amazon.com/agreement/" target="_blank">AWS Customer Agreement</a> or other agreement with us
                                                governing your use of our Services (the “Agreement”), the terms and conditions of this SLA apply, but only to the extent of such conflict. Capitalized terms used herein but not defined herein
                                                shall have the meanings set forth in the Agreement.<br />
                                            </p>
                                        </div>
                                        <h3 id="Service_Commitment" class="lb-txt-none lb-h3 lb-title">Service Commitment</h3>
                                        <div class="lb-rtxt">
                                            <p>
                                                AWS will use commercially reasonable efforts to make API Gateway available with a Monthly Uptime Percentage of at least 99.95% for each AWS region, during any monthly billing cycle (the
                                                “Service Commitment”). In the event that a API Gateway does not meet the Service Commitment, you will be eligible to receive a Service Credit as described below.<br />
                                            </p>
                                        </div>
                                        <h3 id="Service_Credits" class="lb-txt-none lb-h3 lb-title">Service Credits</h3>
                                        <div class="lb-rtxt">
                                            <p>
                                                Service Credits are calculated as a percentage of the total charges paid by you for API Gateway in the affected AWS region for the monthly billing cycle in which the Monthly Uptime Percentage
                                                fell within the ranges set forth in the table below:<br />
                                            </p>
                                        </div>
                                        <div class="lb-tbl lb-tbl-p" style="margin-top: 0px; margin-bottom: 0px;" data-is-sticky-header="false">
                                            <table border="0" cellspacing="0" cellpadding="0" width="504">
                                                <tbody>
                                                    <tr>
                                                        <td width="342">
                                                            <p><b>Monthly Uptime Percentage</b></p>
                                                        </td>
                                                        <td width="162">
                                                            <p><b>Service Credit Percentage</b></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="342"><p>Less than 99.95% but greater than or equal to 99.0%</p></td>
                                                        <td width="162"><p>10%</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="342">Less than 99.0% but greater than or equal to 95.0%</td>
                                                        <td width="162">25%</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="342">Less than 95.0%</td>
                                                        <td width="162">100%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="lb-rtxt">
                                            <p>
                                                We will apply any Service Credits only against future API Gateway payments otherwise due from you. At our discretion, we may issue the Service Credit to the credit card you used to pay for the
                                                billing cycle in which the Service Commitment was not met. Service Credits will not entitle you to any refund or other payment from AWS. A Service Credit will be applicable and issued only if
                                                the credit amount for the applicable monthly billing cycle is greater than one dollar ($1 USD). Service Credits may not be transferred or applied to any other account. Unless otherwise
                                                provided in the Agreement, your sole and exclusive remedy for any unavailability, non-performance, or other failure by us to provide API Gateway is the receipt of a Service Credit (if
                                                eligible) in accordance with the terms of this SLA.<br />
                                            </p>
                                        </div>
                                        <h3 id="Credit_Request_and_Payment_Procedures" class="lb-txt-none lb-h3 lb-title">Credit Request and Payment Procedures</h3>
                                        <div class="lb-rtxt">
                                            <p>
                                                To receive a Service Credit, you must submit a claim by <a href="https://aws.amazon.com/support/createCase?type=account_billing" target="_blank">opening a case in the AWS Support Center</a>.
                                                To be eligible, the credit request must be received by us by the end of the second billing cycle after which the incident occurred and must include:
                                            </p>
                                            <p style="margin-left: 40px;">1. the words “SLA Credit Request” in the subject line;</p>
                                            <p style="margin-left: 40px;">2. the dates, times, and AWS regions of each lack of Availability incident that you are claiming;</p>
                                            <p style="margin-left: 40px;">3. the affected API Gateway API ID(s);</p>
                                            <p style="margin-left: 40px;">4. the billing cycle with respect to which you are claiming Service Credits;</p>
                                            <p style="margin-left: 40px;">
                                                5. your request logs that document the errors and corroborate your claimed outage (any confidential or sensitive information in these logs should be removed or replaced with asterisks)
                                            </p>
                                            <p>
                                                If the Monthly Uptime Percentage of such request is confirmed by us and is less than the Service Commitment, then we will issue the Service Credit to you within one billing cycle following the
                                                month in which your request is confirmed by us. Your failure to provide the request and other information as required above will disqualify you from receiving a Service Credit.<br />
                                            </p>
                                        </div>
                                        <h3  class="lb-txt-none lb-h3 lb-title">Amazon API Gateway SLA Exclusions</h3>
                                        <div class="lb-rtxt">
                                            <p>
                                                The Service Commitment does not apply to any unavailability, suspension or termination of API Gateway, or any other API Gateway performance issues: (i) caused by factors outside of our
                                                reasonable control including any force majeure event or Internet access or related problems beyond the demarcation point of API Gateway; (ii) that result from any voluntary actions or
                                                inactions by you (e.g., scaling of provisioned capacity, misconfiguring security groups, VPC configurations or credential settings, disabling encryption keys or making encryption keys
                                                inaccessible, etc.); (iii) that result from your equipment, software or other technology; (iv) that result from you not following the best practices described in the Amazon API Gateway
                                                Developer Guide on the AWS Site; or (v) arising from our suspension or termination of your right to use API Gateway in accordance with the Agreement (collectively, the “API Gateway SLA
                                                Exclusions”). If availability is impacted by factors other than those used in our Monthly Uptime Percentage calculation, then we may issue a Service Credit considering such factors at our
                                                discretion.<br />
                                            </p>
                                        </div>
                                        <h3 id="Definitions" class="lb-txt-none lb-h3 lb-title">Definitions</h3>
                                        <div class="lb-rtxt">
                                            <ul>
                                                <li>
                                                    “Availability” is calculated for each 5-minute interval as the percentage of Requests processed by API Gateway that do not fail with Errors and relate solely to the provisioned API Gateway
                                                    APIs. If you did not make any Requests in a given 5-minute interval, that interval is assumed to be 100% available.
                                                </li>
                                            </ul>
                                            <ul>
                                                <li>An “Error” is any Request that fails due to an API Gateway internal service error.</li>
                                            </ul>
                                            <ul>
                                                <li>
                                                    “Monthly Uptime Percentage” for a given AWS region is calculated as the average of the Availability for all 5-minute intervals in a monthly billing cycle. Monthly Uptime Percentage
                                                    measurements exclude any lack of Availability resulting directly or indirectly from any API Gateway SLA Exclusion.
                                                </li>
                                            </ul>
                                            <ul>
                                                <li>A “Request” is an invocation of an endpoint of any API hosted on API Gateway.</li>
                                            </ul>
                                            <ul>
                                                <li>A “Service Credit” is a dollar credit, calculated as set forth above, that we may credit back to an eligible account.</li>
                                            </ul>
                                            <div>
                                                <a href="https://aws.amazon.com/api-gateway/sla/historical/" target="_blank">&nbsp;</a>
                                            </div>
                                            <div>
                                                <a href="https://aws.amazon.com/api-gateway/sla/historical/" target="_blank">Prior version(s)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lb-small-v-margin lb-rtxt">
                                    <p><b>Prior Version(s):</b> <a href="/api-gateway/sla/historical-sla/">Link</a>&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
