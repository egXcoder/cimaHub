@extends('Layout')
@section('extraStylesheets')
 <link rel="stylesheet" href="{{asset('css/app.css')}}">    
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
        <div id="movies-section">
            <i style="display:none; color:white;position:absolute;z-index:1;left:50%;"
                class="fas fa-spinner fa-5x fa-spin"></i>
            @foreach ($movies as $movie)
            <div class="movie" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-once="true">
                @if($movie->quality!=='0' && $movie->quality!==null)
                <div class="quality-label">{{$movie->quality}}</div>
                @endif @if($movie->ratings!=0 && $movie->ratings!==null)
                <div class="rating-star"><i class="fas fa-star"></i></div>
                <span class='rating-value'>{{$movie->ratings}}</span> @endif
                <a href="{{route('movie.single',['slug'=>$movie->getSlug()])}}"><img src='{{$movie->image_url}}'></a>
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

        </div>

        <div class="paginate-container">
            {{$movies->onEachSide(1)->links()}}
        </div>

    </div>
</main>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
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