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
            <img width="100%" height="100%" src="{{$movie->image_url}}" alt="{{$movie->image_url}}">
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
                @if ($serverLinks->server_1!=null)
                <div id="server_1" class="server"><a>سيرفر 1 </a></div>
                @endif
                @if ($serverLinks->server_2!=null)
                <div id="server_2" class="server"><a>سيرفر 2 </a></div>
                @endif
                @if ($serverLinks->server_3!=null)
                <div id="server_3" class="server"><a>سيرفر 3 </a></div>
                @endif
                @if ($serverLinks->server_4!=null)
                <div id="server_4" class="server"><a>سيرفر 4 </a></div>
                @endif
                @if ($serverLinks->server_5!=null)
                <div id="server_5" class="server"><a>سيرفر 5 </a></div>
                @endif
                @if ($serverLinks->server_6!=null)
                <div id="server_6" class="server"><a>سيرفر 6 </a></div>
                @endif
                @if ($serverLinks->server_7!=null)
                <div id="server_7" class="server"><a>سيرفر 7 </a></div>
                @endif
                @if ($serverLinks->server_8!=null)
                <div id="server_8" class="server"><a>سيرفر 8 </a></div>
                @endif
                @if ($serverLinks->server_9!=null)
                <div id="server_9" class="server"><a>سيرفر 9 </a></div>
                @endif
                @if ($serverLinks->server_10!=null)
                <div id="server_10" class="server"><a>سيرفر 10 </a></div>
                @endif

            </div>

            <div class="video-container">
                <iframe width=100% height=600px src="{{$serverLinks->server_1}}" frameborder=0 allowfullscreen></iframe>
            </div>
        </div>
        
        <div id="search-bar">
            <span><i class="fas fa-search"></i></span>
            <input class="search-bar__input" placeholder="بحث..."></input>
        </div>

        <main id="container">
        
            <div id="main">   

                
        
    </main>
    
        

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
                switch($(this).attr('id')){
                    case 'server_1':
                        server = "{{$serverLinks->server_1}}";
                        break;
                    case 'server_2':
                        server = "{{$serverLinks->server_2}}"; 
                        break;
                    case 'server_3':
                        server = "{{$serverLinks->server_3}}";
                        break;
                    case 'server_4':
                        server = "{{$serverLinks->server_4}}"; 
                        break;
                    case 'server_5':
                        server = "{{$serverLinks->server_5}}";
                        break;
                    case 'server_6':
                        server = "{{$serverLinks->server_6}}"; 
                        break;
                    case 'server_7':
                        server = "{{$serverLinks->server_7}}";
                        break;
                    case 'server_8':
                        server = "{{$serverLinks->server_8}}"; 
                        break;
                    case 'server_9':
                        server = "{{$serverLinks->server_9}}"; 
                        break;
                    case 'server_10':
                        server = "{{$serverLinks->server_10}}"; 
                        break;
                }
                $("iframe").attr('src',server); 
            });
        });
    </script>
    
</body>
    
    
</html>