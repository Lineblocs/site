@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
<div class="cloud-n-solutions-page">
    <section class="hero-banner full-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 my-auto">
                    <h1 class="text-left">Cloud Native Solution</h1>
                    <p>Many customers rely on Lineblocs to make high quality voice calls, integrate IM solutions, and connect via video</p>
                    <a href="#get-started" class="button btn primary-button bg-light-blue">Get started now</a>
                </div>
                <div class="col-12 col-md-5 my-auto">
                    <img src="/images/cloud-n-sol-banner.png" alt="Cloud Native Solutions" class="img-fluid mobile-only">
                </div>
            </div>

        </div>
    </section>
    <section class="help-cards text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">See how Lineblock can help</h2>
                </div>
                <div class="col-12">
                    <ul class="tab">
                        <li class="tablinks inactive " onclick="openTab(event, 'starter')">Starter</li>
                        <li class="tablinks active" onclick="openTab(event, 'app-dev')" id="defaultOpen">App Dev Management</li>
                        <li class="tablinks inactive" onclick="openTab(event, 'development')">Developers</li>
                    </ul>
                </div>
                <div class="col-12 mt-2">
                    <div class="card-deck tabcontent" id="app-dev">
                        <div class="card">
                            <img class="card-icon" src="/images/open-book-icon.png" alt="Open Book Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">App Dev apps in&nbsp;containers: 5 topics to&nbsp;discuss with your team</h5>
                                <p class="card-text">Learn 5 topics managers should discuss with their developers about using containers to build, deploy, and deliver applications.</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-icon" src="/images/closed-book-icon.png" alt="Closed Book Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Developing apps in&nbsp;containers: </h5>
                                <p class="card-text">Learn 5 topics managers should discuss with their developers about using containers to build, deploy, and deliver applications.</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-icon" src="/images/msg-icon.png" alt="Message Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Developing apps in&nbsp;containers: 5 topics to&nbsp;discuss with your team</h5>
                                <p class="card-text">Learn 5 topics managers should discuss wi</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck tabcontent" id="starter">
                        <div class="card">
                            <img class="card-icon" src="/images/open-book-icon.png" alt="Open Book Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Starter apps in&nbsp;containers: 5 topics to&nbsp;discuss with your team</h5>
                                <p class="card-text">Learn 5 topics managers should discuss with their developers about using containers to build, deploy, and deliver applications.</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-icon" src="/images/closed-book-icon.png" alt="Closed Book Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Developing apps in&nbsp;containers: </h5>
                                <p class="card-text">Learn 5 topics managers should discuss with their developers about using containers to build, deploy, and deliver applications.</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-icon" src="/images/msg-icon.png" alt="Message Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Developing apps in&nbsp;containers: 5 topics to&nbsp;discuss with your team</h5>
                                <p class="card-text">Learn 5 topics managers should discuss wi</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck tabcontent" id="development">
                        <div class="card">
                            <img class="card-icon" src="/images/open-book-icon.png" alt="Open Book Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Developing apps in&nbsp;containers: 5 topics to&nbsp;discuss with your team</h5>
                                <p class="card-text">Learn 5 topics managers should discuss with their developers about using containers to build, deploy, and deliver applications.</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-icon" src="/images/closed-book-icon.png" alt="Closed Book Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Developing apps in&nbsp;containers: </h5>
                                <p class="card-text">Learn 5 topics managers should discuss with their developers about using containers to build, deploy, and deliver applications.</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-icon" src="/images/msg-icon.png" alt="Message Icon">
                            <div class="card-body">
                                <p class="subhead">E-BOOK</p>
                                <h5 class="card-title">Developing apps in&nbsp;containers: 5 topics to&nbsp;discuss with your team</h5>
                                <p class="card-text">Learn 5 topics managers should discuss wi</p>
                            </div>
                            <div class="card-footer">
                                <a href="" class="button btn primary-button bg-blue">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feature">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 my-auto text-center">
                    <img src="/images/cloud-n-sol-img1.png" alt="Image" class="rounded img-fluid mb-5">
                </div>
                <div class="col-12 col-lg-6 my-auto">
                    <h2>LineBlock’s cloud-native development solutions help you develop innovative, faster apps</h2>
                    <p>LineBlock’s cloud-native development solutions provide flexibility and agility to build and run applications—on any cloud—while also modernizing enterprise middleware. LineBlock’s is a modern app platform that can replace aging, expensive application servers.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="overview">
        <div class="inner-holder">
            <div class="container">
                <div class="row">
                    <div class="col-12 heading">
                        <h2 class="text-left">Why Businesses <span>choose Lineblocs?</span></h2>
                    </div>

                </div>

                <div class="row ov-row">
                    <div class="col-12 col-md-6">
                        <div class="ov-block">
                            <div class="row">
                                <div class="col-12 col-lg-2 icon-holder my-auto">
                                    <img src="/images/icon-fully-featured.png" alt="" class="icon">
                                </div>
                                <div class="col-12 col-lg-10 heading">
                                    <h3>Fully Featured</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-10 offset-lg-2 content">
                                    <p>Get a highly customizable communications solution that supports all the features of a modern communications system. Lineblocs make it easy for your team to quickly deploy softphones, IVRs, and much more.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="ov-block">
                            <div class="row">
                                <div class="col-12 col-lg-2 icon-holder my-auto">
                                    <img src="/images/icon-rocket.png" alt="" class="icon">
                                </div>
                                <div class="col-12 col-lg-10 heading">
                                    <h3>Integrations</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-10 offset-lg-2 content">
                                    <p>Do more in less time using 100+ integrations developed for highly used SaaS apps. Our solution makes it simpler for you to add third party integrations to your phone system – including CRMs, e-commerce sites, and productivity apps.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row ov-row">
                    <div class="col-12 col-md-6">
                        <div class="ov-block">
                            <div class="row">
                                <div class="col-12 col-lg-2 icon-holder my-auto">
                                    <img src="/images/icon-scalable.png" alt="" class="icon">
                                </div>
                                <div class="col-12 col-lg-10 heading">
                                    <h3>Scalable pops</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-10 offset-lg-2 content">
                                    <p>Get access to a highly available network, suitable for teams of all sizes. our pop network consists of over 30+ locations spread out across multiple regions, allowing small and medium sized team to quickly collaborate and make calls.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="ov-block">
                            <div class="row">
                                <div class="col-12 col-lg-2 icon-holder my-auto">
                                    <img src="/images/coins.png" alt="" class="icon">
                                </div>
                                <div class="col-12 col-lg-10 heading">
                                    <h3>Flexible Pricing</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-10 offset-lg-2 content">
                                    <p>Get long term discounts on voice, fax, and IM. Save on total calling costs by using a completely flexible pricing model, which includes on demand prciing as well as dedicated calling terms.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> {{-- .overview--}}

    <section class="comparison">
        <h2 class="text-center">Compare plans</h2>
        <div class="compare-table">

            <table>
                <!-- <caption>Feature Comparison</caption>-->
                <thead>
                    <th>Compare Plans</th>
                    <th>Enterprise</th>
                    <th>Startups</th>
                    <th>Compaineis</th>
                    <th>Ultimate</th>
                </thead>
                <tbody>
                <tr>
                    <td>Minutes outbound in US or Canada</td>
                    <td>Metered</td>
                    <td>200 minutes</td>
                    <td>250 minutes</td>
                    <td>500 minutes</td>
                </tr>
                <tr>
                    <td>Extensions</td>
                    <td>5</td>
                    <td>5</td>
                    <td>25</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Voicemail</td>
                    <td>1GB</td>
                    <td>2GB</td>
                    <td>32GB</td>
                    <td>128GB</td>
                </tr>
                <tr>
                    <td>Inbound calling</td>
                    <td>Metered</td>
                    <td></td>
                    <td><img src="/images/infinity.png"/></td>
                    <td><img src="/images/infinity.png"/></td>
                </tr>
                <tr>
                    <td>Fax per month</td>
                    <td>100</td>
                    <td><img src="/images/infinity.png"/></td>
                    <td><img src="/images/infinity.png"/></td>
                    <td><img src="/images/infinity.png"/></td>
                </tr>
                <tr>
                    <td>Number Porting</td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Standard Call Features </td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Voicemail Transcription </td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>IM integrations (slack) </td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Productivity Integrations <br />(gsuite, office 365) </td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>

                <tr>
                    <td class="title">Enterprise Features</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Voice Analytics</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Fraud Protection</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>CRM Integrations<br />(salesforce, zoho, zendesk)</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Okta SSO</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Phone Provisioner</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Lineblocs VPN</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Multiple SIP domains</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Bring Your Own Carrier</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>Call Center Apps</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>24&nbsp;/&nbsp;7 Support</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>
                <tr>
                    <td>AI Based call routing</td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/ex.png"/></td>
                    <td><img src="/images/Check.png"/></td>
                </tr>



                </tbody>
            </table>
        </div>

    </section>

</div>{{-- .cloud-n-solutions-page--}}
@endsection
@section('scripts')
    <script>

        function openTab(evt, tabName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove('active');
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", " ");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            var actual_width  =screen.width;
            if(actual_width <= 575){
                document.getElementById(tabName).style.display = "block";
            }
            else{
                document.getElementById(tabName).style.display = "flex";
            }
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();

        window.addEventListener("resize", changeCard);
        function changeCard() {
            var actual_width  =screen.width;
            var activeTab = document.getElementsByClassName('tabcontent active');
            console.log(activeTab);
            if(actual_width <= 575){

                activeTab[0].style.display = "block";
            }
            else{
                console.log(activeTab);
                activeTab[0].style.display = 'flex';
            }
        }
        window.onload = changeCard();
    </script>
@endsection
