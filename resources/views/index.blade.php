@extends('Layout')
@section('extraStylesheets')
 <link rel="stylesheet" href="{{asset('css/index.css')}}">    
@endsection

@section('content')

<main id="container">
    <div class="search-block">
        <div id="search-bar">
            <span><i class="fas fa-search"></i></span>
            <input onkeydown="if(event.keyCode ==13) ajaxLoad('{{url('search/?search=')}}'+this.value)" id="search"
                class="search-bar__input" placeholder="بحث..."></input>
        </div>
    </div>
    
    <div id="main">
        <div class="section">
            <div class="section-div"><h1 class="section-button">افلام جديدة <i style="margin-right:.5rem;" class="fas fa-angle-left"></i></h1></div>
            <div id="movies-section">
                <i style="display:none; color:white;position:absolute;z-index:1;left:50%;" class="fas fa-spinner fa-5x fa-spin"></i> 
                @foreach ($new_movies as $movie)
                <div class="movie" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">
                    @if(!empty($movie->quality))
                    <div class="quality-label">{{$movie->quality}}</div>
                    @endif 
                    @if(!empty($movie->ratings))
                    <div class="rating-star"><i class="fas fa-star"></i></div>
                    <span class='rating-value'>{{$movie->ratings}}</span>
                    @endif
                    <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}"><img class="lozad" data-src='{{$movie->image_url}}'></a>
                    <div class="movie-view-count__container">
                        <p class="view-count"> &nbsp <i class="fas fa-eye"></i> </p>
                    </div>
    
                    <div class="movie-title__container">
                        <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}">
                            <h2 class='movie-title'>{{$movie->name}}</h2>
                        </a>
                    </div>
    
                    <div class="overdrop-bottom">
    
                    </div>
                </div>
                @endforeach
                <div><a href="{{route('movie.english')}}" class="section-button">عرض المزيد...</a></div>
            </div>
        </div>

        <div class="section-div"><h1 class="section-button">الافلام الاعلى تقييما <i style="margin-right:.5rem;" class="fas fa-angle-left"></i></h1></div>
        <div id="movies-section">
            <i style="display:none; color:white;position:absolute;z-index:1;left:50%;" class="fas fa-spinner fa-5x fa-spin"></i> 
            @foreach ($top_rated as $movie)
            <div class="movie" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">
                @if(!empty($movie->quality))
                <div class="quality-label">{{$movie->quality}}</div>
                @endif 
                @if(!empty($movie->ratings))
                <div class="rating-star"><i class="fas fa-star"></i></div>
                <span class='rating-value'>{{$movie->ratings}}</span>
                @endif
                <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}"><img class="lozad" data-src='{{$movie->image_url}}'></a>
                <div class="movie-view-count__container">
                    <p class="view-count"> &nbsp <i class="fas fa-eye"></i> </p>
                </div>

                <div class="movie-title__container">
                    <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}">
                        <h2 class='movie-title'>{{$movie->name}}</h2>
                    </a>
                </div>

                <div class="overdrop-bottom">

                </div>
            </div>
            @endforeach
            <div><a href="{{route('movie.english')}}" class="section-button">عرض المزيد...</a></div>
        </div>
        
        <div class="section-div"><h1 class="section-button">افلام اجنبى <i style="margin-right:.5rem;" class="fas fa-angle-left"></i></h1></div>
        <div id="movies-section">
            <i style="display:none; color:white;position:absolute;z-index:1;left:50%;" class="fas fa-spinner fa-5x fa-spin"></i> 
            @foreach ($english_movies as $movie)
            <div class="movie" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">
                @if(!empty($movie->quality))
                <div class="quality-label">{{$movie->quality}}</div>
                @endif 
                @if(!empty($movie->ratings))
                <div class="rating-star"><i class="fas fa-star"></i></div>
                <span class='rating-value'>{{$movie->ratings}}</span>
                @endif
                <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}"><img class="lozad" data-src='{{$movie->image_url}}'></a>
                <div class="movie-view-count__container">
                    <p class="view-count"> &nbsp <i class="fas fa-eye"></i> </p>
                </div>

                <div class="movie-title__container">
                    <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}">
                        <h2 class='movie-title'>{{$movie->name}}</h2>
                    </a>
                </div>

                <div class="overdrop-bottom">

                </div>
            </div>
            @endforeach
            <div><a href="{{route('movie.english')}}" class="section-button">عرض المزيد...</a></div>
        </div>
        
        <div class="section-div"><h1 class="section-button">افلام هندى <i style="margin-right:.5rem;" class="fas fa-angle-left"></i></h1></div>
        <div id="movies-section">
            <i style="display:none; color:white;position:absolute;z-index:1;left:50%;" class="fas fa-spinner fa-5x fa-spin"></i> 
            @foreach ($indian_movies as $movie)
            <div class="movie" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">
                @if(!empty($movie->quality))
                <div class="quality-label">{{$movie->quality}}</div>
                @endif 
                @if(!empty($movie->ratings))
                <div class="rating-star"><i class="fas fa-star"></i></div>
                <span class='rating-value'>{{$movie->ratings}}</span>
                @endif
                <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}"><img class="lozad" data-src='{{$movie->image_url}}'></a>
                <div class="movie-view-count__container">
                    <p class="view-count"> &nbsp <i class="fas fa-eye"></i> </p>
                </div>

                <div class="movie-title__container">
                    <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}">
                        <h2 class='movie-title'>{{$movie->name}}</h2>
                    </a>
                </div>

                <div class="overdrop-bottom">

                </div>
            </div>
            @endforeach
            <div><a href="{{route('movie.indian')}}" class="section-button">عرض المزيد...</a></div>
        </div>
        
        <div class="section-div"><h1 class="section-button">افلام انمى <i style="margin-right:.5rem;" class="fas fa-angle-left"></i></h1></div>
        <div id="movies-section">
            <i style="display:none; color:white;position:absolute;z-index:1;left:50%;" class="fas fa-spinner fa-5x fa-spin"></i> 
            @foreach ($animation_movies as $movie)
            <div class="movie" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">
                @if(!empty($movie->quality))
                <div class="quality-label">{{$movie->quality}}</div>
                @endif 
                @if(!empty($movie->ratings))
                <div class="rating-star"><i class="fas fa-star"></i></div>
                <span class='rating-value'>{{$movie->ratings}}</span>
                @endif
                <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}"><img class="lozad" data-src='{{$movie->image_url}}'></a>
                <div class="movie-view-count__container">
                    <p class="view-count"> &nbsp <i class="fas fa-eye"></i> </p>
                </div>

                <div class="movie-title__container">
                    <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}">
                        <h2 class='movie-title'>{{$movie->name}}</h2>
                    </a>
                </div>

                <div class="overdrop-bottom">

                </div>
            </div>
            @endforeach
            <div><a href="{{route('movie.animation')}}" class="section-button">عرض المزيد...</a></div>
        </div>

    </div>
</main>
@endsection
 
@section('scripts')
<script>
    function ajaxLoad(url){
        $('#movies-section .movie').hide();
        $('#movies-section').find('.fa-spin').show();
    $.ajax({
        type: "GET",
        url : url,
        success:function(data){
            if(data==='') window.location = "{{route('home')}}";
            $('#movies-section').html(data);
            $('.paginate-container').hide();
        },
        error: function (request, status, error) {
            //TODO:Sweet alert should be used
           alert(request.responseText);
        }
    });
}
</script>
@endsection