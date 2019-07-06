@extends('Layout')
@section('extraStylesheets')
<link rel="stylesheet" href="css/single.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
@endsection

@section('content')
<div class="header">
    <div class="row">
        <div class="image-cover">
            
            @if($movie->quality!=='0' && $movie->quality!==null)
            <div class="quality-label">{{$movie->quality}}</div>
            @endif

            @if($movie->ratings!=0 && $movie->ratings!==null)
            <div style="right:30px;" class="rating-star"><i class="fas fa-star"></i></div>
            <span style="right:39px;" class='rating-value'>{{$movie->ratings}}</span> 
            @endif
            <img src="{{$movie->image_url}}"">
        </div>
        <div class=" block">
            <div id="movie-name">
                <h1>{{$movie->name}}</h1>
            </div>
            <div class="movie-description">
                <p>{{$movie->description}}</p>
            </div>
            @if ($movie->getYearFromName($movie->name)!==null)
            <div class="year">
                <p>اصدار :</p>
                <p>{{$movie->getYearFromName($movie->name)}}</p>
            </div>
            @endif
            @if($movie->time_length!==null)
            <div class="time">
                <p>المدة :</p>
                <p>{{$movie->time_length}}</p>
                <p>دقيقة</p>
            </div>
            @endif
            @if($movie->genre->isNotEmpty())
            <div class="genre">
                <p>النوع :</p>
                @foreach ($movie->genre as $genre)
                <p><a href="{{route('movie.genre',['name'=>$genre->name])}}">{{$genre->name}} </a><p>
                @endforeach
            </div>
            @endif
            @if($movie->actor->isNotEmpty())
            <div class="actors">
                <p>الممثلين :</p>
                <div class="carousel_actors" style="margin-top:1rem;">
                    @foreach ($movie->actor as $actor)
                        <div class="carousel_item">
                            <img class="actor-img" src="{{$actor->image_url}}" alt="{{$actor->name}}">
                            <div class="card-body">
                                <p class="actor_name">{{$actor->name}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<div class="servers-movie-container">
    <div class="servers-section">
        @for ($i = 1; $i< count($serverLinks)+1; $i++) 
        <div id="{{$i}}" class="server">
            <a>
                @php
                $parsed = parse_url($serverLinks[$i-1]);
                $server_name = preg_replace('!www\.!','',$parsed['host']);
                echo $server_name; 
                @endphp
            </a>
        </div>
        @endfor
        @for ($i = 1; $i< count($downloadLinks)+1; $i++) 
        <div class="download_server">
            <a href="{{$downloadLinks[$i-1]}}">Download</a>
            
        </div>
        @endfor
</div>

<div class="video-container">
    <iframe id="iframe" sandbox="allow-scripts allow-same-origin" width=100% height=600px src="{{$serverLinks[0]}}" frameborder=0
        allowfullscreen></iframe>
</div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(()=>{
            var list = [];
            @foreach($serverLinks as $serverLink)
                list.push("{{$serverLink}}");
            @endforeach
            $(".server").click(function(){
                var selected_server_id = $(this).attr('id') - 1;
                $("iframe").replaceWith(('<iframe id="iframe" sandbox="allow-scripts allow-same-origin" width=100% height=600px src="' + list[selected_server_id] + '" frameborder=0 allowfullscreen></iframe>')); 
            });
        });
        

    $('.carousel_actors').slick({
        slidesToShow: 3,
        infinite: true,
        slidesToScroll: 1,
        rtl: true,
        responsive: [
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true
            }
        }
        ]
    });    
</script>
@endsection