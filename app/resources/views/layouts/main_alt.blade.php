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
  <script async type="text/javascript" src="https://static.edgeme.sh/client.js" onload="window.edgemesh = new Edgemesh()"></script>
  <!-- CSS  -->
<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//matomo.lbackups.com/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" href="/css/custom.css" rel="stylesheet" />
  <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/css/style-frontend.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <title>Home</title>
    <!-- Start of Async Drift Code -->
  @if (!isset($show_drift) || (isset($show_drift) && $show_drift))
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
@endif
<!-- End of Async Drift Code -->
</head>

<body>
    <header id="header">
        <div id="navbar" class="header-content color-header small">
                <div class="logo">
                        <a href="/"><img src="/images/logo-blue-gimp.png"></a>
                    </div>
                    <div class="menu">
   <ul>
<li>
                                <a href="/pricing">Pricing</a>
                            </li>


                            <li>
                                <a href="/features">Features</a>
                            </li>

                            <li>
                                <a href="/resources">Resources</a>
                            </li>
                            <li>
                              <a href="https://app.lineblocs.com/#/login"><button type="submit" class="btn-custom service-btn top-login-btn"><span>Login</span></button></a>
                            </li>
                        </ul>
                    </div>
        </div>
    </header>
  @yield('content')

<footer id="footer">
        @if (isset($footer_cls))
        <div class="footer {{$footer_cls}}">
        @else
        <div class="footer">
        @endif
            <div class="footer-img">
                    <img src="/images/footer-img-gray-dark.png"> 
            </div>
            <div class="container max">
                    <div class="footer-menu">
                            <ul>
                                <li>
                                    <a href="/status">Status</a>
                                </li>
                                <li>
                                    <a href="/pages/tos">Terms Of Service</a>
                                </li>
                                <li>
                                    <a href="/pages/privacy-policy">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="/faqs">FAQs</a>
                                </li>
                                <li>
                                    <a href="/about">About</a>
                                </li>
                                <li>
                                    <a href="/contact">Contact</a>
                                </li>
                            </ul>
                        </div>
            </div>
        </div>
        <div class="privacy">
                <div class="container max">
                    <div class="privacy-content">
                        <p>© LineBlocs.com</p>
                        <div class="social-media">
                            <a href="https://www.facebook.com/lineblocs/"><img src="/images/facebook.png"></a>
                            <a href="https://twitter.com/lineblocs"><img src="/images/twitter.png"></a>
                        </div>
                    </div>
                </div>
            </div>
    </footer>

    <script src="/js/jquery.min.js"></script>                            
    <script src="/js/custom.js"></script>
  <!--<script src="/js/materialize.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
  <script src="/js/script-frontend.js"></script>
    @yield('scripts')
</body>

</html>



