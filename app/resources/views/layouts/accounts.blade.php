<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="/css/materialize.css">
  <link type="text/css" href="https://app.lineblocs.com/styles/app.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <title>Home</title>
</head>

<body>
  <style>
    .input-margin {
      margin-top: 20px;
    }
    .dont-show {
      display: none;
    }
    .error {
      width: 100%;
      margin: 10px 0;
      text-align: center;
      color: #FF0000;
    }
    .info {
      width: 100%;
      margin: 10px 0;
      text-align: center;
      color: green;
    }
    .workspace-domain {
    font-size: 20px;
    font-weight: 500;
    line-height: 1;
    letter-spacing: .02em;
    margin-top:41px;
}
.login-btn button {
  /* fix this i cannot find the CSS property thats changing it */
  background: #FFFFFF;
}
.input-box.small {
  margin-bottom: 0px !important;
}
  </style>

  <div class="login-page">
    <div class="logo">
    <a href="https://lineblocs.com/">
      <img src="https://app.lineblocs.com/images/logo-blue-small.png">
    </a>

                <div class="dont-show" id="loading">
                    <h5>Please wait..</h5>
                    <br/>
                    <img src="https://app.lineblocs.com/spinner.gif" width="64"/>
                </div>
    </div>

    <div id="content">
      @yield('content')
    </div>
  </div>
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script>
    function showLoading() {
      $("#loading").show();
        $("html, body").animate({ scrollTop: 0 }, "slow");
      //$("#content").hide();
    }
    function endLoading() {
      //$("#content").show();
      $("#loading").hide();
    }

    function localToken() {
      return JSON.parse(localStorage.getItem("token"));
    } 
    function sendPost(url, data) {
      return $.ajax({
            url: "https://lineblocs.com/api" + url,
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(data)
        });
      }
        document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});

            var inputs = document.querySelectorAll('input');
      inputs.forEach(function(input) {
        var value = input.value;
        var name = input.getAttribute("name");
        if (value !== '') {
          var label = $("label[for='" + name +  "'");
          $( label ).addClass("active");
        }
      });
  });

    </script>

    @yield('scripts')
</body>

</html>