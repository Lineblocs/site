@extends('layouts.main_alt')
@section('title') Home :: @parent @endsection
@section('content')
<div class="our-pricing">
    <header class="container our-pricing-header">
      <h1>
        Our pricing
      </h1>
      <p class="our-pricing-header-description">Below are our rates for voice pricing across our supported countries.
      </p>

      <div class="our-pricing-select">
        <div class="our-pricing-select-input">
          <button data-element-type="button" class="our-pricing-select-button"><span>{{$selected['country']['name']}}</span> <img src="/images/chevron-down.png" alt="chevron down"></button>
          <ul class="our-pricing-select-list">
            <div class="our-pricing-select-list-elements">
              <li data-country="united states">
                <a href="/rates/US">united states</a>
              </li>
              <li data-country="canada">
                <a href="/rates/CA">canada</a>
              </li>
            </div>
          </ul>
        </div>
        <div class="our-pricing-select-separator"></div>
        <div>
          <p class="our-pricing-calling-country">Select Calling <br> Country</p>
        </div>
      </div>
    </header>

    <!-- main display of country costs -->
    <main>
      <section class="our-pricing-table-section">
        <div class="container">
          <div>
              </div><div class="our-pricing-table-row">
                </div><div class="our-pricing-table-row">
                </div><div class="our-pricing-table-row">
                </div><table class="our-pricing-table">
            <tbody><tr class="our-pricing-table-heading">
                <td></td>
                <td></td>
                <td>Local</td>
                <td>Toll free</td>
                <td>all</td>
              </tr>
              <tr>
                  <td class="our-pricing-row-title" style="padding-left: 0px !important;" rowspan="3">
                    <p class="our-pricing-row-uppertext">Calling Rate</p>
                    <h4>
                      Pay as you go
                      <div class="our-pricing-row-title-border"></div>
                    </h4>
                    <p class="our-pricing-row-description">
                      lineblocs lets you add credit to your account and stay making/receiving calls without having to
                      sign
                      up
                      for a monthly billing plan.
                    </p>
                  </td>
                  <td>Inbound Calling</td>
                  <td>{{$selected['voice']['local']['inbound_per_min']}}</td>
                  <td>{{$selected['voice']['toll-free']['inbound_per_min']}}</td>
                  <td> - </td>
                </tr>
                <tr>
                  <td>Outbound Calling</td>
                  <td>{{$selected['voice']['local']['outbound_per_min']}} </td>
                  <td>{{$selected['voice']['toll-free']['outbound_per_min']}} </td>
                  <td> - </td>
                </tr>
                <tr>
                  <td>Recordings Per Minute</td>
                  <td> - </td>
                  <td> - </td>
                  <td>{{$selected['voice']['all']['recording_per_min']}}</td>
                </tr>
             
              <tr>
                  <td class="our-pricing-row-title" style="padding-left: 0px !important;">
                    <p class="our-pricing-row-uppertext">Storage Pricing</p>
                    <h4>
                      Hassle Free with full support
                      <div class="our-pricing-row-title-border"></div>
                    </h4>
                    <p class="our-pricing-row-description">
                      Get 1 membership that includes full support and all account things related.
                    </p>
                  </td>
                  <td>Per GB</td>
                  <td> - </td>
                  <td> - </td>
                  <td>{{$selected['storage']['per_gb']}}</td>
                </tr>
              
              <tr>
                  <td class="our-pricing-row-title" style="padding-left: 0px !important;">
                    <p class="our-pricing-row-uppertext">Number Rental pricing</p>
                    <h4>
                      Top tier networking
                      <div class="our-pricing-row-title-border"></div>
                    </h4>
                    <p class="our-pricing-row-description">
                      our pricing also guarentees top tier networking w/ our partners so you can make and receive calls
                      and make use of a
                      fully redudndant and reliable network.
                    </p>
                  </td>
                  <td>Monthly Costs</td>
                  <td>{{$selected['numbers']['local_per_month']}}</td>
                  <td>{{$selected['numbers']['toll_free_per_month']}}</td>
                  <td> - </td>
                </tr>
              
          </tbody></table>
        </div>
        <div class="our-pricing-download-buttons">
          <div class="container">
            <div class="our-pricing-download-buttons-container">
              <a href="{{$selected['voice']['inbound_csv']}}" download="">Download origination rates as CSV</a>
              <a href="{{$selected['voice']['outbound_csv']}}" download="">Download termination rates as CSV</a>
            </div>
          </div>
        </div>
      </section>
      <!-- contact us section -->
      <section class="our-pricing-contact">
        <div class="container">
          <div class="our-pricing-contact-banner">
            <p>Have queries regarding our services or offerings? feel free to contact us to learn more about it.</p>
            <button>Contact US</button>
          </div>
          <img src="/images/call-center-employee.png" alt="call center employee">
        </div>
      </section>
    </main>
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
  <script src="/js/components/countrySelectionDropdown.js"></script>
@endsection
