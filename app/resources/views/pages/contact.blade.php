
@extends('layouts.main_alt')
@section('title') Home :: @parent @endsection
@section('content')
  <div class="contact section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="row">
        <div class="col s12">
            <h2>Contact Us</h2>
            @if (Session::has('status'))
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">{{Session::get('status')}}</span>
                  </div>
                </div>
            @endif
            <form method="POST" action="/contactSubmit">
                <div class="row">
                    <div class="input-field col s12 l4">
                        <input name="first_name" id="first_name" type="text" class="validate no-special-chars" minlength="1" maxlength="24" required="">
                        <label for="first_name">First Name</label>
                    </div>
                  </div>
                <div class="row">
                    <div class="input-field col s12 l4">
                        <input name="last_name" id="last_name" type="text" class="validate no-special-chars" minlength="1" maxlength="24" required="">

                        <label for="last_name">Last Name</label>
                    </div>
                  </div>
                <div class="row">
                    <div class="input-field col s12 l4">
                        <input name="email" id="email" type="email" class="validate" minlength="1" maxlength="128" required="">

                        <label for="email">Email</label>
                    </div>
                  </div>
                <div class="row">
                    <div class="input-field col s12 l4">
                        <textarea name="comments" id="comments" class="materialize-textarea" minlength="1" maxlength="1028" required=""></textarea>
                        <label for="comments">Comments</label>
                    </div>
                  </div>
                <div class="row relative">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="col s12">
                      <div class="left margin-right-10">
                          <button type="submit" class="btn-custom service-btn"><span>Send</span></button>
                      </div>
                      <div class="left">
                          <a href="#" id="resetBtn">Reset</a>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $('input.no-special-chars').on('input', function() {
  $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
});
$("#resetBtn").click(function() {
  $("#first_name").val("");
  $("#last_name").val("");
  $("#email").val("");
  $("#comments").val("");

});
</script>
@endsection
