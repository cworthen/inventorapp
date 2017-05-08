
$(document).ready(function(){

  $('.home-icon').click(function(){

		if(!$(this).hasClass('faded')) {
			location.reload();
		}

    });

    });

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
  bkground.style.display="block";
<<<<<<< HEAD
=======
});

var close = document.querySelector('#close');
close.addEventListener('click', function(){
  modalSources.style.display="none";
  bkground.style.display="none";
>>>>>>> a253a35a509b444678f1111cc00960b24f1872e0
});

var close = document.querySelector('#close');
close.addEventListener('click', function(){
  modalSources.style.display="none";
  bkground.style.display="none";
});

//change color of squares


//$('.outer-square').animate({backgroundColor:'red'})
