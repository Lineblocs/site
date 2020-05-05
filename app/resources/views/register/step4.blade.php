@extends('layouts.accounts')
@section('title') Home :: @parent @endsection
@section('content')
    <div class="content">
            <form name="register_frm" class="signup-form" method="POST">
                        <div class="inner">

                            <div class="top-heading">
                                <h3>Enter Workspace Name</h3>
                <div class="error" id="errorMsg"></div>
                            </div>
                            <div class="inputs">
                                <div class="clearfix" style="width: 500px;">
                                    <div style="float:left; width: 364px;">

                        <div class="input-box input-margin">
                        <div class="input-field lname">
                            <input name="workspace" id="workspace" type="text" class="validate" required="">
                            <label for="workspace">Workspace</label>
                        </div>
                    </div>
                                    </div>
                                    <div style="float: left; width: 136px;">
                                        <h5 class="workspace-domain">.lineblocs.com</h5>
                                    </div>
                                </div>

                                <div class="login-btn">
                                    <button>
                                        <span>Sign Up</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
         
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
       var form = $("form[name='register_frm']") ;
       var email = localStorage.getItem("email");
       var splitted = email.split("@");
        form.find("input[name='workspace']").val(splitted[0]);
        form.find("label[for='workspace']").addClass("active");
       form.on("submit", function(event) {
            console.log("form submitted ", arguments);
            var data = $( this ).serialize();
            console.log("submit is ", data);
            event.preventDefault();
            var workspace = $(this).find("input[name='workspace']").val();
            var token = localToken();
            var number = localStorage.getItem("mobile_number");
            showLoading();
            sendPost("/updateWorkspace", {
                workspace: workspace,
                userId: token.userId,
                mobile_number: number
            }).done(function(res) {
                console.log("register done.. ", res);
                if ( res.success ) {
                    sendPost("/provisionCallSystem", {
                        templateId: 1,
                        userId: token.userId
                    }).done(function(res) {
                        //all done
                        sendPost("/userSpinup", {
                            userId: token.userId
                        }).done(function(res) {
                            //all done
                            endLoading();
                            var workspace = res.workspace;
                            var key = token.token.auth;
                            var qs = "?auth=" + key + "&workspaceId=" + workspace.id;

                            document.location.href = "https://app.lineblocs.com/#/dashboard-redirect" + qs;
                        });
                    });
                } else {
                    endLoading();
                    $("#errorMsg").text(res.message);
                    $("#errorMsg").show();
                }
            }).fail(function() {
                console.log("register fail.. ", res);
            });

        });
    });
        
</script>
@endsection

