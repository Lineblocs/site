<!DOCTYPE html> <html lang="en">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
 
  @if (isset($title))
    <title>{{\App\Helpers\MainHelper::createTitle($title)}}</title>
  @else
    <title>{{\App\Helpers\MainHelper::createDefaultTitle()}}</title>
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
<!--<link rel="shortcut icon" type="image/png" href="favicon.png"/>-->
<link rel="shortcut icon" type="image/png" href="{!! asset('images/new-icon.png') !!}">
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
      <!-- responsive css -->
    <link rel="stylesheet" href="/css/shared/navbar.css">
    <link rel="stylesheet" href="/css/homepage/hero.css">
    <link rel="stylesheet" href="/css/homepage/features.css">
    <link rel="stylesheet" href="/css/homepage/support.css">
    <link rel="stylesheet" href="/css/homepage/comparison.css">
    <link rel="stylesheet" href="/css/shared/footer.css">
    <link rel="stylesheet" href="/css/faq-page.css">
        <link rel="stylesheet" href="/css/contact.css">
          <link rel="stylesheet" href="/css/resources-page/resources.css" />
            <link rel="stylesheet" href="/css/region_landing.css">
            <link rel="stylesheet" href="/css/pricing.css">
              <link rel="stylesheet" href="/css/our-pricing.css">
  <link rel="stylesheet" href="/css/about/about-new.css">
    <link rel="stylesheet" href="/css/landing.css" />
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
<!-- Facebook Pixel Code --><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '316654979401125'); fbq('track', 'PageView');</script><noscript> <img height="1" width="1" src="https://www.facebook.com/tr?id=316654979401125&ev=PageView&noscript=1"/></noscript><!-- End Facebook Pixel Code -->


</head>

<body>
    <header id="header">
        <div id="navbar" class="header-content color-header">
                <div class="logo">
                        <!--<a href="/"><img src="/images/logo-blue-gimp.png"></a>-->
                        <a href="/"><img src="{{\App\Helpers\MainHelper::appLogo()}}"></a>
                    </div>

                <div class="burger">
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                </div>
                <div class="burger-drawer-close">
                    x
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
                            <a href="{{\App\Helpers\MainHelper::createAppUrl('/#/login')}}"><button type="submit"
                                        class="btn-custom service-btn top-login-btn btn-top"><span>Login</span></button></a>
                        </li>
                    </ul>
                </div>
        </div>
    </header>
    <div class="burger-drawer hide-drawer">
        <div class="burger-drawer-container">
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
                    <br>
                    <hr>
                    <br>
                    <li>
                        <a href="{{\App\Helpers\MainHelper::createAppUrl('/#/register')}}"><button type="submit"
                                    class="btn-custom service-btn top-login-btn"><span>get started</span></button></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


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

                        <p>© {{\App\Helpers\MainHelper::getSiteName()}}</p>
                        <div class="social-media">
                            <a href="https://www.facebook.com/lineblocs/"><img src="/images/facebook.png"></a>
                            <a href="https://twitter.com/lineblocs"><img src="/images/twitter.png"></a>
                        </div>
                    </div>
                </div>
            </div>
    </footer>

    <script src="/js/jquery.min.js"></script>                            
  <script src="/js/materialize.min.js"></script>
    <script id="s1"></script>
    <script src="/js/components/Navbar.js"></script>


    @yield('scripts')
<script type="text/javascript">
var s1 = document.getElementById("s1");
s1.src= "{{\App\Helpers\MainHelper::createAppUrl('/scripts/main.min.js')}}";
</script>
<script>
//Set your APP_ID
var APP_ID = "q1wbd2t4";

window.intercomSettings = {
    app_id: APP_ID
  };
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/' + APP_ID;var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
</body>

</html>

