@extends('layouts.accounts')
@section('title') Home :: @parent @endsection
@section('content')
    <div class="content">
            <form name="register_frm" class="signup-form" method="POST">
                            <div class="top-heading">
                                <h3>Please Enter Confirmation Code</h3>
                <div class="info" id="infoMsg"></div>
                <div class="error" id="errorMsg"></div>
                                <div class="box invalid-login">

                                    <center>
                                        <div ng-show="invalidCode"><a onclick="reSMS()">Resend SMS</a></div>
                                    </center>
                                </div>
                            </div>

                            <div class="field-input">
                                <div class="input-box">
                        <div class="input-box input-margin">
                        <div class="input-field lname">
                            <input name="confirmation_code" id="confirmation_code" type="text" class="validate" required="">
                            <label for="confirmation_code">Confirmation Code</label>
                        </div>
                    </div>
                                </div>
                            </div>
                            <div class="login-btn">
                                <button>
                                    <span>Confirm</span>
                                </button>
                            </div>
                        </form
    </div>
@endsection
@section('scripts')
<script>
    function reSMS() {
            showLoading();
            var number = localStorage.getItem("mobile_number");
            var token = localToken();
            sendPost("/registerSendVerify", {
                mobile_number: number,
                userId: token.userId
            }).done(function(res) {
                console.log("register done.. ", res);
                endLoading();
                $("#infoMsg").show();
            });
    }
    $(document).ready(function(){
        $("form[name='register_frm']").on("submit", function(event) {
            console.log("form submitted ", arguments);
            var data = $( this ).serialize();
            console.log("submit is ", data);
            event.preventDefault();
           var code= $(this).find("input[name='confirmation_code']").val();
            var token = localToken();
            var number = localStorage.getItem("mobile_number");
            showLoading();
            sendPost("/registerVerify", {
                confirmation_code: code,
                userId: token.userId,
                mobile_number: number
            }).done(function(res) {
                console.log("register done.. ", res);
                endLoading();
                if ( res.isValid ) {
                    document.location.href ="/register/4";
                } else {
                    $("#infoMsg").text("Code invalid please try again.");
                    $("#infoMsg").show();
                }
            }).fail(function() {
                console.log("register fail.. ", res);
            });

        })
   });
        
</script>
@endsection

