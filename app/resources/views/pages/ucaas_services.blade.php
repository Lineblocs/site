@extends('layouts.main', ['footer_cls' => 'no-margin'])
@section('title') Home :: @parent @endsection
@section('content')
<div class="section no-bottom-margin more-padding region-landing-heading" id="index-banner">
  <div class="container">
    <center>
      <h2>Calling, IM and Fax Services for {{$region['name']}}, {{$country['name']}}</h2>
      <p>
        browse for UCaaS services in over {{$region->countRateCenters()}} {{$region['name']}} regions
      </p>
    </center>
    <div class="row">
      <div class="col s12 l6 xl4">
        <div class="card horizontal-rounded">
          <div class="card-stacked min">
            <div class="card-content">
              <h3>Fully Featured</h3>
              <p>
                Get a highly customizable communications solution that supports all the features of a modern communications system. 
                Lineblocs make it easy for your team to quickly deploy softphones, IVRs, and much more.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col s12 l6 xl4">
        <div class="card horizontal-rounded">
          <div class="card-stacked min">
            <div class="card-content">
              <h3>Integrations</h3>
              <p>
                Do more in less time using 100+ integrations developed for highly used SaaS apps. Our solution makes it simpler for you to add third party integrations to your phone system – including CRMs, e-commerce sites, and productivity apps.

              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col s12 l6 xl4">
        <div class="card horizontal-rounded">
          <div class="card-stacked min">
            <div class="card-content">
              <h3>Scalable PoPs</h3>
              <p>
                Get access to a highly available network, suitable for teams of all sizes. Our PoP network consists of over 30+ locations spread out across multiple regions, allowing small and medium sized team to quickly collaborate and make calls.
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="region-landing-work section no-bottom-margin more-padding contrast-bg-1" id="index-banner">
  <div class="container">
    <div class="row">
      <div class="col s12 l8">
        <h2>UC at work</h2>
        <p>
          Get a solution exclusively designed for modern teams. Our solution allows teams to connect to a fully managed UC service, designed and developed for modern teams.
        </p>
      </div>
      <div class="col s12 l4">
        <img width="100%" src="/img/frontend/ucaas-1.jpeg"></img>
      </div>
    </div>
  </div>
</div>

<div class="region-landing-features section no-bottom-margin more-padding white-bg" id="index-banner">
  <div class="container">
    <div class="row">
      <center>
        <h2>Features At A Glance</h2>
        <br />
        <br />
      </center>
      <div class="col s12 l6 content min">
        <i class="material-icons prefix left h4-icon">event_available</i>
        <h4 class="left no-margins">Low-Code</h4>
        <br />
        <br />
        <p>
          Design highly customizable workflows for calls, fax, and IM using our modern low-code based solutions.
        </p>
      </div>
      <div class="col s12 l6 content min">
        <i class="material-icons prefix left h4-icon">local_phone</i>
        <h4 class="left no-margins">Numbers on Demand</h4>
        <br />
        <br />
        <p>
          Self serve number rental and management in one easy to use number management portal.
        </p>
      </div>
      <div class="col s12 l6 content min">
        <i class="material-icons prefix left h4-icon">show_chart</i>
        <h4 class="left no-margins">High Availability</h4>
        <br />
        <br />
        <p>
          Distributed VoIP networking best on practices and created using secure technologies.
        </p>
      </div>
      <div class="col s12 l6 content min">
        <i class="material-icons prefix left h4-icon">update</i>
        <h4 class="left no-margins">All-In-One Portal</h4>
        <br />
        <br />
        <p>
          A fully featured user portal that allows you to quickly provision phones, extensions, call flows, and more.
        </p>
      </div>
    </div>
  </div>
</div>
<!--
<div class="section no-bottom-margin more-padding white-bg" id="index-banner">
  <div class="container">
    <div class="row">
      <center>
        <h2>Rate Centers In</h2>
        <br />
        <br />
      </center>
      @foreach ($region->getRateCenters() as $center)
      <div class="col s4 content min">
        <center>
          <h3>{{$center->name}}</h3>
        </center>
      </div>
      @endforeach
    </div>
  </div>
</div>
-->
<div class="region-landing-learn section no-bottom-margin more-padding contrast-bg-1" id="index-banner">
  <div class="container">
    <div class="row">
      <div class="col s12 l8">
        <h2>Learn More</h2>
        <p>
          Have queries regarding our offerings ? Feel free to contact us.
        </p>
        <a href="/contact" class="btn-custom service-btn">Learn More</a>
      </div>
      <div class="col s12 l4">
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
