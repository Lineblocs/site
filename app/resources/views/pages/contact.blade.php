@extends('layouts.app_new')
@section('title') Home :: @parent @endsection
@section('content')
    <div class="contact-page">
        <section class="heading">
            <h1>Contacts</h1>
            @if (Session::has('status'))
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">{{Session::get('status')}}</span>
                    </div>
                </div>
            @endif
        </section>
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 column">
                        <div class="phone">
                            <p>The Lineblocs Team is here to help answer any questions you may have. Fill out the form or call us at:</p>
                            <a href="tel:+1 888 980 9750">+1 888 980 9750</a>
                        </div>

                        <div class="address">
                            <span>Address</span>
                            <p>First Edmonton Place <br/>10665 Jasper Avenue<br/>Suite 1412</p>
                        </div>
                        <div class="email">
                            <span>E-mail</span>
                            <a href="mailto:sales@lineblocs.com">sales@lineblocs.com</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 contact-form column">
                        <p>Have queries regarding our offerings? Feel free to contact us.</p>
                        <form method="POST" action="/contactSubmit">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="wrapper">
                                        <input name="first_name" id="first_name" type="text" class="validate no-special-chars form-control" minlength="1" maxlength="24" required="">
                                        <span class="placeholder">Name</span>
                                    </div>

                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="wrapper">
                                        <input name="email" id="email" type="email" class="validate form-control" minlength="1" maxlength="128" required="" >
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
                </div>
            </div>
        </section>
    </div>

@endsection
@section('scripts')
<script>
  $('input.no-special-chars').on('input', function() {
  $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
});
</script>
@endsection
