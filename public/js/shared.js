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
        });



    document.querySelector(".toggle-button").onclick = function(){
        
        document.querySelector('.backdrop').style.display = 'block'; 
        
        setTimeout(function(){
            document.querySelector('.backdrop').classList.add('show');
            document.querySelector('.mobile-nav__items').style.display = 'flex';
        },100);
    
        setTimeout(function(){
            document.querySelector('.mobile-nav__items').style.display = 'flex';
        },500);
    
        
        
        document.querySelector('.mobile-nav').style.display = 'block';
   
        setTimeout(function(){
            document.querySelector('.mobile-nav').classList.add('shownav');
        } ,10)
        
        
        
    };
        


var closeBackdrop = function(){
        document.querySelector('.backdrop').classList.remove('show');
    
        setTimeout(function(){
            document.querySelector('.backdrop').style.display = 'none';
        }, 200)
}



document.querySelector('.backdrop').onclick = function(){
    
    
    document.querySelector('.mobile-nav').classList.remove('shownav');
    setTimeout(function(){
        document.querySelector('.mobile-nav').style.display = 'none';
    } ,600)
    
    document.querySelector('.mobile-nav__items').style.display = 'none';
    
    
    closeBackdrop();
   
};












