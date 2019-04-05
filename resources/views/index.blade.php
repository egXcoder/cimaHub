<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="أفضل موقع عربي لمشاهدة الأفلام و المسلسلات و الأنمي بسهولة و سرعة">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinemaHub - الرئيسية</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/shared.css">
    <link rel="stylesheet" href="css/main.css">


</head>

<body>


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
            <h3><span style="font-size: 130%">C</span>inemaHub</h3>
        </div>



    </header>




    <div id="search-bar">
        <span><i class="fas fa-search"></i></span>
        <input class="search-bar__input" placeholder="بحث..."></input>
    </div>

    <main id="container">

        <div id="main">

            <div id="movies-section">
            
                @foreach ($movies as $movie)
                
                <div class="movie">
                    <a href="#"><img src='{{$movie->image_url}}'></a>
                   
                    <div class="movie-view-count__container">
                        <p class="view-count">{{$movie->views}} &nbsp <i class="fas fa-eye"></i> </p>
                    </div>
                    
                    <div class="movie-title__container">
                        
                       <a href="#"> <h2 class='movie-title'>{{$movie->name}}</h2></a>

                    </div>
                    

                    <div class="overdrop-top">

                    </div>
                    <div class="overdrop-bottom">

                    </div>
                    

                </div>
                @endforeach


            </div>

        </div>



        <div class="pages-navigation">

            <a href="#" class="right-arrow"><i class="fas fa-arrow-right"></i></a>
            <div>
                <a href='#'>1</a>
                <a href='#'>2</a>
                <a href='#'>3</a>
                <a href='#'>4</a>
                <a href='#'>5</a>
                <a href='#'>6</a>
                <a href='#'>...</a>
            </div>
            <a href="#" class="left-arrow"><i class="fas fa-arrow-left"></i></a>
        </div>

    </main>



    <footer id="main-footer">
        <div class="go-to-top">
            <i class="fas fa-arrow-up"></i>
        </div>


    </footer>

<script src="js/shared.js"></script>


</body>


</html>