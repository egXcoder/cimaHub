<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="أفضل موقع عربي لمشاهدة الأفلام و المسلسلات و الأنمي بسهولة و سرعة">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/brand.png" type="image/x-icon">
    <meta property="og:title" content="موقع cimahub">
    <meta property="og:description" content="موقع cimahub لمشاهدة الافلام الاجنبى والعربى بدون اعلانات">
    <meta property="og:image" content="{{asset('')."brand.png"}}">
    <meta property="og:url" content="{{asset('')}}">
    <meta name="twitter:title" content="موقع cimahub">
    <meta name="twitter:description" content="موقع cimahub لمشاهدة الافلام الاجنبى والعربى بدون اعلانات">
    <meta name="twitter:image" content="{{asset('')."brand.png"}}">
    <meta name="theme-color" content="#321c4c" />
    @if ($title=='home')
    <title>CimaHub - الرئيسية</title>
    @endif
    @if ($title=='arabic')
    <title>CimaHub - افلام عربى</title>
    @else
    <title>{{$title}}</title>
    @endif
    <link rel="stylesheet" href="css/app.css">    
    
    @yield('extraStylesheets')

</head>

<body>

    <button id="scrollToTopButton" onclick="scrollToTop(300,3);"><i class="fas fa-angle-double-up"></i></button>

    <header class="main-header">
        <div class="navbar-container">
            <div class="toggle-button">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="main-header__navbar">
                <ul>
                    <li><a @if($title==='home')class="active" @endif href="{{route('home')}}">الرئيسية</a></li>
                </ul>
            </nav>
        </div>

        <div class="logo">
            <a href="{{route('home')}}">
                <p class="brand">cima<span>hub</span></p>
                <img style="vertical-align:middle;" width=80px height=50px src="/brand.png">
            </a>
        </div>

    </header>

    <div class="backdrop"></div>

    <nav class="mobile-nav">
        <ul class="mobile-nav__items">
            <li class="mobile-nav__item">
                <a href="{{route('home')}}">الرئيسية</a>
            </li>
        </ul>
    </nav>

    @yield('content')

    <footer id="main-footer">

        <p>
            موقع cimahub لمشاهدة الافلام الاجنبى والعربى اونلاين @ 2019
        </p>

    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/shared.js"></script>
    <script>
        $(document).ready(function(){
        var logoElement = $('.logo');
        animateLogo('tada');
        $(window).scroll(function(){if(window.scrollY==0) animateLogo('tada');});
        logoElement.hover(function(){animateLogo('pulse')},function(){});

        function animateLogo($animationClass){
            logoElement.addClass('animated').addClass($animationClass);
            logoElement.on("animationend", function(){ $(this).removeClass('animated').removeClass($animationClass) });
        }
        });
        
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138512204-1"></script>
    <script>
       window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-138512204-1');
    </script>
    @yield('scripts')

</body>


</html>