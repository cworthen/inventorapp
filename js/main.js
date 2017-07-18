
//setting inventor screen 0 is not working as expected
//the heading or intro won't return
//jquery won't add display none to inventor screen and it shows
// behind home screen
// changed the position of the icons





$(document).ready(function(){

  $('.home-icon').click(function(){

  //if(!$(this).hasClass('faded')){

$('.home-screen').removeClass('animated  fadeOut');
$('.home-screen').addClass('animated fadeIn');
$('.inventor-screen').css('display','none');
$('.home-screen').css('display', 'block');
$(".intro").css('display','block');


//}

});
});



    // location.reload();

//welcome screen pop-up

var info = document.getElementById("info");
info.addEventListener("click", function(){
  $('.modal').addClass('animated fadeInUp');
  modal.style.display="block";
});

//close out welcome screen
var modal = document.querySelector('.modal');
var span = document.querySelector('.close');
span.addEventListener("click", function(){
  modal.style.display="none";
});


//To have the welcome automatically show once to new users

if(localStorage.getItem("modal")){
  //console.log("You were already here");
  modal.style.display="none";
}else{
  //console.log("Oh. A new guest...");
  modal.style.display="block";
  localStorage.setItem("modal",true);
}



//sources pop-up

var sources = document.getElementById('sources');
var bkground = document.querySelector('.overlay');

sources.addEventListener('click', function(){
  modalSources.style.display="block";
  $('#modalSources').addClass('animated fadeInUp');
  bkground.style.display="block";
});


var close = document.querySelector('#close');
close.addEventListener('click', function(){
  modalSources.style.display="none";
  bkground.style.display="none";
});



//change color of squares

function randColor(){


  var color; // hexadecimal starting symbol
  var letters = ['f44336','9c27b0','3f51b5','00bcd4','2196f3','ffeb3b','9e9e9e','062a40', '4caf50', 'cc1ac5']; //Set your colors here

  var squares = document.getElementsByClassName("outer-square");

  for(var i=0; i < squares.length; i++)
  {
    color ="#";
    color += letters[Math.floor(Math.random() * letters.length)];
    squares[i].style.backgroundColor = color;
  }

}

setInterval(randColor, 6000);
