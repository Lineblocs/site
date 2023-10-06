@extends('layouts.app_new')
@section('title')
Contact
@endsection
@section('content')
    @if (Session::has('status'))
        <div class="blue-grey darken-1 thankyou">
            <center>
                <h5>{{Session::get('status')}}</h5>
            </center>
        </div>
    @else
        <div class="contact-page">
            <section class="heading">
                <h1>Contact</h1>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 column">
                            <div class="phone">
                                <p>The {{\App\Helpers\MainHelper::getSiteName()}} Team is here to help answer any questions you may have. Fill out the form or call us at:</p>
                                <a href="tel:{{$customizations->contact_phone_number}}">{{$customizations->contact_phone_number}}</a>
                            </div>

                            <div class="address">
                                <span>Address</span>
                                {!! nl2br($customizations->contact_address) !!}
                            </div>
                            <div class="email">
                                <span>E-mail</span>
                                <a href="mailto:{{$customizations->contact_email}}">{{$customizations->contact_email}}</a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 contact-form column">
                            <p>Have queries regarding our offerings? Feel free to contact us.</p>
                            <form method="POST" action="/contact" id="contactFrm">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="wrapper">
                                            <input name="first_name" id="first_name" type="text" class="validate no-special-chars form-control" minlength="1" maxlength="24" required="">
                                            <span class="placeholder">First Name</span>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="wrapper">
                                            <input name="last_name" id="first_name" type="text" class="validate no-special-chars form-control" minlength="1" maxlength="24" required="">
                                            <span class="placeholder">Last Name</span>
                                        </div>

                                    </div>
                                </div>
                               <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="wrapper">
                                            <input name="email" id="email" type="text" class="validate form-control" minlength="1" maxlength="24" required="">
                                            <span class="placeholder">Email</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="wrapper">
                                            <textarea name="comments" id="comments" class="materialize-textarea form-control" minlength="1" maxlength="1028" required="" rows="5"></textarea>
                                            <span class="placeholder">Message</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                        @if ($customizations->recaptcha_enabled)
                                            <button class="g-recaptcha btn button"
                                                    data-sitekey="{{$creds->recaptcha_site_key}}" 
                                                    data-callback='onSubmit' 
                                                    data-action='submit'>Send message</button>
                                        @else
                                            <button class="btn button" type="submit">Send message</button>
                                        @endif
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
                    </div>
                </div>
            </section>
        </div>
    @endif
@endsection
@section('scripts')
<script>
  $('input.no-special-chars').on('input', function() {
  $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
});
</script>
@if ($customizations->recaptcha_enabled)
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endif
<script>
   function onSubmit(token) {
     document.getElementById("contactFrm").submit();
   }
 </script>
@endsection
