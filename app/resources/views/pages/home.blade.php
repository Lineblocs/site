@extends('layouts.main', ['show_drift' => FALSE])
@section('title') Home :: @parent @endsection
@section('content')
<section id="hero">
    <div class="hero-content">
        <div class="hero-img">
            <img src="images/hero-img.png">
        </div>
        <div class="hero-text">
            <h1 class="heading">Your Line</h1>
            <p class="desc">LineBlocs is a fully customizable cloud phone system for productive teams.</p>

            <a href="https://app.lineblocs.com/#/register">
                <div class="btn-custom">
                    <span>Get started in 30 seconds</span>
                    <svg width="20px" height="20px" viewBox="0 0 30 20" version="1.1">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="home-page" transform="translate(-662.000000, -557.000000)" stroke="#0A1247"
                                stroke-width="3">
                                <g id="bnt" transform="translate(458.000000, 536.000000)">
                                    <g id="arrow" transform="translate(206.000000, 23.000000)">
                                        <path d="M-2.27373675e-13,7.5 L25.9289867,7.5" id="Path-2"></path>
                                        <polyline id="Path-3" points="17.9289867 0 25.9289867 7.40389204 17.9289867 16">
                                        </polyline>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="features">
            <h2>Explore By Features</h2>
            <div class="feature-detail">
                <div class="feature-text">
                    <p class="desc">Get call features relevant to your business needs – from basic auto attendants to completely customizable call flows that include video conferencing, CRM integrations, and more.</p>
                    <h3 class="heading">Fully Cloud</h3>
                </div>
                <div class="feature-img">
                    <img src="images/cloud-img.png">
                </div>
            </div>
            <div class="feature-detail editor-detail">
                <div class="feature-text">
                    <p class="desc">
                        Stay up to date with a low-code solution that allows you to create highly customizable calling workflows including automations, and third party integrations at ease.</p>
                    <h3 class="heading">Modern Low-Code</h3>
                </div>
                <div class="feature-img">
                    <img src="images/editors-img.png">
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="support-section">
        <div class="container">
            <div class="features">
                <div class="feature-detail support-detail">
                    <div class="feature-text">
                        <p class="desc">Create your team's next calling system without having to manage the underlying platform and infrastructure – we handle that.</p>
                        <h3 class="heading">Scalable</h3>
                    </div>
                    <div class="feature-img support-img">
                        <img src="images/support-img.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="comparision-section">
        <div class="container">
            <div class="comparison-content">
                <h2>Feature Comparison</h2>
                <p class="desc">Below is a list of features offered by alternatives, in comparison to Lineblocs</p>
                <div class="comparison-table">
                    <table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>Nextiva</td>
                                <td>RingCentral</td>
                                <td>LineBlocs</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Unlimited Calls (between extensions)</td>
                                <td>Not Supported</td>
                                <td>Not Supported</td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>Unlimited Concurrent Calling</td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>Cloud Web Portal</td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>Cloud Drag and Drop editor</td>
                                <td>Not Supported</td>
                                <td>Not Supported</td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>Inbound Call Blocking</td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>Voicemail to email</td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>IVR</td>
                                <td>Not Supported</td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>Recordings</td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                            <tr>
                                <td>Call Reporting</td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                                <td><img src="images/verified.png"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="comparision-section">
        <div class="container">
            <h2>Calling, IM and Fax services in</h2>
            <br/>
                @foreach ($countries as $country)
                    <div class="row">
                        <h4>{{$country->name}}</h4>
                        <ul class="grid-list">
                            @foreach ($country->getRegions() as $region)
                                <li class="col s4">
                                    <div>
                                        <h3><a href="/ucaas/{{strtolower($country->iso)}}/{{strtolower($region->code)}}">{{$region['name']}}</a></h3>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
