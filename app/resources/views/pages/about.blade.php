@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
  <div class="about-us-page">

    <section class="about-us-header full-section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 my-auto">
            <h1>About Lineblocs</h1>
            <p>The Lineblocs project was created as an alternative solution to existing cloud based unified communications. Our goal is to provide a highly customizable solution for calling, fax, IM, and video related needs.</p>
          </div>
          <div class="col-12 col-md-6 my-auto">
            <img src="/images/about-us.png" alt="" class="mobile-only img-fluid">
          </div>
        </div>
      </div>
    </section> {{-- .about-us-header --}}

    <section class="about-us-2 full-section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 my-auto">
            <img src="/images/cell-hand.png" alt="" class="img-fluid">
          </div>
          <div class="col-12 col-md-6 my-auto">
            <p>We believe that the communications solutions used in workplaces today should be completely customizable and cloud based. Our solutions focus on the calling system of tommorrow.</p>
            <p>In this modern era, we also strongly believe that a UC solution should include AI, cloud networking, and allow for complete customization.</p>
          </div>
        </div>
      </div>
    </section> {{-- .about-us-2 --}}

    <section class="values">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3>Our Values</h3>
          </div>
        </div>
        <div class="row">
          <div class="card-deck">
            <div class="card">
              <img class="" src="/images/icon-cloud.png" alt="Cloud icon">
              <div class="card-body">
                <h5 class="card-title">Focus</h5>
                <p class="card-text">We design solutions for teams that prefer using the cloud. Our solutions are completely developed to enhance inter-team productivity and offer rich experiences for calling, IM, and video.</p>
              </div>
            </div>
            <div class="card">
              <img class="" src="/images/development.png" alt="Cloud icon">
              <div class="card-body">
                <h5 class="card-title">Dedicated</h5>
                <p class="card-text">We are dedicated to offering the best low-code solutions that enable teams to quickly create modern UC workflows in the cloud – using cutting edge technologies – in little time.</p>
              </div>
            </div>
            <div class="card">
              <img class="" src="/images/group.png" alt="Cloud icon">
              <div class="card-body">
                <h5 class="card-title">Cloud Solutions</h5>
                <p class="card-text">We are focused on improving cloud related unified communications by offering an innovative and up to date solution that can be easily integrated into business workflows of all sizes.</p>
              </div>
            </div>


          </div>
        </div>

      </div>
    </section> {{-- .values--}}

  </div> {{-- .about-us-page --}}

 @endsection
