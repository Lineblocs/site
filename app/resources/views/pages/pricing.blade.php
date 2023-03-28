@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')

<div class="pricing">
    <section class="cards-section">
      <div class="container">
        <div class="service">
          <h2 class="serviceheading2">
            Pricing
          </h2>
          <h5 class="serviceinfo">Pricing options suitable for teams of all sizes</h5>
        </div>
      </div>
    </section>
    <div class="section no-pad-bot" id="index-banner">





      <section class="cards-section">
        <div class="container">

          <div class="row no-margin">
            @foreach ( $plans as $plan )
              @if ( $plan->isPrepaid() )
                  <div class=" col-s12 col-md-3">
                    <div class="card">

                      <div class="card-content center">
                        <h5 class="">{{$plan->nice_name}}</h5>
                      </div>
                      <div class="card-content center">

                        <h2>
                          <div class="pricing-price">
                            <small>$</small>{{$plan->getFormattedMonthlyCharge()}}
                          </div>
                          <small class="per-month" style="font-size: 10px;">
                            Per month/user</small>
                        </h2>
                      </div>

                      <ul class="collection center">
                        <li class="collection-item">
                          <strong>Metered</strong> minutes outbound in the US or Canada 
                        </li>
                        <li class="collection-item">
                          <strong>5</strong> Extensions
                        </li>
                        <li class="collection-item">
                          <strong>1GB</strong> Voicemail
                        </li>
                        <li class="collection-item">
                          <strong>Metered</strong> inbound calling
                        </li>

                        <li class="collection-item">
                          <strong>100</strong> Fax per month
                        </li>

                        <li class="collection-item item-plus">
                          Plus:
                        </li>

                        <li class="collection-item">
                          Unlimited calling between extensions
                        </li>
                        <li class="collection-item">
                          Standard Call Features
                        </li>
                      </ul>

                      <div class="card-content center card-button">
                        <div>
                          <div class="col-s12">
                            <a href="https://app.lineblocs.com/#/register?plan={{$plan->key_name}}"><button>Get
                                Started</button></a>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                @else
            <div class=" col-s12 col-md-3">

              @if ($plan->isFeatured())
                <div class="card card-popular">
                  <div class="card-popular-corner">

                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M21.4881 7.02719C21.3224 6.87791 21.0863 6.83568 20.8792 6.91829L15.0592 9.23807L9.84877 5.75896C9.66332 5.6351 9.4236 5.62731 9.23047 5.73881C9.03731 5.85034 8.92423 6.06181 8.93874 6.28437L9.3464 12.5364L4.42755 16.4166C4.25247 16.5547 4.17094 16.7803 4.21732 16.9984C4.26369 17.2166 4.42991 17.3895 4.64607 17.4445L10.7179 18.9887L12.8884 24.8659C12.9656 25.0752 13.1549 25.2223 13.3768 25.2457C13.5022 25.2588 13.6258 25.2311 13.731 25.1703C13.8118 25.1237 13.8817 25.0576 13.9334 24.9758L17.2782 19.678L23.5384 19.4303C23.7613 19.4214 23.9598 19.2869 24.0505 19.0831C24.1412 18.8794 24.1084 18.6418 23.9659 18.4702L19.961 13.6521L21.66 7.62143C21.7205 7.40681 21.6539 7.17639 21.4881 7.02719Z" fill="white"></path>
                    </svg>

                    <p>
                      most popular
                    </p>
                  </div>

                  <div class="card-content center">
                    <h5 class="">{{$plan->nice_name}}</h5>
                  </div>
              @else
                <div class="card">

                  <div class="card-content center">
                    <h5 class="">{{$plan->nice_name}}</h5>
                  </div>
              @endif
                <div class="card-content center">
                  <h2>
                    <div class="pricing-price">
                      <small>$</small>{{$plan->getPricingDollars()}}<span class="pricing-decimals">.{{$plan->getPricingDecimels()}}</span>
                    </div>
                    <small class="per-month" style="font-size: 10px;">Per month/user</small>
                  </h2>
                </div>

                <ul class="collection center">

                  @if ($plan->fax)
                  <li class="collection-item">
                    Fax included
                  </li>
                  @endif
                  @if ($plan->im_integrations)
                  <li class="collection-item">
                    IM support
                  </li>
                  @endif
                  @if ($plan->productivity_integrations)
                  <li class="collection-item">
                    Productivity tools
                  </li>
                  @endif
                  @if ($plan->voice_analytics)
                  <li class="collection-item">
                    Voice analytics
                  </li>
                  @endif
                  @if ($plan->fraud_protection)
                  <li class="collection-item">
                    Fraud protection
                  </li>
                  @endif
                  @if ($plan->crm_integrations)
                  <li class="collection-item">
                    CRM integrations
                  </li>
                  @endif
                  @if ($plan->programmable_toolkit)
                  <li class="collection-item">
                    Programmable APIs
                  </li>
                  @endif
                  @if ($plan->sso)
                  <li class="collection-item">
                    SSO support
                  </li>
                  @endif
                  @if ($plan->provisioner)
                  <li class="collection-item">
                    Phone provisioner
                  </li>
                  @endif
                  @if ($plan->vpn)
                  <li class="collection-item">
                    Internal VPN support
                  </li>
                  @endif
                  @if ($plan->multiple_sip_domains)
                  <li class="collection-item">
                    Multiple SIP domains
                  </li>
                  @endif
                  @if ($plan->bring_carrier)
                  <li class="collection-item">
                    Bring your own carrier included
                  </li>
                  @endif
                </ul>



                <div class="card-content center card-button">
                  <div class="">
                    <div class="col-s12">
                      <a href="https://app.lineblocs.com/#/register?plan={{$plan->key_name}}"><button>Get
                          Started</button></a>
                    </div>
                  </div>
                </div>

              </div>
</div>
            @endif
          @endforeach
        </div>

    </section></div>


    <!-- <section class="gray">
      <div class="container">
        <div class="service-content">
          <div class="service-img">
            <img src="images/availability-service.png">
          </div>

          <div class="content">
            <h3 class="content-heading">Fully managed solutions, dedicated pricing</h3>

            <p class="content-para">Get a dedicated pricing solution that allows you to scale your team's UC workflows
              at
              ease.</p>

                    //<a href="/register" class="btn-custom service-btn margin-auto">
                     //   <span></span>
                    //</a>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="pbx-section">
        <div class="container">
          <div class="pbx-content">
            <h3 class="pbx-heading">Competitive UC pricing</h3>
            <p class="pbx-para">Never have to worry about spending too much for your team's call system again. Our
              pricing
              solutions offer a complete solution for calling, fax, and IM – at a competitive price point.</p>

            <a href="/register" class="btn-custom service-btn margin-auto">
              <span>Create Account</span>
            </a>
          </div>
        </div>
      </div>
    </section> -->

    <section class="cards-section">
      <div class="learn_more-section">
        <div class="container">
          <div class="learn_more-content">
            <h3 class="learn_more-heading">Learn More</h3>
            <p class="learn_more-para">Have queries regarding our offerings? Feel free to contact us.</p>

            <a href="/contact" class="btn-custom service-btn margin-auto">
              <span>Contact Us</span>
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function () {
    $('select').formSelect();
    var select = $("#countries");
    var form = document.forms['pricing'];
    $(select).change(function () {
      form.submit();
    });
  });
</script>
@endsection