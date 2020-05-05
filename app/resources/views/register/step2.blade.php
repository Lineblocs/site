@extends('layouts.accounts')
@section('title') Home :: @parent @endsection
@section('content')
    <div class="content">


            <form name="register_frm" class="signup-form" method="POST">
                            <div class="top-heading">
                                <h3>Verify Your Account</h3>
                <div class="error" id="errorMsg"></div>
                                <p>
                                    please enter your mobile number so that we can call you with your verification code.
                                    <!--7-->
                                    </p><div class="box invalid-login">

                                        <center>
                                            <div class="dont-show" aria-hidden="true">The number you entered was invalid.
                                            </div>
                                        </center>
                                    </div>
                            </div>
                            <div class="field-input verify">
                                <div class="input-box">
                                    <div layout="row" class="width-100 layout-row">
                                        <div flex="10" class="flex-10">
                                              <div class="input-field col s12">
                                                  <small>Country</small>
    <select name="country">
      <option value="+1">US</option>
      <option value="+1">CA</option>
    </select>
  </div>
                                        </div>
                                        <div flex="90" class="flex-90">
                        <div class="input-box input-margin">
                        <div class="input-field lname">
                            <input name="mobile_number" id="mobile_number" type="text" class="validate" required="">
                            <label for="mobile_number">Mobile Number</label>
                        </div>
                    </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="login-btn">
                                <button>
                                    <span>Send Code</span>
                                </button>
                            </div>
                        </form>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("form[name='register_frm']").on("submit", function(event) {
            console.log("form submitted ", arguments);
            var data = $( this ).serialize();
            console.log("submit is ", data);
            event.preventDefault();
           var country= $(this).find("select[name='country']").val();
            var number = country + $(this).find("input[name='mobile_number']").val();
            var token = localToken();
            showLoading();
            sendPost("/registerSendVerify", {
                mobile_number: number,
                userId: token.userId
            }).done(function(res) {
                console.log("register done.. ", res);
                endLoading();
                if ( res.valid ) {
                    localStorage.setItem("mobile_number", number);
                    document.location.href ="/register/3";
                } else {
                    $("#errorMsg").text(res.message);
                    $("#errorMsg").show();
                }
            }).fail(function() {
                console.log("register fail.. ", res);
            });

        })
   });
        
</script>
@endsection

