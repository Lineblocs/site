@extends('layouts.main')
@section('title') Home :: @parent @endsection
@section('content')
  <div class="section no-pad-bot contrast-bg-1" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center">{{$content['main']['heading']}}</h1>
      <div class="row center">
        <h5 class="header col s12 light">{{$content['main']['text']}}</h5>
      </div>
      <div class="row center">
        <a href="{{url('/pricing')}}" id="download-button" class="btn-large waves-effect waves-light blue-btn">View Pricing</a>
      </div>
      <br><br>

    </div>
  </div>

  <div class="section no-pad-bot white-bg" id="sub-content">
    <div class="container">
      <div class="section">

        <!--   Icon Section   -->
        <div class="row">
          <div class="col s12 m4">
            <div class="icon-block">
              <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
              <h5 class="center">{{$content['blocks']['one']['title']}}</h5>

              <p class="light">
                  {{$content['blocks']['one']['text']}}
              </p>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="icon-block">
              <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
              <h5 class="center">{{$content['blocks']['two']['title']}}</h5>

              <p class="light">
                  {{$content['blocks']['two']['text']}}
              </p>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="icon-block">
              <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
              <h5 class="center">{{$content['blocks']['three']['title']}}</h5>

              <p class="light">
                  {{$content['blocks']['three']['text']}}
              </p>
            </div>
          </div>
        </div>

      </div>
      <br><br>
    </div>
  </div>
    <div class="section no-pad-bot contrast-bg-1" id="index-banner">
      <div class="container">
        <center>
          <h5>Some Comparision</h5>
          <p>
            below is a list of features popular alternatives like RingCentral or SIP gate offer and the ones LineBlocs includes
          </p>
      <table>
              <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Grasshopper</th>
                    <th>RingCentral</th>
                    <th>LineBlocs</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Unlimited Calls (between extensions)</td>
                  <td>
                    Not Supported
                  </td>
                  <td>
                    Not Supported
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                </tr>
                <tr>
                  <td>Unlimited Concurrent Calling</td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                </tr>
                <tr>
                  <td>Cloud Web Portal</td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                </tr>
                <tr>
                  <td>Cloud Drag and Drop editor</td>
                  <td>
                    Not Supported
                  </td>
                  <td>
                    Not Supported
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                </tr>
                <tr>
                  <td>Inbound Call Blocking</td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    Not Supported
                  </td>
                </tr>
                <tr>
                  <td>Voicemail to email</td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    Not Supported
                  </td>
                </tr>
                <tr>
                  <td>IVR</td>
                  <td>
                    Not Supported
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                </tr>
                <tr>
                  <td>Recordings</td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                </tr>
                <tr>
                  <td>Call Reporting</td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                  <td>
                    <i class="material-icons">check_circle</i>
                  </td>
                </tr>
              </tbody>
            </table>
      </div>
    </div>
@endsection

