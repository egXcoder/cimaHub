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
            @if($movie->ratings!=0 && $movie->ratings!==null)
            <div class="quality-label">Web-Dl</div>
            <div style="right:30px;" class="rating-star"><i class="fas fa-star"></i></div>
            <span style="right:39px;" class='rating-value'>{{$movie->ratings}}</span> @endif
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
            <div class="time">
                <p>المدة :</p>
                <p>181</p>
                <p>دقيقة</p>
            </div>
            <div class="actors">
                <p>الممثلين :</p>
                <div class="carousel_actors" style="width:800px">
                    <div class="carousel_item">
                        <img class="actor-img" src="https://www.cheatsheet.com/wp-content/uploads/2019/06/Robert-Downey-Jr.-4.jpg" alt="Actor Name is here">
                        <div class="card-body">
                            <p class="actor_name">Robert Downey Jr</p>
                        </div>
                    </div>
                    <div class="carousel_item">
                        <img class="actor-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Chris_Evans_SDCC_2014.jpg/220px-Chris_Evans_SDCC_2014.jpg" alt="Actor Name is here">
                        <div class="card-body">
                            <p class="actor_name">Chris Evans</p>
                        </div>
                    </div>

                    <div class="carousel_item">
                        <img class="actor-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Mark_Ruffalo_in_2017_by_Gage_Skidmore.jpg/220px-Mark_Ruffalo_in_2017_by_Gage_Skidmore.jpg" alt="Actor Name is here">
                        <div class="card-body">
                            <p class="actor_name">Mark Ruffalo</p>
                        </div>
                    </div>

                </div>
            
            </div>

        </div>
    </div>
</div>




<div class="servers-movie-container">
    <div class="servers-section">

        @for ($i = 1; $i
        < count($serverLinks)+1; $i++) <div id="{{$i}}" class="server"><a>سيرفر {{$i}} </a></div>
    @endfor

</div>

<div class="video-container">
    <iframe sandbox="allow-scripts allow-same-origin" width=100% height=600px src="{{$serverLinks[0]}}" frameborder=0
        allowfullscreen></iframe>
</div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function(){
            var list = [];
            @foreach($serverLinks as $serverLink)
                list.push("{{$serverLink}}");
            @endforeach
            $(".server").click(function(){
                var selected_server_id = $(this).attr('id') - 1;
                $("iframe").replaceWith(('<iframe sandbox="allow-scripts allow-same-origin" width=100% height=600px src="' + list[selected_server_id] + '" frameborder=0 allowfullscreen></iframe>')); 
            });
        });

    $('.carousel_actors').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        rtl: true,
        dots: true,
    });    
</script>
@endsection