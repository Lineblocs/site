@extends('layouts.app_new', ['footer_cls' => 'no-margin'])
@section('title') Home :: @parent @endsection
@section('content')
    <!-- main -->
    <!-- <main class="landing" style="background:black"> -->
    <main class="landing">
      <header class="landing__header container">
        <h1 class="landing__title">
          Calling, IM and Fax Services <br />
          for {{$region['name']}}, {{$country['name']}}
        </h1>
        <p class="landing__undertext">
          browse for UCaaS services in over {{$region->countRateCenters()}} {{$region['name']}} regions.
        </p>
      </header>

      <!-- section generated with javascript inside of landing.js with data coming from landingData.js -->
      <section class="landing__benefits container"></section>

      <section class="landing__about">
        <div class="container">
          <div class="landing__about-content">
            <img
              class="landing_about-pattern-left"
              src="/img/landing/ucAt-pattern-left.svg"
              alt="about pattern left"
            />
            <img
              class="landing_about-pattern-right"
              src="/img/landing/ucAt-pattern-right.svg"
              alt="about pattern left"
            />
            <img
              class="landing__about-img"
              src="/img/landing/ucAt-work.svg"
              alt="work avatars and description"
            />
            <div class="landing__about-text">
              <img
                class="landing__about-avatar-1"
                src="/img/landing/avatar-1.svg"
                alt="avatar 1"
              />
              <img
                class="landing__about-avatar-2"
                src="/img/landing/avatar-2.svg"
                alt="avatar 2"
              />
              <img
                class="landing__about-avatar-3"
                src="/img/landing/avatar-3.svg"
                alt="avatar 3"
              />
              <img
                class="landing__about-avatar-4"
                src="/img/landing/avatar-4.svg"
                alt="avatar 4"
              />
              <img
                class="landing__about-avatar-5"
                src="/img/landing/avatar-5.svg"
                alt="avatar 5"
              />
              <h2>UC at work</h2>
              <p>
                Get a solution exclusively designed for modern teams. Our
                solution allows teams to connect to a fully managed UC service,
                designed and developed for modern teams.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- section generated with javascript inside of landing.js with data coming from landingData.js -->
      <section class="landing__features container">
        <h2>Features At A Glance</h2>
        <div class="landing__features-row"></div>
      </section>

      <section class="contact-form">
            <div class="inner-holder">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                           
                                <h2>Learn More</h2>
                                <p>Have queries regarding our offerings? Feel free to contact us.</p>

                                <form>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                          <input type="text" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-12 col-md-6">
                                          <input type="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <textarea class="form-control" id="textArea" placeholder="Message" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn button" type="submit">Send message</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <small id="ppInfo" class="text-muted">
                                                By clicking the button, you agree to Line block   
                                            </small>
                                        </div>
                                    </div>      
                                </form>
                            
                        </div>
                        <div class="col-12 col-md-6 mobile-hidden my-auto">
                            <img src="/images/cf-img.png" alt="Man" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
<script>
</script>
<script src="/js/components/landingData.js"></script>
<script src="/js/components/Landing.js"></script>
@endsection
