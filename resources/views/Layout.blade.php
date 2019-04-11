<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="أفضل موقع عربي لمشاهدة الأفلام و المسلسلات و الأنمي بسهولة و سرعة">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <title>CinemaHub - الرئيسية</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
                    <li><a href="{{route('home')}}">الرئيسية</a></li>
                    <li><a href="{{route('movies.arabic')}}">أفلام عربي</a></li>
                    <li><a href="#">مسلسلات عربي</a></li>
                    <li><a href="#">مسلسلات أجنبي</a></li>
                    <li><a href="#">أنمي</a></li>

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
                <a href="packages/index.html">أفلام عربي</a>
            </li>
            <li class="mobile-nav__item">
                <a href="customers/index.html">مسلسلات عربي</a>
            </li>
            <li class="mobile-nav__item mobile-nav__item--cta">
                <a href="start-hosting/index.html">مسلسلات أجنبي</a>
            </li>
            <li class="mobile-nav__item mobile-nav__item--cta">
                <a href="start-hosting/index.html">أنمي</a>
            </li>
        </ul>
    </nav>



    @yield('content')



    <footer id="main-footer">

        <p style="margin-left:auto;color:white;font-weight:bold;font-size:1.3rem;">
            موقع cimahub لمشاهدة الافلام والمسلسلات اونلاين @ 2019</p>

    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/shared.js"></script>
    <script>
        AOS.init();
    </script>


</body>


</html>