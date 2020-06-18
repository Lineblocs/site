@extends('layouts.accounts')
@section('title') Home :: @parent @endsection
@section('content')
    <div class="content">


            <form name="register_frm" class="signup-form" method="POST">
                <h3>Sign up to get started</h3>
                <div class="error" id="errorMsg"></div>
                <div id="content">
                <div class="field-input full-name">
                    <div class="input-box fname">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <path fill="#317780" fill-rule="nonzero"
                                d="M19.95 17.138a.781.781 0 1 0-1.53.318.816.816 0 0 1-.166.684.794.794 0 0 1-.625.297H2.371a.794.794 0 0 1-.625-.297.816.816 0 0 1-.166-.684c.811-3.894 4.246-6.739 8.213-6.835a5.36 5.36 0 0 0 .415 0 8.594 8.594 0 0 1 6.94 3.815.781.781 0 1 0 1.299-.87 10.162 10.162 0 0 0-5.266-4.001 5.308 5.308 0 0 0 2.132-4.252A5.319 5.319 0 0 0 10 0a5.319 5.319 0 0 0-5.313 5.313c0 1.738.84 3.284 2.135 4.254-1.187.39-2.3.998-3.274 1.8a10.192 10.192 0 0 0-3.497 5.77A2.372 2.372 0 0 0 2.37 20h15.258c.716 0 1.386-.318 1.837-.874.454-.558.63-1.283.483-1.988zM6.25 5.312A3.754 3.754 0 0 1 10 1.563a3.754 3.754 0 0 1 3.75 3.75 3.755 3.755 0 0 1-3.56 3.746 9.903 9.903 0 0 0-.38 0 3.755 3.755 0 0 1-3.56-3.745z" />
                        </svg>
                        <!-- <input type="text" placeholder="First Name"> -->
                        <div class="input-field">
                            <input name="first_name" id="first_name" type="text" class="validate" required="">
                            <label for="first_name">First Name</label>
                        </div>
                    </div>

                        <!-- <input type="text" placeholder="Last Name"> -->
                        <div class="input-box">
                        <div class="input-field lname">
                            <input name="last_name" id="last_name" type="text" class="validate" required="">
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>
                </div>

                <div class="field-input">
                    <div class="input-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15" viewBox="0 0 20 15">
                            <path fill="#317780" fill-rule="nonzero"
                                d="M19.219 8.858A.773.773 0 0 0 20 8.093V3.08C20 1.392 18.598.02 16.875.02H3.125C1.402.02 0 1.391 0 3.08v8.84c0 1.688 1.402 3.06 3.125 3.06h13.75c1.723 0 3.125-1.372 3.125-3.06a.773.773 0 0 0-.781-.766.773.773 0 0 0-.782.766c0 .844-.7 1.53-1.562 1.53H3.125c-.862 0-1.563-.686-1.563-1.53V3.243L8.35 7.377a3.168 3.168 0 0 0 3.3 0l6.787-4.134v4.85c0 .423.35.765.782.765zm-8.394-2.78a1.58 1.58 0 0 1-1.65 0l-6.96-4.24c.256-.182.57-.288.91-.288h13.75c.34 0 .654.106.91.287l-6.96 4.24z" />
                        </svg>

                        <!-- <input type="text" placeholder="Company Email Address"> -->
                        <div class="input-field">
                            <input name="email" id="email" type="email" class="validate" required="">
                            <label for="email">Company Email Address</label>
                        </div>
                    </div>

                </div>

                <div class="field-input">
                    <div class="input-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 20 23">
                            <g fill="#317780" fill-rule="nonzero">
                                <ellipse cx="15.089" cy="15.543" rx="1" ry="1" />
                                <path
                                    d="M19.107 16.262a.896.896 0 0 0 .893-.899V12.04c0-1.982-1.602-3.594-3.571-3.594h-1.074V5.277C15.355 2.367 12.952 0 9.998 0S4.641 2.367 4.641 5.277v3.168h-1.07C1.602 8.445 0 10.057 0 12.04v7.367C0 21.388 1.602 23 3.571 23H16.43C18.398 23 20 21.388 20 19.406c0-.496-.4-.898-.893-.898a.896.896 0 0 0-.893.898c0 .991-.8 1.797-1.785 1.797H3.57a1.793 1.793 0 0 1-1.785-1.797V12.04c0-.99.8-1.797 1.785-1.797H16.43c.984 0 1.785.806 1.785 1.797v3.324c0 .496.4.899.893.899zM13.57 8.445H6.427V5.277c0-1.919 1.602-3.48 3.571-3.48 1.97 0 3.572 1.561 3.572 3.48v3.168z" />
                                <ellipse cx="8.348" cy="15.543" rx="1" ry="1" />
                                <ellipse cx="5" cy="15.543" rx="1" ry="1" />
                                <ellipse cx="11.696" cy="15.543" rx="1" ry="1" />
                            </g>
                        </svg>

                        <!-- <input type="text" placeholder="Password"> -->
                        <div class="input-field">
                            <input name="password" id="password" type="password" class="validate" required="">
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>

                <div class="field-input">
                    <div class="input-box small">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23">
                            <g fill="#317780" fill-rule="nonzero">
                                <circle cx="15.154" cy="15.513" r="1" />
                                <path
                                    d="M10.67 21.162H3.588a1.795 1.795 0 0 1-1.794-1.794v-7.352c0-.99.805-1.794 1.794-1.794h12.912c.989 0 1.793.805 1.793 1.794v1.793a.897.897 0 1 0 1.794 0v-1.793a3.59 3.59 0 0 0-3.587-3.587h-1.078V5.267c0-2.904-2.413-5.267-5.38-5.267-2.966 0-5.38 2.363-5.38 5.267v3.162H3.587A3.59 3.59 0 0 0 0 12.016v7.352a3.59 3.59 0 0 0 3.587 3.587h7.084a.897.897 0 1 0 0-1.793zM6.455 5.267c0-1.916 1.61-3.474 3.587-3.474 1.978 0 3.587 1.558 3.587 3.474v3.162H6.454V5.267z" />
                                <path
                                    d="M22.58 14.604a.897.897 0 0 0-1.25.207l-4.42 6.174a.508.508 0 0 1-.353.176.508.508 0 0 1-.385-.138l-2.856-2.787a.897.897 0 1 0-1.252 1.284l2.861 2.792.008.008a2.312 2.312 0 0 0 1.743.63 2.312 2.312 0 0 0 1.674-.896l4.438-6.199a.897.897 0 0 0-.208-1.25z" />
                                <circle cx="11.747" cy="15.513" r="1" />
                                <circle cx="5.021" cy="15.513" r="1" />
                                <circle cx="8.384" cy="15.513" r="1" />
                            </g>
                        </svg>
                        <!-- <input type="text" placeholder="Confirm Password"> -->
                        <div class="input-field">
                            <input name="conf_password" id="conf_password" type="password" class="validate" required="">
                            <label for="conf_password">Confirm Password</label>
                        </div>
                    </div>
                </div>

                <div>
                    <label style="display: none;">
                    <input type="checkbox" id="acceptTerms" checked="checked"></input>
                        <span>I accept the <a target="_blank" href="https://lineblocs.com/pages/tos">Terms Of Service</a></span>
                 
                    </label>
                        <small style="font-size: 10px;">By clicking the button below you agree to our <a target="_blank" href="https://lineblocs.com/pages/tos">ToS (Terms Of Service)</a></small>
                        <br/>
                        <br/>
                 
                </div>
                <div class="login-btn">
                            <button>
                                <span>Sign Up</span>
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
            var terms = $("#acceptTerms");
            event.preventDefault();
            if (!terms.is(":checked")) {
                alert("You must accept the terms to create an account.");
                return;
            }
            showLoading();
            var fName = $(this).find("input[name='first_name']").val();
            var lName = $(this).find("input[name='last_name']").val();
            var email = $(this).find("input[name='email']").val();
            var password = $(this).find("input[name='password']").val();
            var cPassword = $(this).find("input[name='conf_password']").val();
            if (password !== cPassword) {
                alert("Passwords don't match");
                return;
            }
            sendPost("/register", {
                first_name: fName,
                last_name: fName,
                email: email,
                password: password
            }).done(function(res) {
                console.log("register done.. ", res);
                endLoading();
                if ( res.success ) {
                    localStorage.setItem("token", JSON.stringify(res));
                    localStorage.setItem("email", email);
                    document.location.href = "/register/2";
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

