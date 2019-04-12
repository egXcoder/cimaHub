@extends('Layout')

@section('extraStylesheets')
<link rel="stylesheet" href="css/main.css">    
@endsection

@section('content')
 
<main id="container">
        <div id="search-bar">
            <span><i class="fas fa-search"></i></span>
            <input class="search-bar__input" placeholder="بحث..."></input>
        </div>

        <div id="main">

            <div id="movies-section">

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


            </div>

        </div>

        <div class="paginate-container">

            {{$movies->onEachSide(1)->links()}}
        </div>

    </main>


@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@endsection