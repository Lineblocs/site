@extends('layouts.app_new')
@section('title')
Pricing
@endsection
@section('metaDescription')
Pricing plans for all
@endsection

@section('content')
<style>
.price-comparison {
  margin-top: 15px;
}
.pricing-price .js-plan-price{
  font-size: 22px !important;
}
.pricing .pricing-price small{
  font-size: 22px !important;
}
.pricing .pricing-price small{
  font-size: 22px !important;
}

.pricing-addons-bar {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin: 8px 0 20px;
}

.pricing-addon-card {
  border: 1px solid #e2e7ef;
  border-radius: 12px;
  background: #f7f9fc;
  padding: 14px 18px;
  min-width: 260px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
}

.pricing-addon-title {
  margin: 0;
  font-size: 16px;
  font-weight: 700;
  color: #4b5566;
}

.pricing-addon-subtitle {
  margin: 0;
  font-size: 12px;
  color: #6d7787;
}

.pricing-switch {
  position: relative;
  width: 54px;
  height: 30px;
  display: inline-block;
}

.pricing-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.pricing-switch-slider {
  position: absolute;
  inset: 0;
  background: #d9deea;
  border-radius: 999px;
  cursor: pointer;
  transition: background 180ms ease;
}

.pricing-switch-slider::before {
  content: "";
  position: absolute;
  width: 24px;
  height: 24px;
  left: 3px;
  top: 3px;
  border-radius: 50%;
  background: #fff;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  transition: transform 180ms ease;
}

.pricing-switch input:checked + .pricing-switch-slider {
  background: #FF655D;
}

.pricing-switch input:checked + .pricing-switch-slider::before {
  transform: translateX(24px);
}

.per-month {
  display: inline;
  margin-top: 0;
  font-size: 24px;
  font-weight: 600;
  letter-spacing: 0.01em;
  color: #2f3f58;
  line-height: 1;
}

.pricing-price {
  display: inline-flex;
  align-items: flex-start;
  justify-content: center;
  gap: 4px;
  max-width: 100%;
  line-height: 1;
}

.pricing-price small {
  font-size: 0.7em;
  line-height: 1.1;
}

.pricing-price .js-plan-price {
  font-size: clamp(38px, 3.5vw, 56px);
  line-height: 1;
  max-width: 100%;
  white-space: nowrap;
  overflow-wrap: normal;
  word-break: keep-all;
}

.pricing-price .per-month {
  font-size: clamp(20px, 1.8vw, 28px);
  white-space: nowrap;
}

@media (max-width: 1200px) {
  .pricing-price .js-plan-price {
    font-size: clamp(34px, 3.2vw, 48px);
  }

  .pricing-price .per-month {
    font-size: clamp(18px, 1.8vw, 24px);
  }
}

.compare-plans {
  margin-top: 28px;
  border: 1px solid #e2e7ef;
  border-radius: 12px;
  background: #fff;
  overflow: hidden;
}

.compare-plans-header {
  padding: 18px 20px 8px;
}

.compare-plans-header h4 {
  margin: 0;
}

.compare-plans-wrap {
  overflow-x: auto;
}

.compare-plans table {
  width: 100%;
  min-width: 760px;
  border-collapse: collapse;
}

.compare-plans th,
.compare-plans td {
  border-top: 1px solid #eef2f7;
  padding: 12px 14px;
  font-size: 14px;
  color: #2f3f58;
  text-align: center;
}

.compare-plans th:first-child,
.compare-plans td:first-child {
  text-align: left;
  font-weight: 600;
  color: #1f2d3d;
}

.compare-plans .compare-check {
  color: #0ea5e9;
  font-weight: 700;
}

.empty-pricing-state {
  width: 100%;
  margin-top: 10px;
  padding: 20px;
  text-align: center;
  border: 1px dashed #d7deea;
  border-radius: 12px;
  color: #58667a;
  background: #fbfcff;
}

