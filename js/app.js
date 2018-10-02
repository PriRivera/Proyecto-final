var toRegister = $('.to-register'),
    btnLogin = $('.btn-login'),
    btnLogout = $('#logout');
toRegister.click(function(){
   $('.cuadro-login').css({"display":"none"}),
   $('.cuadro-registro').css({"display":"block"});
});
btnLogin.click(function(){
    $('#login').css({"display":"none"}),
    $('.dropbtn').css({"display":"inline-block"});
});
btnLogout.click(function(){
    $('#login').css({"display":"inline-block"}),
    $('.dropbtn').css({"display":"none"});
});

//Enter text area
/*
var textArea = document.getElementById("textArea");
textArea.addEventListener("keyup", function(event) {
  event.preventDefault();

  if (event.keyCode === 13) {
    //document.getElementById("myBtn").click();
    console.log(textArea.value);
  }
});

function guardarDatos()
{
    console.log(textArea.value);
}*/