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