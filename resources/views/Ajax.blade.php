<i style="display:none; color:white;position:absolute;z-index:1;left:50%;" class="fas fa-spinner fa-5x fa-spin"></i>


@if ($movies->total() === 0)
<h1 style="color:white;position:absolute;z-index:1;left:40%;padding-top:20vh;">لا توجد نتائج للبحث ...</h1>    
@else
    
@foreach ($movies as $movie)

<div class="movie" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">

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
@endif