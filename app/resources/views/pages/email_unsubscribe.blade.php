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
                            <p>Please select the option(s) you want to unsubscribe from. If you want to unsubscribe from all alerts please click "Select All".</p>
                            <a id="toggleAll" style="cursor:pointer;color:blue;">Select All</a>
                            <br/>
                            <hr/>
                            <form method="POST" action="/email/unsubscribe" id="emailUnsubscribeFrm">
                                @foreach ($emailOptions as $option)
                                    <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="wrapper">
                                                    @if ($option['enabled'])
                                                        <input name="{{$option['name']}}" id="{{$option['name']}}" type="checkbox" class="validate email-option" checked />
                                                    @else
                                                        <input name="{{$option['name']}}" id="{{$option['name']}}" type="checkbox" class="validate email-option" />
                                                    @endif
                                                    <label>{{$option['label']}}</label>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    <br/>
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
    $("#toggleAll").on("click", function() {
        $(".email-option").prop('checked', true); 
    })
 </script>
@endsection
