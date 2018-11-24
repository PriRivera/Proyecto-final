var toRegister = $('.to-register'),
    btnLogin = $('.btn-login'),
    btnLogout = $('#logout');


toRegister.click(function() {
    $('.login-box').css({ "display": "none" }),
    $('.registry-box').css({ "display": "block" });
});
btnLogin.click(function() {
    $('#login').css({ "display": "none" }),
    $('.main-nav__link--right').css({ "display": "none" }),
    $('.dropbtn').css({ "display": "inline-block" });
});
btnLogout.click(function() {
    $('#login').css({ "display": "inline-block" }),
    $('.main-nav__link--right').css({ "display": "inline-block" }),
    $('.dropbtn').css({ "display": "none" });
});


$('document').ready(function() {
    $("#form-create-account").validate({
        rules: {
            username: {
                required: true,
                minlength: 5
            },
            email: {
                required: true
            },
            password: {
                required: true,
                minlength: 10
            },
            confirm_password: {
                required: true,
                minlength: 10,
                equalTo: "#password"
            },
        },
        messages: {
            username: {
                required: "Please enter a username",
                minlength: "Your username has to be at least 5 characters"
            },
            password: {
                required: "Please enter a Password",
                minlength: "Your password has to be at least 10 characters"
            },
            confirm_password: {
                required: "Please enter a Password",
                minlength: "Your password has to be at least 10 characters",
                equalTo: "Please enter the same password as above"
            },
        }

    });
});