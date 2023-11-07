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
                <h1>Bug Report</h1>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-12 contact-form quote">
                        <div class="alert alert-info" role="alert">
                            Please let us know more about the issue and one of our team members will get back to you with a response within 48-72 hours
                        </div>
                            <form method="POST" action="/quote" id="quoteFrm">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="wrapper">
                                            <input name="first_name" id="first_name" type="text" class="validate no-special-chars form-control" minlength="1" maxlength="24" required="">
                                            <span class="placeholder">First Name</span>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="wrapper">
                                            <input name="last_name" id="last_name" type="text" class="validate no-special-chars form-control" minlength="1" maxlength="24" required="">
                                            <span class="placeholder">Last Name</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="wrapper">
                                            <input name="phone" id="phone" type="tel" class="validate form-control" minlength="1" maxlength="24" required="">
                                            <span class="placeholder">Phone Number</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="wrapper dropdown-box">
                                            <select name="bug_type" id="bug_type" type="select" class="form-control" required="">
                                                <option value="">Select bug type</option>
                                                @foreach ($bugTypes as $key => $option)
                                                    <option value="{{$key}}">{{$option}}</option>
                                                @endforeach
                                            </select>
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
                                                    data-sitekey="{{$creds->recaptcha_sitekey}}" 
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
     document.getElementById("quoteFrm").submit();
   }
 </script>
@endsection
