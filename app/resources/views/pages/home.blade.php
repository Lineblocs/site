@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
        <div class="hero__container">

            <div class='styling__white'></div>
            <div class='styling__blue'></div>
            <div class="hero__titleWrapper">
                    <h1>Your Lineblocs</h1>
                    <h2>LineBlocs is a fully custimizable cloud phone system for productive teams.</h2>
                    <a href="https://app.lineblocs.com/#/register">
                    <button class="primary-button bg-blue">Get started in 30 seconds</button>
                    </a>
            </div>
            <div class="hero__img"></div>

        </div>
        <main>
            <section class="features">
                <div class="container">
                    <h2 class="text-center">Explore By Features</h2>
                    <div class="row feature">
                        <div class="col-12 col-md-6 my-auto">
                            <h3>Fully Cloud</h3>
                            <p>Get call features relevant to your business needs – from basic auto attendants to completely customizable call flows that include video conferencing, CRM integrations, and more.</p>
                        </div>
                        <div class="col-12 col-md-6 my-auto">
                            <img src="./images/fullcloud.png" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row feature">
                        <div class="col-12 col-md-6 my-auto">
                            <img src="./images/mod.png" alt="" class="img-fluid">
                        </div>
                        <div class="col-12 col-md-6 my-auto">
                            <h3>Modern Low-Code</h3>
                            <p>Stay up to date with a low-code solution that allows you to create highly customizable calling workflows including automations, and third party integrations at ease.</p>
                        </div>
                    </div>
                    <div class="row feature">
                        <div class="col-12 col-md-6 my-auto">
                            <h3>Scalable</h3>
                            <p>Get call features relevant to your business needs – from basic auto attendants to completely customizable call flows that include video conferencing, CRM integrations, and more.</p>
                        </div>
                        <div class="col-12 col-md-6 my-auto">
                            <img src="./images/scale.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </section>

            <section class="comparison">
                <h2 class="text-center">Feature Comparison</h2>
                <table class="comparison">
                   <!-- <caption>Feature Comparison</caption>-->
                    <thead>
                        <th class="title">Compare Plans</th>
                        <th>LineBlocs</th>
                        <th>Nextiva</th>
                        <th>RingCentral</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Unlimited Calls (between extensions)</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/ex.png"/></td>
                            <td><img src="images/ex.png"/></td>
                        </tr>
                        <tr>
                            <td>Unlimited Concurrent Calling</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                        </tr>
                        <tr>
                            <td>Cloud Web Portal</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                        </tr>
                        <tr>
                            <td>Cloud Drag and Drop Editor</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/ex.png"/></td>
                            <td><img src="images/ex.png"/></td>
                        </tr>
                        <tr>
                            <td>Inbound Call Blocking</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                        </tr>
                        <tr>
                            <td>Voicemail to email</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                        </tr>
                        <tr>
                            <td>IVR</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/ex.png"/></td>
                            <td><img src="images/Check.png"/></td>
                        </tr>
                        <tr>
                            <td>Recordings</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                        </tr>
                        <tr>
                            <td>Call Reporting</td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                            <td><img src="images/Check.png"/></td>
                        </tr>
                        </tbody>
                </table>
            </section>
            <section class="serviceAreas">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h2>Calling, IM<br /> and Fax services in</h2>
                            <div class="row place">
                                <div class="col-md-3 col-sm-12">
                                    <h3>Canada:</h3>
                                </div>
                                <div class="col-9">
                                    <ul class="statesAndProvinces">
                                        <li><a href="/ucaas/ca/ab">Alberta</a></li>
                                        <li><a href="/ucaas/ca/bc">British Columbia</a></li>
                                        <li><a href="/ucaas/ca/mb">Manitoba</a></li>
                                        <li><a href="/ucaas/ca/ns">Nova Scotia</a></li>
                                        <li><a href="/ucaas/ca/on">Ontario</a></li>
                                        <li><a href="/ucaas/ca/qc">Quebec</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6">
                            <img src="./images/world.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </section>
                </main>
        @endsection