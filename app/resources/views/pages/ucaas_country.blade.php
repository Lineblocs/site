@extends('layouts.main', ['footer_cls' => 'no-margin'])
@section('title') Home :: @parent @endsection
@section('content')
<div class="section no-bottom-margin more-padding white-bg clearfix" id="index-banner">
  <div class="container">
    <center>
      <h1>Calling, IM and Fax Services in {{$data['name']}}</h1>
      <p>
        browse for UCaaS services in {{$data['regions_pretty']}}
      </p>
      <div class="row">
        <div class="col s4 content min">
          <div class="card horizontal">
            <div class="card-stacked">
              <div class="card-content">
                <i class="material-icons prefix h4-icon">local_phone</i>
                <h4>Voice Calls</h4>
                <p>
                  get complete coverage of incoming and outgoing voice calls in your region. leverage our voice network to get maximum cost savings and calling throughout {{$data['name']}}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col s4 content min">
          <div class="card horizontal">
            <div class="card-stacked">
              <div class="card-content">
                <i class="material-icons prefix h4-icon">sms</i>
                <h4>Collaboration & IM</h4>
                <p>
                  get access to complete IM integrations using our connectors for services like Microsoft teams. get you and your in sync with real time, business related IM tools developed for SMEs.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col s4 content min">
          <div class="card horizontal">
            <div class="card-stacked">
              <div class="card-content">
                <i class="material-icons prefix h4-icon">wallpaper</i>
                <h4>Fax, Video and more</h4>
                <p>
                  add Fax, peer to peer Video, social media and other tools in your organization's workflow. keep up to date with a set of
                  tools made for the modern SMB.
                </p>
              </div>
            </div>
          </div>
        </div>
    </center>
  </div>
</div>
  <div class="section no-bottom-margin more-padding contrast-bg-1" id="index-banner">
    <div class="container">
      <div class="row">
        <center>
          <h1>We Offer Services For</h1>
          <p>
            below are a list of provinces we offer services to
          </p>
        </center>
      </div>
      <div class="row">
        <br/>
        <br/>
        <center>
          @foreach ($data['regions'] as $code => $region)
          <div class="col s4">
            <h3><a href="/ucaas/{{$country}}/{{$code}}">{{$region['name']}}</a></h3>
          </div>
          @endforeach
        </center>
      </div>
    </div>
  </div>
</div>
<div class="section no-bottom-margin more-padding white-bg" id="index-banner">
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