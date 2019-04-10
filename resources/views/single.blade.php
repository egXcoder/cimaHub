<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head> 
        <meta charset="UTF-8">
        <meta name="description" content="أفضل موقع عربي لمشاهدة الأفلام و المسلسلات و الأنمي بسهولة و سرعة">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="css/shared.css">
        <link rel="stylesheet" href="css/single.css">

        <title>{{$movie->name}}</title>
    </head>

    <body>
        
<!--
        <button id="scrollToTopButton" onclick="scrollToTop(300,3);"><i class="fa fa-arrow-up"></i></button>
        
-->
        
        <header class="main-header">

            <div class="navbar-container">
                <div class="toggle-button">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <nav class="main-header__navbar">
                    <ul>
                        <li><a href="#">الرئيسية</a></li>
                        <li><a href="أفلام عربي/index.html">أفلام عربي</a></li>
                        <li><a href="#">أفلام أجنبي</a></li>
                        <li><a href="#">مسلسلات عربي</a></li>
                        <li><a href="#">مسلسلات أجنبي</a></li>
                        <li><a href="#">أنمي</a></li>
                        
                    </ul>
                </nav>
            </div>
                    
            <div class="logo"><i class="fas fa-tv"></i>
            <a href="{{route('home')}}"><h3><span style="font-size: 130%" >C</span>inemaHub</h3></a>
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
        
        <div id="movie-cover">
           <div class='cover__img-container'>
               <img src="{{$movie->image_url}}" alt="{    {$movie->image_url}}" class='cover__img'>
           </div> 
            <div class="movie-poster">
                <img width="100%" height="100%" src="{{$movie->image_url}}" alt="{{$movie->image_url}}">
            </div>
        </div>
        
        <div id="movie-name"><h1>{{$movie->name}}</h1></div>
        
        <div class="movie-description">
            
        <p>{{$movie->description}}</p>
        
        </div>
        <div class="servers-movie-container">
            <div class="servers-section">

                @for ($i = 1; $i < count($serverLinks)+1; $i++)
                <div id="{{$i}}" class="server"><a>سيرفر {{$i}} </a></div>    
                @endfor
                
            </div>

            <div class="video-container">
                <iframe sandbox="allow-scripts allow-same-origin" width=100% height=600px src="{{$serverLinks[0]}}" frameborder=0 allowfullscreen></iframe>
            </div>
        </div>
        
        <div id="search-bar">
            <span><i class="fas fa-search"></i></span>
            <input class="search-bar__input" placeholder="بحث..."></input>
        </div>


        <footer id="main-footer">
<!--
            <div class="go-to-top">
                <i class="fas fa-arrow-up"></i>
            </div>
            
-->

        </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/shared.js"></script>
    <script>
        $(document).ready(function(){
            $(".server").click(function(){
                var selected_server_id = $(this).attr('id') - 1;
                var list = [];
                @foreach($serverLinks as $serverLink)
                list.push("{{$serverLink}}");
                @endforeach
                $("iframe").attr('src',list[selected_server_id]); 
            });
        });
    </script>
    
</body>
    
</html>