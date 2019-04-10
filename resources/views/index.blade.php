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
    <link rel="stylesheet" href="css/shared.css">
    <link rel="stylesheet" href="css/main.css">




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
                    <li><a href="#">أفلام أجنبي</a></li>
                    <li><a href="#">مسلسلات عربي</a></li>
                    <li><a href="#">مسلسلات أجنبي</a></li>
                    <li><a href="#">أنمي</a></li>

                </ul>
            </nav>
        </div>


        <div class="logo">
            <a href="{{route('home')}}">
                    <img style="vertical-align:middle;" width=200px height=50px src="/brand.png">
                {{-- <h3><span style="font-size: 130%">C</span>inemaHub</h3> --}}
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
                <a href="start-hosting/index.html">أفلام أجنبي</a>
            </li>
            <li class="mobile-nav__item mobile-nav__item--cta">
                <a href="start-hosting/index.html">مسلسلات أجنبي</a>
            </li>
            <li class="mobile-nav__item mobile-nav__item--cta">
                <a href="start-hosting/index.html">أنمي</a>
            </li>


        </ul>
    </nav>




    
    <main id="container">
        <div id="search-bar">
            <span><i class="fas fa-search"></i></span>
            <input class="search-bar__input" placeholder="بحث..."></input>
        </div>

        <div id="main">

            <div id="movies-section">

                @foreach ($movies as $movie)

                <div class="movie">

                    @if($movie->quality!=='0' && $movie->quality!==null)
                    <div class="quality-label">{{$movie->quality}}</div>
                    @endif @if($movie->ratings!=0 && $movie->ratings!==null)
                    <div class="rating-star"><i class="fas fa-star"></i></div>
                    <span class='rating-value'>{{$movie->ratings}}</span> @endif

                    <a href="{{route('movie.serverLinks',['slug'=>$movie->getSlug()])}}"><img src='{{$movie->image_url}}'></a>
                    <div class="movie-view-count__container">


                        <p class="view-count"> &nbsp <i class="fas fa-eye"></i> </p>
                    </div>

                    <div class="movie-title__container">

                        <a href="{{route('movie.serverLinks',['slug'=>$movie->getSlug()])}}">
                            <h2 class='movie-title'>{{$movie->name}}</h2>
                        </a>

                    </div>


                    <div class="overdrop-top">
                    </div>
                    <div class="overdrop-bottom">

                    </div>



                </div>
                @endforeach


            </div>

        </div>

<div class="paginate-container">

    {{$movies->links()}}
</div>

    </main>



    <footer id="main-footer">
        <!--
        <div class="go-to-top">
            <i class="fas fa-arrow-up"></i>
        </div>
-->
        <p style="margin-left:auto;margin-right:auto;color:white;font-weight:bold;">
            Backend By EgXcoder && FrontEnd Mohamed Osama Copyright @ 2019</p>

    </footer>

    <script src="js/shared.js"></script>


</body>


</html>