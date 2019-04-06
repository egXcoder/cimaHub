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
           
//           viewCountArr[moviesArr.indexOf(cur)].classList.add('animate-view-count__container');
   
           
           titleArr[moviesArr.indexOf(cur)].classList.add('animate-title__container');
           
       },10)}
        
        cur.onmouseout = function(){
       setTimeout(function(){
           overdropBottomArr[moviesArr.indexOf(cur)].classList.remove('animate-overdrop-bottom');
           
           overdropTopArr[moviesArr.indexOf(cur)].classList.remove('animate-overdrop-top');
           
           
//           viewCountArr[moviesArr.indexOf(cur)].classList.remove('animate-view-count__container');
           
           
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



var scrollToTopButton;
//  html = document.documentElement;
//  body = document.body;
  scrollToTopButton = document.getElementById("scrollToTopButton");





function scrollToTop(totalTime, easingPower) {
  //console.log("here");
  var timeInterval = 1; //in ms
  var scrollTop = Math.round(document.body.scrollTop || document.documentElement.scrollTop);
  //var by=- scrollTop;
  var timeLeft = totalTime;
  var scrollByPixel = setInterval(function() {
    var percentSpent = (totalTime - timeLeft) / totalTime;
    if (timeLeft >= 0) {
      var newScrollTop = scrollTop * (1 - easeInOut(percentSpent, easingPower));
      document.body.scrollTop = newScrollTop;
      document.documentElement.scrollTop = newScrollTop;
      //console.log(easeInOut(percentSpent,easingPower));
      timeLeft--;
    } else {
      clearInterval(scrollByPixel);
      //Add hash to the url after scrolling
      //window.location.hash = hash;
    }
  }, timeInterval);
}

function easeInOut(t, power) {
  if (t < 0.5) {
    return 0.5 * Math.pow(2 * t, power);
  } else {
    return 0.5 * (2 - Math.pow(2 * (1 - t), power));
  }
}

window.onscroll = controlScrollToTopButton;

function controlScrollToTopButton() {
  var windowInnerHeight = 1.5 * window.innerHeight;
  if (
    document.body.scrollTop > windowInnerHeight ||
    document.documentElement.scrollTop > windowInnerHeight
  ) {
    scrollToTopButton.classList.add("show");
  } else {
    scrollToTopButton.classList.remove("show");
  }
}











