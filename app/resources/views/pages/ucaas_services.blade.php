@extends('layouts.main', ['footer_cls' => 'no-margin'])
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

      <section class="landing__contact container">
        <div class="row">
          <div class="col s12 l6">
            <h2>Learn More</h2>
            <p class="landing__contact-description">
              Have queries regarding our offerings? feel free to contact us.
            </p>
            <form class="landing__form" action="/contactSubmit" method="POST">
              <div class="row">
                <div class="col s12 l6">
                  <input
                    type="text"
                    placeholder="First Name"
                    name="first_name"
                    minlength="2"
                    required
                  />
                </div>
                <div class="col s12 l6">
                  <input
                    type="text"
                    placeholder="Last Name"
                    name="last_name"
                    minlength="2"
                    required
                  />
                </div>
                <div class="col s12 l12">
                  <input type="email" placeholder="E-mail" name="email" required />
                </div>
                  <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                  <input type="hidden" name="comments" value=""/>
                  <input type="hidden" name="region" value="{{$region['name']}}"/>
                  <input type="hidden" name="country" value="{{$region['country']}}"/>
                  <input type="hidden" name="contact_reason" value="region_lead"/>
                  <input type="hidden" name="comments_not_required" value="1"/>
              </div>
              <textarea placeholder="Message"></textarea>
              <button type="submit">Send message</button>
              <p>
                <small>By clicking the button you agree to line block</small>
              </p>
            </form>
          </div>
          <div class="col s12 l6">
            <img src="/img/landing/learn-more.svg" alt="learn more image" />
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
