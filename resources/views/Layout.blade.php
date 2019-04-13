<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="أفضل موقع عربي لمشاهدة الأفلام و المسلسلات و الأنمي بسهولة و سرعة">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    @if ($title=='home')
    <title>CimaHub - الرئيسية</title>
    @endif
    @if ($title=='arabic')
    <title>CimaHub - افلام عربى</title>
    @endif
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">
    <link rel="stylesheet" href="css/shared.css"> 
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
                    <li><a @if($title==='arabic')class="active" @endif href="{{route('movies.arabic')}}">أفلام عربي</a></li>

                </ul>
            </nav>
        </div>

        <div class="logo animated bounce">
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
                <a href="packages/index.html">أفلام عربي</a>
            </li>
        </ul>
    </nav>

    @yield('content')

    <footer id="main-footer">

        <p style="margin-left:auto;color:white;font-weight:bold;font-size:1.3rem;">
            موقع cimahub لمشاهدة الافلام الاجنبى والعربى اونلاين @ 2019</p>

    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/shared.js"></script>
    <script>
        $(window).scroll(function(){
            if(window.scrollY>90){
                $('.logo').removeClass('animated').removeClass('bounce');
            }else{
                $('.logo').addClass('animated').addClass('bounce');
            }
        });
        
    </script>
    @yield('scripts')

</body>


</html>