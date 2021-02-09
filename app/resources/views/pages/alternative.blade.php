@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
<div class="analysis-page">
  <section class="analysis-header full-section">

    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7 my-auto">
          <h1>Best alternative to&nbsp;RingCentral</h1>
          <p>Many customers rely on Lineblocs to make high quality voice calls, integrate IM solutions, and connect via video.</p>
          <a href="#get-started" class="button btn primary-button bg-blue">Get started in 30 seconds</a>
          <a href="#get-started" class="button btn secondary-button">Talk To Our Sales Team</a>
        </div>
        <div class="col-12 col-md-5 my-auto">
          <img src="/images/analysis-header.png" alt="" class="mobile-only img-fluid">
        </div>
      </div>
    </div>
  </section> {{-- .analysis-header --}}
  <section class="analysis-2 full-section">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-5 mt-4">
          <h2>Trusted by great brands worldwide</h2>
        </div>
        <div class="col-12 col-md-7 my-auto">
          <div class="row">
            <div class="col text-center d-flex image">
              <img src="/images/Google.png" alt="Google" class="mx-auto my-auto">
            </div>
            <div class="col text-center d-flex image">
              <img src="/images/Capterra.png" alt="Capterra" class="mx-auto my-auto">
            </div>
            <div class="col text-center d-flex image">
              <img src="/images/G2Crowd.png" alt="G2Crowd" class="mx-auto my-auto">
            </div>
          </div>
          <div class="row">
            <div class="col text-center d-flex image">
              <img src="/images/Google.png" alt="Google" class="mx-auto my-auto">
            </div>
            <div class="col text-center d-flex image">
              <img src="/images/Capterra.png" alt="Capterra" class="mx-auto my-auto">
            </div>
            <div class="col text-center d-flex image">
              <img src="/images/G2Crowd.png" alt="G2Crowd" class="mx-auto my-auto">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> {{-- .analysis-2 --}}
  <section class="overview">
    <div class="inner-holder">
      <div class="container">
        <div class="row">
          <div class="col-12 heading">
            <h2 class="text-left">Why Businesses <span>choose Lineblocs?</span></h2>
          </div>

        </div>

        <div class="row ov-row">
          <div class="col-12 col-md-6">
            <div class="ov-block">
              <div class="row">
                <div class="col-12 col-lg-2 icon-holder my-auto">
                  <img src="/images/icon-fully-featured.png" alt="" class="icon">
                </div>
                <div class="col-12 col-lg-10 heading">
                  <h3>Fully Featured</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-lg-10 offset-lg-2 content">
                  <p>Get a highly customizable communications solution that supports all the features of a modern communications system. Lineblocs make it easy for your team to quickly deploy softphones, IVRs, and much more.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="ov-block">
              <div class="row">
                <div class="col-12 col-lg-2 icon-holder my-auto">
                  <img src="/images/icon-rocket.png" alt="" class="icon">
                </div>
                <div class="col-12 col-lg-10 heading">
                  <h3>Integrations</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-lg-10 offset-lg-2 content">
                  <p>Do more in less time using 100+ integrations developed for highly used SaaS apps. Our solution makes it simpler for you to add third party integrations to your phone system – including CRMs, e-commerce sites, and productivity apps.</p>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="row ov-row">
          <div class="col-12 col-md-6">
            <div class="ov-block">
              <div class="row">
                <div class="col-12 col-lg-2 icon-holder my-auto">
                  <img src="/images/icon-scalable.png" alt="" class="icon">
                </div>
                <div class="col-12 col-lg-10 heading">
                  <h3>Scalable pops</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-lg-10 offset-lg-2 content">
                  <p>Get access to a highly available network, suitable for teams of all sizes. our pop network consists of over 30+ locations spread out across multiple regions, allowing small and medium sized team to quickly collaborate and make calls.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="ov-block">
              <div class="row">
                <div class="col-12 col-lg-2 icon-holder my-auto">
                  <img src="/images/coins.png" alt="" class="icon">
                </div>
                <div class="col-12 col-lg-10 heading">
                  <h3>Flexible Pricing</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-lg-10 offset-lg-2 content">
                  <p>Get long term discounts on voice, fax, and IM. Save on total calling costs by using a completely flexible pricing model, which includes on demand prciing as well as dedicated calling terms.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 buttons-row">
            <a href="#prices" class="button btn primary-button bg-blue">View Full Pricing Comparison</a>
            <a href="#get-started" class="button btn secondary-button">Request A Quote</a>
          </div>
        </div>
      </div>
    </div>
  </section> {{-- .overview--}}
  <section class="solutions full-section">
    <div class="inner-holder">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-5">
            <h2>Completely Integrated Solutions</h2>
            <p>Get access to completely integrated soltions so you can track your calls anywhere.</p>
          </div>
          <div class="col-12 col-lg-3 offset-lg-1">
            <h3>Calling Features</h3>
            <ul>
              <li class="checked d-flex">
                Auto Attendents
              </li>
              <li class="checked d-flex">
                Recording Transcrptions
              </li>
              <li class="not-checked d-flex">
                Conferences
              </li>
              <li class="not-checked d-flex">
                Conferences
              </li>
            </ul>
          </div>
          <div class="col-12 col-lg-3">
            <h3>Integration</h3>
            <ul>
              <li class="checked d-flex">
                CRM
              </li>
              <li class="checked d-flex">
                ERP
              </li>
              <li class="not-checked d-flex">
                Calendars
              </li>
              <li class="not-checked d-flex">
                E-mail
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section> {{-- .solutions --}}
  <section class="contact-form">
    <div class="inner-holder">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6">

            <h2>Talk to us</h2>
            <p>If you would like to learn more about Lineblocs, please get in touch with us today. We can help you find calling solutions based on your team's size, budget, and specific needs.</p>

            <form>
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="wrapper">
                    <input type="text" class="form-control" >
                    <span class="placeholder">Name</span>
                  </div>

                </div>
                <div class="col-12 col-md-6">
                  <div class="wrapper">
                    <input type="email" class="form-control" >
                    <span class="placeholder">Email</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="wrapper">
                    <textarea class="form-control" id="textArea" rows="5"></textarea>
                    <span class="placeholder">Message</span>
                  </div>
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
            <img src="/images/analysis-cf.png" alt="Man" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </section> {{-- .contact-form --}}
  <section class="faq">
    <div class="container">
      <div class="row heading">
        <div class="col-12">
          <h2 class="text-center">FAQs</h2>
        </div>
      </div>
      <div class="row list-faqs" >

        <div class="accordion" id="accordion">
          <div class="card">
            <div class="card-header" id="heading1">
              <h2 class="mb-0">
                <button class="btn btn-link pl-0" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                  What does it cost to create a Lineblocs account?
                </button>
              </h2>
            </div>

            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion">
              <div class="card-body">
                Creating an account is free. However when you create a Lineblocs account you are only given a 10 day evaluation period – regardless of membership type – which covers basic calling, setting up extensions, and using the user portal.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="heading2">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed pl-0" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                  Which countries do you offer services for?
                </button>
              </h2>
            </div>
            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
              <div class="card-body">
                At this time Lineblocs only offers services to valid residents based in North America.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="heading3">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed pl-0" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                  Is Lineblocs a CPaaS?
                </button>
              </h2>
            </div>
            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
              <div class="card-body">
                No Lineblocs is not not a CPaaS. However we do provide calling, fax, and IM related services
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="heading4">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed pl-0" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                  Can I port my phone number to Lineblocs?
                </button>
              </h2>
            </div>
            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
              <div class="card-body">
                Yes, you are able to port numbers to Lineblocs. You can learn more about porting numbers in the Porting Numbers guide.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="heading5">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed pl-0" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                  Does lineblocs offer an API like Twilio or Plivo?
                </button>
              </h2>
            </div>
            <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
              <div class="card-body">
                No, we currently do not offer a CPaaS type of API.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="heading6">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed pl-0" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                  Does Lineblocs offer toll free numbers?
                </button>
              </h2>
            </div>
            <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
              <div class="card-body">
                Yes you can currently purchase toll free numbers in the Lineblocs dashboard.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="heading7">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed pl-0" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                  Does Lineblocs offer SMS services?
                </button>
              </h2>
            </div>
            <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
              <div class="card-body">
                No we do not currently have any SMS service. Lineblocs currently only supports voice, fax, and IM.
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section> {{-- .faq--}}
  <section class="reviews">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Public Reviews</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <a href="https://www.trustpilot.com/evaluate/lineblocs.com" target="_blank" title="Lineblocs on Trustpilot">
            <img src="/images/trustpilot_reviews.png" alt="" class="img-fluid my-auto">
          </a>
        </div>
        <div class="col-12 col-md-6">
          <a href="https://www.g2.com/products/lineblocs/reviews" target="_blank" title="Lineblocs on G2Crowd">
            <img src="/images/g2crowd_reviews.png" alt="" class="img-fluid my-auto">
          </a>
        </div>
      </div>
    </div>
  </section> {{--.reviews --}}
  <section class="cta-block">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 my-auto">
          <h2>Get Started</h2>
          <p>Get up and going with one of our calling solutions today — it's easy.</p>
        </div>
        <div class="col-12 col-lg-3 my-auto">
          <a href="#get-started" class="button btn primary-button bg-blue">Get started now</a>

        </div>
        <div class="col-12 col-lg-3 my-auto">
          <a href="#request-quote" class="button btn secondary-button">Request A Quote</a>
        </div>
      </div>
    </div>
  </section> {{-- .cta-block--}}
</div> {{-- .analysis-page --}}
@endsection
@section('scripts')
<script>
</script>
@endsection