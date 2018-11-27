var toRegister = $('.to-register'),
    btnLogin = $('.btn-login'),
    btnLogout = $('#logout');
toRegister.click(function() {
    $('.cuadro-login').css({ "display": "none" }),
        $('.cuadro-registro').css({ "display": "block" });
});