@extends('layouts.main')
@section('title') Home :: @parent @endsection
@section('content')
  <div class="section no-bottom-margin more-padding" id="index-banner">
    <div class="container">
      <center>
        <h2>Our Services</h2>
      </center>
      <div class="row">
        <div class="col s4">
          <div class="card horizontal">
            <div class="card-stacked min">
              <div class="card-content">
                <h5>Call Flow Builder</h5>
                <p>
                  We host a call flow builder that lets you design and test the most complex call flows and provision
                  them with your DIDs in seconds.
                  Our call flows enable you to get up and running in seconds and are built on high security along with
                  best practice for call routing and failover.
                </p>
              </div>
              <div class="card-action">
                <a class="/features/call-flow-builder">Learn More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card horizontal">
            <div class="card-stacked min">
              <div class="card-content">
                <h5>DID number portal</h5>
                <p>
                  our DID number portal is designed for ease of use and cloud related needs. easily rent numbers from
                  US or Canada and
                  assign them to call flows on your account.
                </p>
              </div>
              <div class="card-action">
                <a class="/features/did-manage">Learn More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card horizontal">
            <div class="card-stacked min">
              <div class="card-content">
                <h5>PoP and availability</h5>
                <p>
                  Our PoP network lets you quickly provision phones near you and your users. Get up and running with a
                  PoP nearest to your location and switch
                  among PoPs most suitable to your needs.
                </p>
              </div>
              <div class="card-action">
                <a class="/features/did-manage">Learn More</a>
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
          <h5>Overcome Challenges with existing on-premise PBX systems</h5>
          <p>
            designed from bottom up using best technologies our cloud portal is here to help you make and receive
            more calls, manage your number network and quickly provision softphones / supported hardphones.
          </p>
          <a href="/contact" class="waves-effect waves-light btn btn-large blue-btn">Learn More</a>
        </div>
        <div class="col s4">
          <img width="100%" src="./img/frontend/img-2.jpg"></img>
        </div>
      </div>
    </div>
  </div>

    <div class="section no-bottom-margin more-padding white-bg" id="index-banner">
    <div class="container">
      <div class="row">
        <center>
          <h5>An Overview</h5>
          <p>
            below is a list of key features supported on our cloud to help you understand why using lineblocs may be of
            benefit to your
            needs.
          </p>
        </center>
          <div class="col s6 content min">
            <i class="material-icons prefix left h4-icon">event_available</i>
            <h4 class="left no-margins">High Availability</h4>
            <br/>
            <br/>
            <p>
              our network consist of best practice built from ground up using secure and up to date technologies.
              Our network is completel designed with the idea of never having to miss a call.
            </p>
          </div>
          <div class="col s6 content min">
            <i class="material-icons prefix left h4-icon">local_phone</i>
            <h4 class="left no-margins">Number Inventory</h4>
            <br/>
            <br/>
            <p>
              our number inventory consists of a farm of numbers across multiple regions in north america. We also offer
              number rental and management in one easy to use number management portal.
            </p>
          </div>
          <div class="col s6 content min">
            <i class="material-icons prefix left h4-icon">show_chart</i>
            <h4 class="left no-margins">Elastic Services</h4>
            <br/>
            <br/>
            <p>
              our cloud network is built using scale in mind. from our SIP internal network, user portals and backend
              services.
            </p>
          </div>
          <div class="col s6">
            <i class="material-icons prefix left h4-icon">update</i>
            <h4 class="left no-margins">Ease of Use</h4>
            <br/>
            <br/>
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

    <div class="section no-bottom-margin more-padding contrast-bg-1" id="index-banner">
    <div class="container">
      <div class="row">
        <div class="col s8">
          <h2>Learn More</h2>
          <p>
            have queries regarding our services or offerings? feel free to contact us to learn more about it.
          </p>
          <a class="waves-effect waves-light btn btn-large blue-btn">Contact Us</a>
        </div>
        <div class="col s4">
          <img width="100%" src="./img/frontend/img-3.jpg"></img>
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