@media (max-width: 767px) {
  .pricing-addons-bar {
    justify-content: center;
  }
}
</style>
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
          <div class="pricing-addons-bar">
            <div class="pricing-addon-card">
              <div>
                <p class="pricing-addon-title">Annual pricing</p>
                <p class="pricing-addon-subtitle" id="notionAiState">Monthly pricing</p>
              </div>
              <label class="pricing-switch" for="notionAiToggle">
                <input type="checkbox" id="notionAiToggle" />
                <span class="pricing-switch-slider"></span>
              </label>
            </div>
          </div>

          <div class="row no-margin">
            @forelse ( $plans as $plan )
              @if ( $plan->isPrepaid() )
                  <div class=" col-s12 col-md-3">
                    <div class="card">

                      <div class="card-content center">
                        <h5 class="">{{$plan->nice_name}}</h5>
                      </div>
                      <div class="card-content center">

                        <h2>
                          <div class="pricing-price">
                            <small>$</small><span class="js-plan-price" data-monthly="{{$plan->getFormattedMonthlyCharge()}}" data-annual="{{$plan->getFormattedAnnualCharge()}}">{{$plan->getFormattedMonthlyCharge()}}</span>
                            <small class="per-month js-plan-period" data-monthly="/ month" data-annual="/ year">
                              / month</small>
                          </div>
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
                            <a class="js-get-started" data-base-url="https://app.lineblocs.com/#/register?plan={{$plan->key_name}}" href="https://app.lineblocs.com/#/register?plan={{$plan->key_name}}&billing=monthly&term=monthly"><button>Get
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
                      <small>$</small><span class="js-plan-price" data-monthly="{{$plan->getFormattedMonthlyCharge()}}" data-annual="{{$plan->getFormattedAnnualCharge()}}">{{$plan->getFormattedMonthlyCharge()}}</span>
                      <small class="per-month js-plan-period" data-monthly="/ month" data-annual="/ year">/ month</small>
                    </div>
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
                      <a class="js-get-started" data-base-url="https://app.lineblocs.com/#/register?plan={{$plan->key_name}}" href="https://app.lineblocs.com/#/register?plan={{$plan->key_name}}&billing=monthly&term=monthly"><button>Get
                          Started</button></a>
                    </div>
                  </div>
                </div>

              </div>
