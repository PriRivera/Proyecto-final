var toRegister = $('.to-register'),
    btnLogin = $('.btn-login'),
    btnLogout = $('#logout');

toRegister.click(function() {
    $('.login-box').css({ "display": "none" }),
        $('.registry-box').css({ "display": "block" });
});


$('document').ready(function() {
    $("#form-create-account").validate({
        rules: {
            usr: {
                required: true,
                minlength: 5
            },
            mail: {
                required: true
            },
            pass: {
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
            email: {
                required: "Please enter a email",
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