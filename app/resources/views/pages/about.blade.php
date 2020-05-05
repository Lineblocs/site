@extends('layouts.main', ['footer_cls' => 'no-margin'])
@section('title') Home :: @parent @endsection
@section('content')
<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h2>About Us</h2>
        <hr />
        <p>
          Lineblocs was created to offer an alternative solution to traditional communications systems and existing
          cloud based
          communications systems. Our goal currently is to provide an open solution for calling, IM and video for small
          to medium sized businesses using the cloud.
          <br />
          <br />
          We believe that the communications between workspaces today should be customizable and cloud
          based. Our solutions focus on the
          calling system of tommorrow.
          <br />
          <br />
          We feel that a modern communications system should include AI, cloud networking, portability, and allow for
          complete customization.
        </p>
      </div>
    </div>
  </div>
</div>
    <div class="section no-bottom-margin more-padding contrast-bg-1">
      <div class="container with-margin">
        <div class="row">
          <br />
          <center>
            <h2>Our Values</h2>
          </center>
          <div class="col s4">
            <div class="card horizontal">
              <div class="card-stacked min">
                <div class="card-content">
                  <h3>Focus</h3>
                  <p>
                    We design solutions for small business teams that prefer the cloud. Our team and tools are developed
                    to enhance inter team productivity and also offer rich experiences for calling, IM and video
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card horizontal">
              <div class="card-stacked min">
                <div class="card-content">
                  <h3>Dedicated</h3>
                  <p>
                    we are dedicated to offerring the best SLA and uptime with a unique coverage of VoIP networking in
                    Canada.
                    our solutions are backed by tier-1 carriers and a reputable partner ecosystem.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card horizontal">
              <div class="card-stacked min">
                <div class="card-content">
                  <h3>Cloud Solutions</h3>
                  <p>
                    we are creating olutions for the cloud and companies that want to use the cloud. we are focused on
                    improving
                    cloud communications by offering an innovative and up to date communications solution
                  </p>
                </div>
              </div>
            </div>
          </div>
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