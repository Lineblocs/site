@extends('layouts.main_alt')
@section('title') Home :: @parent @endsection
@section('content')
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center">{{$content['main']['heading']}}</h1>
      <div class="row center">
        <h5 class="header col s12 light">{{$content['main']['text']}}</h5>
      </div>
      <div class="row center pricing">
        <form name="pricing" method="GET" action="/rates">
          <h4>Select Calling Country</h4>
          <select name="country" id="countries">
            <option value="" disabled selected>Select Calling Country</option>
            @foreach ($content['rates'] as $rate)
              @if (isset($selected) && $selected['country']['code'] == $rate['country']['code'])
                <option selected="selected" value="{{$rate['country']['code']}}">{{$rate['country']['name']}}</option>
              @else
                <option value="{{$rate['country']['code']}}">{{$rate['country']['name']}}</option>
              @endif
              @endforeach
             <label>Country</label>
          </select>
        </form>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">
      @if (isset($selected))
        <h4 class="pricing-hdg">Calling rates for {{$selected['country']['name']}}</h4>
        <br/>
        <div class="pricing-tables">
          <table class="striped">
            <thead>
              <tr>
                <td>Type Of Number</td>
                <td>Inbound Calling</td>
                <td>Outbound Calling</td>
                <td>Recordings Per Min</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Local</td>
                <td>{{$selected['voice']['local']['inbound_per_min']}}</td>
                <td>{{$selected['voice']['local']['outbound_per_min']}}</td>
                <td>{{$selected['voice']['local']['recording_per_min']}}</td>
              </tr>
              <tr>
                <td>Toll Free</td>
                <td>{{$selected['voice']['toll-free']['inbound_per_min']}}</td>
                <td>{{$selected['voice']['toll-free']['outbound_per_min']}}</td>
                <td>{{$selected['voice']['toll-free']['recording_per_min']}}</td>
              </tr>

            </tbody>
          </table>
          <h4 class="pricing-hdg">Storage pricing for {{$selected['country']['name']}}</h4>
          <br/>
          <table class="striped">
            <thead>
              <tr>
                <td>Type Of Number</td>
                <td>Recording Per Min</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>All</td>
                <td>{{$selected['voice']['all']['recording_per_min']}}</td>
              </tr>
            </tbody>
          </table>
          <h4 class="pricing-hdg">Number rental pricing for {{$selected['country']['name']}}</h4>
          <br/>
          <table class="striped">
            <thead>
              <tr>
                <td>Type Of Number</td>
                <td>Monthly Cost</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Local</td>
                <td>{{$selected['voice']['local']['rental_per_month']}}</td>
              </tr>
              <tr>
                <td>Toll Free</td>
                <td>{{$selected['voice']['toll-free']['rental_per_month']}}</td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col s8">
            <h2>Learn More</h2>
            <p>
              have queries regarding our services or offerings? feel free to contact us to learn more about it.
            </p>
            <a href="/contact" class=" btn-custom service-btn margin-unset">Contact Us</a>
          </div>
          <div class="col s4">
            <img width="100%" src="./img/frontend/img-4.jpg"></img>
          </div>
        </div>

        @endif
    </div>
    <br><br>
  </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
      $('select').formSelect();
      var select = $("#countries");
      var form = document.forms['pricing'];
      $(select).change(function() {
          form.submit();
      });
   });
        
</script>
@endsection