</div>
            @endif
            @empty
              <div class="empty-pricing-state">
                No pricing plan avaiallbe at this time.
              </div>
            @endforelse
          </div>

          @if ($plans->count() > 0)
            <div class="compare-plans">
              <div class="compare-plans-header">
                <h4>Compare all plans</h4>
              </div>
              <div class="compare-plans-wrap">
                <table>
                  <thead>
                    <tr>
                      <th>Feature</th>
                      @foreach ($plans as $plan)
                        <th>{{$plan->nice_name}}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Monthly price</td>
                      @foreach ($plans as $plan)
                        <td>${{$plan->getFormattedMonthlyCharge()}} / month</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Annual price</td>
                      @foreach ($plans as $plan)
                        <td>${{$plan->getFormattedAnnualCharge()}} / year</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Fax included</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->fax ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>IM support</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->im_integrations ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Productivity tools</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->productivity_integrations ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Voice analytics</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->voice_analytics ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Fraud protection</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->fraud_protection ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>CRM integrations</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->crm_integrations ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Programmable APIs</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->programmable_toolkit ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>SSO support</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->sso ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Phone provisioner</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->provisioner ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Internal VPN support</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->vpn ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Multiple SIP domains</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->multiple_sip_domains ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Bring your own carrier</td>
                      @foreach ($plans as $plan)
                        <td>{!! $plan->bring_carrier ? '<span class="compare-check">&#10003;</span>' : '&mdash;' !!}</td>
                      @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          @endif
        

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

    @if (\App\Helpers\CustomizationsHelper::get('show_savings_content'))
      <section class="cards-section">
        <div class="learn_more-section">
          <div class="container">
            <div class="learn_more-content">
              <h3 class="learn_more-heading">How {{\App\Helpers\MainHelper::getSiteName()}} compares</h3>
              <p class="learn_more-para">Select a competing service below to find out how our prices compare.</p>
              <select class="form-control" name="savings_competitor" id="savingsCompetitor">
                @foreach ($competitors as $competitor)
                  <option value="{{$competitor->id}}">{{$competitor->name}}</option>
                @endforeach
              </select>
              <div class="price-comparison">
                <h4>VoIP & calling rates</h4>
                <table class="table table-striped" id="voipRates">
                  <thead>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif

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
  const ourPricingData = {};

  function addRowItem(tbody,savingsData,dataKey,label) {
    var tr = $("<tr></tr>");
    var labelTd = $("<td></td>");
    labelTd.text( label );
    labelTd.appendTo( tr );

    var theirRateTd = $("<td></td>");
    theirRateTd.text( savingsData[dataKey] )
    theirRateTd.appendTo( tr );

    var ourRateTd = $("<td></td>");
    ourRateTd.text( ourPricingData[dataKey] )
    ourRateTd.appendTo( tr );

    tr.appendTo( tbody );
  }
  $(document).ready(function () {
    const notionAiToggle = document.getElementById("notionAiToggle");
    const notionAiState = document.getElementById("notionAiState");
    const pricingAmounts = document.querySelectorAll(".js-plan-price");
    const pricingPeriods = document.querySelectorAll(".js-plan-period");
    const getStartedLinks = document.querySelectorAll(".js-get-started");

    function updatePricingMode(showAnnual) {
      var billingMode = showAnnual ? "annual" : "monthly";

      for (var i = 0; i < pricingAmounts.length; i++) {
        var amountNode = pricingAmounts[i];
        amountNode.textContent = showAnnual ? amountNode.getAttribute("data-annual") : amountNode.getAttribute("data-monthly");
      }

      for (var j = 0; j < pricingPeriods.length; j++) {
        var periodNode = pricingPeriods[j];
        periodNode.textContent = showAnnual ? periodNode.getAttribute("data-annual") : periodNode.getAttribute("data-monthly");
      }

      if (notionAiState) {
        notionAiState.textContent = showAnnual ? "Annual pricing" : "Monthly pricing";
      }

      for (var k = 0; k < getStartedLinks.length; k++) {
        var link = getStartedLinks[k];
        var baseUrl = link.getAttribute("data-base-url");
        if (baseUrl) {
          link.setAttribute("href", baseUrl + "&billing=" + billingMode + "&term=" + billingMode);
        }
      }
    }

    if (notionAiToggle && notionAiState) {
      notionAiToggle.addEventListener("change", function () {
        updatePricingMode(this.checked);
      });
    }
    updatePricingMode(false);

    var costSavings = {!! json_encode($savings->toArray()) !!}
    $("#savingsCompetitor").change(function() {
      var competitor = $(this).val();

      // only get the first result for now.
      // todo: change this to selectively pick which record to get based on what
      // regiont he user is interested in viewing.
      const savingsData = costSavings.find( (item) => {
        if ( item.competitor_id.toString() === competitor ) {
          return true;
        }
        
        return false;
      });
      console.log('savings data ', savingsData);

      const thead = $("table#voipRates thead");
      thead.children().remove().end();
      const tr = $("<tr></tr>");
      $("<td>Category</td>").appendTo( tr );
      $("<td>Their rate</td>").appendTo( tr );
      $("<td>Our rate</td>").appendTo( tr );
      tr.appendTo( thead );


      const tbody = $("table#voipRates tbody");
      tbody.children().remove().end();
      addRowItem(tbody,savingsData,'pstn_calls', 'PSTN calls');
      addRowItem(tbody,savingsData,'receive_calls_on_local_number', 'Receive calls on local number');
      addRowItem(tbody,savingsData,'webrtc_calling_rates', 'WebRTC calling rates');
      addRowItem(tbody,savingsData,'call_recordings', 'Call Recordings');
      addRowItem(tbody,savingsData,'call_recordings_storage', 'Call Recordings Storage');
      addRowItem(tbody,savingsData,'conference_calls', 'Conference calls');
    })


    $("#savingsCompetitor").change();
  });
</script>
@endsection
