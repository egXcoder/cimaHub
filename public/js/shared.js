var moviesList = document.querySelectorAll('.movie');
var moviesArr = Array.from(moviesList);

var overdropTopList = document.querySelectorAll('.overdrop-top');
var overdropTopArr = Array.from(overdropTopList);

var overdropBottomList = document.querySelectorAll('.overdrop-bottom');
var overdropBottomArr = Array.from(overdropBottomList);

var viewCountList = document.querySelectorAll('.movie-view-count__container');
var viewCountArr = Array.from(viewCountList);

var titleList = document.querySelectorAll('.movie-title__container');
var titleArr = Array.from(titleList);



moviesArr.forEach( function(cur){
    
    cur.onmouseover = function(){
       setTimeout(function(){
           overdropBottomArr[moviesArr.indexOf(cur)].classList.add('animate-overdrop-bottom');
           overdropTopArr[moviesArr.indexOf(cur)].classList.add('animate-overdrop-top');
           
           viewCountArr[moviesArr.indexOf(cur)].classList.add('animate-view-count__container');
   
           
           titleArr[moviesArr.indexOf(cur)].classList.add('animate-title__container');
           
       },10)}
        
        cur.onmouseout = function(){
       setTimeout(function(){
           overdropBottomArr[moviesArr.indexOf(cur)].classList.remove('animate-overdrop-bottom');
           
           overdropTopArr[moviesArr.indexOf(cur)].classList.remove('animate-overdrop-top');
           
           
           viewCountArr[moviesArr.indexOf(cur)].classList.remove('animate-view-count__container');
           
           
           titleArr[moviesArr.indexOf(cur)].classList.remove('animate-title__container');
           
           },10)}
        
        
        
//        console.log(cur.index);
    });


//console.log(moviesArr)



