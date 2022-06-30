@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
  <div class="container faq">
    <div class="row heading">
      <div class="col-12">
        <h1 class="text-center">FAQs</h1>
        <p class="text-center">Pricing options suitable for teams of all sizes</p>
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
                Does Lineblocs offer an API like Twilio?
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
    <div class="row cta-block">
      <div class="d-flex p-4">
        <img src="/images/hand-settings.png" alt="Icon Hand Settings" class="icon img-fluid my-auto">
        <p>For more topics and support please view our <a href="/resources">Resources section</a></p>
      </div>
    </div>
  </div>
{{--<div class="faq section no-bottom-margin more-padding" id="index-banner">
  <div class="container">
    <h1>FAQs</h1>
    <ul>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>What does it cost to create a Lineblocs account ?</h2>
              <p>Creating an account is free. However when you create a Lineblocs account you are only given a 10 day
                evaluation period – regardless of membership type – which covers basic calling, setting up extensions,
                and using the user portal.</p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Which countries do you offer services for ?</h2>

              <p>At this time Lineblocs only offers services to valid residents based in North America.
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Is Lineblocs a CPaaS ?</h2>
              <p>
                No Lineblocs is not not a CPaaS. However we do provide calling, fax, and IM related services
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Can I port my phone number to Lineblocs ?</h2>
              <p>
                Yes, you are able to port numbers to Lineblocs. You can learn more about porting numbers in the <a
                  href="https://lineblocs.com/resources/managing-numbers/porting-numbers">Porting Numbers</a> guide.
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Does lineblocs offer an API like Twilio or Plivo ?</h2>
              <p>
                No, we currently do not offer a CPaaS type of API.
              </p>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Does Lineblocs offer toll free numbers ?</h2>
              <p>
                Yes you can currently purchase toll free numbers in the Lineblocs dashboard.
              </p>

            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="card horizontal-rounded">
          <div class="card-stacked">
            <div class="card-content">
              <h2>Does Lineblocs offer SMS services ?</h2>
              <p>
                No we do not currently have any SMS service. Lineblocs currently only supports voice, fax, and IM.
              </p </div> </div> </div> </li> 
    </ul>
    <p>
      For more topics and support please view our <a href="https://lineblocs.com/resources">Resources</a> section
    </p>



  </div>
</div>--}}
@endsection
@section('scripts')
<script>
</script>
@endsection