<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
 
  @if (isset($title))
    <title>LineBlocs.com - {{$title}}</title>
  @else
    <title>LineBlocs.com - Your line your way</title>
  @endif
  @if (isset($description))
    <meta name="description" content="{{$description}}">
  @else
    <meta name="description" content="LineBlocs make it easy to provision a cloud PBX and customize your inbound calling needs through visual flows"/>
  @endif
  @if (isset($tags))
    <meta name="keywords" content="{{$tags}}"/>
  @else
    <meta name="keywords" content="cloud pbx, lineblocs, visual PBX, drag and drop">
  @endif
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/css/style-frontend.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//45.76.62.46/matomo/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- Start of Async Drift Code -->
<script>
"use strict";

!function() {
  var t = window.driftt = window.drift = window.driftt || [];
  if (!t.init) {
    if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
    t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
    t.factory = function(e) {
      return function() {
        var n = Array.prototype.slice.call(arguments);
        return n.unshift(e), t.push(n), t;
      };
    }, t.methods.forEach(function(e) {
      t[e] = t.factory(e);
    }), t.load = function(t) {
      var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
      o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
      var i = document.getElementsByTagName("script")[0];
      i.parentNode.insertBefore(o, i);
    };
  }
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('84i5z2ttdxg5');
</script>
<!-- End of Async Drift Code -->
<!-- End Matomo Code -->
</head>
<body>
  <nav class="nav-bg" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="/" class="brand-logo">
      <img src="/img/Logo_FinalWhite.png" height="64"/>
    </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/resources">Resources</a></li>
        <li><a href="/features">Features</a></li>
        <li><a href="/login">Login</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="/">Home</a></li>
        <li><a href="/pricing">Pricing</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  @yield('content')
  <footer class="page-footer my-footer">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">{{$info['footer_title']}}</h5>
          <p class="grey-text text-lighten-4">{{$info['footer_bio']}}</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Pages</h5>
          <ul>
            <li><a class="white-text" href="/pages/tos">Terms Of Service</a></li>
            <li><a class="white-text" href="/pages/privacy-policy">Privacy Policy</a></li>
            <li><a class="white-text" href="/faqs">FAQs</a></li>
            <li><a class="white-text" href="/about">About</a></li>
            <li><a class="white-text" href="/contact">Contact</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Our Facebook</a></li>
            <li><a class="white-text" href="#!">Twitter</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      &copy; <a class="text-lighten-3 white-text" href="http://lineblocs.com">LineBlocs.com</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/js/materialize.js"></script>
  <script src="/js/script-frontend.js"></script>
  @yield('scripts')
  </body>
</html>

