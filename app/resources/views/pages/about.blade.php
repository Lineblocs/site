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
          The Lineblocs project was created as an alternative solution to existing cloud based unified communications. Our goal is to provide a highly customizable solution for calling, fax, IM, and video related needs.
          <br />
          <br />
          We believe that the communications solutions used in workplaces today should be completely customizable and cloud based. Our solutions focus on the calling system of tommorrow.
          <br />
          <br />
          In this modern era, we also strongly believe that a UC solution should include AI, cloud networking, and allow for complete customization.
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
            <div class="card horizontal-rounded">
              <div class="card-stacked min">
                <div class="card-content">
                  <h3>Focus</h3>
                  <p>
                    We design solutions for teams that prefer using the cloud. Our solutions are completely developed
                    to enhance inter-team productivity and offer rich experiences for calling, IM, and video.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card horizontal-rounded">
              <div class="card-stacked min">
                <div class="card-content">
                  <h3>Dedicated</h3>
                  <p>
                    We are dedicated to offerring the best low-code solutions that enable teams to quickly create modern UC workflows in the cloud – using cutting edge technologies – in little time.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card horizontal-rounded">
              <div class="card-stacked min">
                <div class="card-content">
                  <h3>Cloud Solutions</h3>
                  <p>
                   We are focused on improving cloud related unified communications by offering an innovative and up to date solution that can be easily integrated into business workflows of all sizes.
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