@extends('layouts.main')
@section('title') Home :: @parent @endsection
@section('content')
<div class="section no-bottom-margin more-padding" id="index-banner">
  <div class="container">
    <h1>FAQs</h1>
    <ul>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>What does it cost to create a Lineblocs account ?</h2>
              <p>creating a lineblocs account is free of charge. when you sign up you will be assigned a 10 day free
                trial
                membership which covers basic calling, setting up extensions and testing. trial accounts do have
                restrictions however. for more info on restrictions please read <a
                  href="https://lineblocs.com/resources/other-topics/learn-trial">Trial Balance</a></p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Which countries do you offer services for ?</h2>

              <p>at this time lineblocs only offers DID rentals and calling services to valid residents in US or Canada.
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Is lineblocs a CPaaS ?</h2>
              <p>
                no we are not a CPaaS. although we provide services that a CPaaS would offer as well as include parts of
                the
                experience
                a UCaaS would offer. lineblocs however is not a CPaaS.
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Can I port my phone number to lineblocs ?</h2>
              <p>
                yes you are able to port numbers to lineblocs. you can learn more about porting numbers in article <a
                  href="https://lineblocs.com/resources/managing-numbers/porting-numbers">Porting Numbers</a>. We
                currently
                offer porting number services to any region / rate center our upstream carrier(s) support. for a list of
                rate
                centers we support please see read <a href="https://lineblocs.com/resources/other-topics">Available Rate
                  Centers</a>
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Does lineblocs offer an API like twilio or plivo ?</h2>
              <p>
                no we currently do not offer a CPaaS type of API. although we do offer a solution to integrate CPaaS
                type
                functionality through our
                typescript/javascript SDKs. for an example of using our SDK please read <a
                  href="https://lineblocs.com/resources/quickstarts/getting-started-typescript-sdk">Using the Typescript
                  SDK</a>
              </p>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Does lineblocs offer toll free numbers ?</h2>
              <p>
                yes we offer rental for both local and toll free numbers to residents in US and Canada.
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Does lineblocs offer SMS services ?</h2>
              <p>
                no we do not currently have any SMS service. our service only supports voice
              </p </div> </div> </div> </li> <li>
              <div class="card horizontal-rounded">
                <div class="card-stacked">
                  <div class="card-content">
                    <h2>Do lineblocs services include fax and IM ?</h2>
                    <p>currently we do not support fax or IM. but we do offer integrations for fax and IM with
                      lineblocs. for a list
                      of integrations please see:
                      <a href="https://lineblocs.com/integrations">Lineblocs Integrations</a></p>
                  </div>
                </div>
              </div>
      </li>
    </ul>
    <p>
      for more topics and support please view our <a href="https://lineblocs.com/resources">Resources</a> section
    </p>



  </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection