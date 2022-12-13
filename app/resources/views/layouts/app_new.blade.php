
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Lineblocs is a fully custimizable cloud phone system for productive teams.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="shortcut icon" type="image/png" href="favicon.png"/>-->
    <link rel="shortcut icon" type="image/png" href="{!! asset('images/new-icon.png') !!}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/custom_new.css">
    <link rel="stylesheet" href="/css/custom-overrides.css">

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/common.css">

  <link rel="stylesheet" href="/css/features/service-content.css">
  <link rel="stylesheet" href="/css/features/overview-section.css">
  <link rel="stylesheet" href="/css/faq-page.css">
  <link rel="stylesheet" href="/css/about/about.css">
  <link rel="stylesheet" href="/css/contact.css">
  <!--<link rel="stylesheet" href="/css/resources-page/resources.css" />-->
  <link rel="stylesheet" href="/css/resources-section.css">
  <link rel="stylesheet" href="/css/region_landing.css">
  <link rel="stylesheet" href="/css/pricing.css">
  <link rel="stylesheet" href="/css/our-pricing.css">

  <link rel="stylesheet" href="/css/about/about.css">
  <!--<link rel="stylesheet" href="/css/resources.css" />-->
  <link rel="stylesheet" href="/css/landing.css" />
  <link rel="stylesheet" href="/css/system-status.css">
  <link rel="stylesheet" href="/css/sip-trunking-networks.css">
  <link rel="stylesheet" href="/css/sip-trunking-networks-detail.css" />
  <link rel="stylesheet" href="/css/dl_styles.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/cbbc235e67.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Lineblocs</title>
</head>
<body>
    @if (isset($header_cls))
        <header class="header {{$header_cls}}">
        @else
            <header class="header">
                @endif

            <nav class="navbar navbar-expand-md navbar-light" aria-label="Eighth navbar example">
                <div class="container">
                    <a class="navbar-brand ml-0" href="/"><img src="{{\App\Helpers\MainHelper::appLogo()}}" alt="Logo"></a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample07">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/pricing">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/features">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/resources">Resources</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://app.lineblocs.com/#/register">
                                    @if (isset($header_cls))
                                        <button type="button" class="nav__btn">Login</button>
                                    @else
                                        <button type="button" class="nav__btn">Try Free</button>
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="mob-menu">
                            <div class="row socials mx-auto">
                                <div class="col">
                                    <ul class="social__links">
                                        <a target="_blank" href="https://www.facebook.com/lineblocs/"><li class="socials facebook"></li></a>
                                        <a target="_blank" href="https://twitter.com/lineblocs?lang=en"><li class="socials twitter"></li></a>
                                    </ul>
                                </div>

                            </div>
                            <div class="row rights">
                                <div class="col">
                                    <p>© 1999-2021 LineBlocs.com. All rights reserved. </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-2 my-auto"></div>
                    <div class="col-12 col-lg-8 my-auto">
                        <ul class="footer__nav">
                            <li><a href="/status">Status</a></li>
                            <li><a href="/pages/tos">Terms of Service</a></li>
                            <li><a href="/faqs">FAQs</a></li>
                            <li><a href="/pages/privacy-policy">Privacy Policy</a></li>
                            <li><a href="/about">About</a></li>
                            <li><a href="/contact">Contact</a></li>

                        </ul>
                    </div>
                    <div class="col-12 col-lg-2 my-auto">
                        <ul class="social__links">
                            <a target="_blank" href="https://www.facebook.com/lineblocs/">
                            <li class="socials facebook"></li>
                            </a>
                            <a target="_blank" href="https://twitter.com/lineblocs?lang=en">
                            <li class="socials twitter"></li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
           <p>© 1999-2021 LineBlocs.com. All rights reserved. </p>
        </footer>
        @yield('scripts')
            <!-- Twitter universal website tag code -->
                <script>
                    !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
                    },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='//static.ads-twitter.com/uwt.js',
                        a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
                    // Insert Twitter Pixel ID and Standard Event data below
                    twq('init','o60rk');
                    twq('track','PageView');
                </script>
                <!-- End Twitter universal website tag code -->
</body>
</html>