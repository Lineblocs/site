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
                <h1>Unsubscribe from email alerts</h1>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-12 unsubscribe-form">
                            <p>Please select the option(s) you want to unsubscribe from. If you want to unsubscribe from all alerts please select "all".</p>
                            <form method="POST" action="/email/unsubscribe" id="emailUnsubscribeFrm">
                                @foreach ($emailOptions as $option)
                                    <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="wrapper">
                                                    @if ($option['enabled'])
                                                        <input name="{{$option['name']}}" id="{{$option['name']}}" type="checkbox" class="validate" checked />
                                                    @else
                                                        <input name="{{$option['name']}}" id="{{$option['name']}}" type="checkbox" class="validate" />
                                                    @endif
                                                    <label>{{$option['label']}}</label>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <button class="btn button" type="submit">Update</button>
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
<script>
   function onSubmit(token) {
     document.getElementById("emailUnsubscribeFrm").submit();
   }
 </script>
@endsection
