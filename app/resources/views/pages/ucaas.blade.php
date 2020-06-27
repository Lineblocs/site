@extends('layouts.main', ['footer_cls' => 'no-margin'])
@section('title') Home :: @parent @endsection
@section('content')
<div class="section no-bottom-margin more-padding" id="index-banner">
  <div class="container">
    <center>
      <h2>Find Calling, Fax and IM services</h2>
      <p>
      </p>
    </center>
    <div class="row">
      <div class="col s4">
        <div class="card horizontal rounded">
          <div class="card-stacked min">
            <div class="card-content">
              <h3>Fully Featured</h3>
              <p>the lineblocs solution supports all the features of a modern communications system. our supported
                features include: call transfers, IVRs, find me, voicemail and more..</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col s4">
        <div class="card horizontal">
          <div class="card-stacked min">
            <div class="card-content">
              <h3>Reliable</h3>
              <p>
                get a UCaaS solution that is reliable and stays online 24/7. our solution is fully redundant and tested
                for mission critical needs
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col s4">
        <div class="card horizontal">
          <div class="card-stacked min">
            <div class="card-content">
              <h3>SIP trunking</h3>
              <p>
                use a elastic, scalable and tested SIP trunking cloud with full support for voice calls in US and
                Canada.
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="section no-bottom-margin more-padding contrast-bg-1" id="index-banner">
  <div class="container">
    <div class="row">
      <div class="col s8">
        <h2>Why Lineblocs ?</h2>
        <p>
          our solution is designed from bottom up using best technologies our cloud portal is here to help you make and
          receive
          more calls, manage your number network and quickly provision softphones / supported hardphones. as well as
          make use of Fax, IM and other
          PBX related features.
        </p>
      </div>
      <div class="col s4">
        <img width="100%" src="/img/frontend/ucaas-1.jpeg"></img>
      </div>
    </div>
  </div>
</div>

<div class="section no-bottom-margin more-padding white-bg" id="index-banner">
  <div class="container">
    <div class="row">
      <center>
        <h2>Features At A Glance</h2>
        <br />
        <br />
      </center>
      <div class="col s6 content min">
        <i class="material-icons prefix left h4-icon">event_available</i>
        <h4 class="left no-margins">High Availability</h4>
        <br />
        <br />
        <p>
          our network consist of best practice built from ground up using secure and up to date technologies.
          Our network is completel designed with the idea of never having to miss a call.
        </p>
      </div>
      <div class="col s6 content min">
        <i class="material-icons prefix left h4-icon">local_phone</i>
        <h4 class="left no-margins">Number Inventory</h4>
        <br />
        <br />
        <p>
          our number inventory consists of a farm of numbers across multiple regions in north america. We also offer
          number rental and management in one easy to use number management portal.
        </p>
      </div>
      <div class="col s6 content min">
        <i class="material-icons prefix left h4-icon">show_chart</i>
        <h4 class="left no-margins">Elastic Services</h4>
        <br />
        <br />
        <p>
          our cloud network is built using scale in mind. from our SIP internal network, user portals and backend
          services.
        </p>
      </div>
      <div class="col s6">
        <i class="material-icons prefix left h4-icon">update</i>
        <h4 class="left no-margins">Ease of Use</h4>
        <br />
        <br />
        <p>
          completely cloud and no need to install third party/open source software. our cloud portals and backend
          are designed to work
          with your call flow needs in mind and tested to run agaisnt with devices that you use for making /
          receiving calls.
        </p>
      </div>
    </div>
  </div>
</div>
<div class="section no-bottom-margin more-padding white-bg" id="index-banner">
  <div class="container">
    <div class="row">
      <center>
        <h2>Available In</h2>
        <br />
        <br />
      </center>
    </div>
  </div>
</div>
<div class="section no-bottom-margin more-padding contrast-bg-1" id="index-banner">
  <div class="container">
    <div class="row">
      <div class="col s8">
        <h2>Learn More</h2>
        <p>
          have queries regarding our services or offerings? feel free to contact us to learn more about it.
        </p>
        <a href="/contact" class="btn-custom service-btn">Learn More</a>
      </div>
      <div class="col s4">
        <img width="100%" src="/img/frontend/ucaas-4.jpeg"></img>
      </div>

    </div>

  </div>
</div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection