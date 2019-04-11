@extends('Layout') 
@section('extraStylesheets')
<link rel="stylesheet" href="css/single.css">
@endsection
 
@section('content')
<div class="header">
    <div class="row">
        <div class="image-cover">
            <img src="{{$movie->image_url}}" alt="{{$movie->name}}">
        </div>
        <div class="block">
            <div id="movie-name">
                <h1>{{$movie->name}}</h1>
            </div>
            <div class="movie-description">
                <p>{{$movie->description}}</p>
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
    <iframe sandbox="allow-scripts allow-same-origin" width=100% height=600px src="{{$serverLinks[0]}}" frameborder=0 allowfullscreen></iframe>
</div>
</div>


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
@endsection