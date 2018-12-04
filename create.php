<?php
session_start();
if($_SESSION["isLoggedIn"]){
    header("location:profile.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Login page">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Create account</title>
</head>

<body class="body-Login">
    <header>
        <nav class="main-nav">
            <div class="burger">
                <input type="checkbox" class="burger__button">
                <span class="burger__span"></span>
                <span class="burger__span"></span>
                <span class="burger__span"></span>
                <ul class="burger-menu">
                    <a href="index.php" class="burger-menu__link">
                        <li class="burger-menu__li">Home</li>
                    </a>
                    <a href="contact.php" class="burger-menu__link">
                        <li class="burger-menu__li">Contact</li>
                    </a>
                    <a href="login.php" class="burger-menu__link">
                        <li class="burger-menu__li">Login</li>
                    </a>
                    <a href="profile.php" class="burger-menu__link">
                        <li class="burger-menu__li">Profile</li>
                    </a>
                    <a href="submit.php" class="burger-menu__link">
                        <li class="burger-menu__li">New recipe</li>
                    </a>
                    <a href="#" class="burger-menu__link">
                        <li class="burger-menu__li">Logout</li>
                    </a>
                </ul>
            </div>

            <a href="index.php"><img class="logo" src="img/logo.png" alt="Secret du Chef's logo"></a>
            <form action="search.php" class="main-nav__search-container">
                <input class="search-text" type="text" placeholder="Search.." name="keyWord">
                <button class="main-nav__button" href="#"><i class="fa fa-search"></i></button>
            </form>
            <ul class="main-nav__list">
                <li class="main-nav__item"><a class="main-nav__link" href="index.php">Home</a></li>
                <li class="main-nav__item"><a class="main-nav__link" href="contact.php">Contact</a></li>
                <li class="main-nav__item"><a class="main-nav__link" href="login.php">Login</a></li>
                <div id="logedin" class="main-nav__item  dropdown">
                    <button class="dropbtn"></button>
                    <div class="dropdown-content">
                        <a href="profile.php" class="dropdown-content__a">Profile</a>
                        <a href="submit.php" class="dropdown-content__a">New recipe</a>
                        <a id="logout" href="#" class="dropdown-content__a">Log out</a>
                    </div>
                </div>
            </ul>
        </nav>
    </header>
    <section class="registry-box">
        <br><br>
        <img class="login-icon" src="img/Recurso 10.svg" alt="">
        <br>
        <h3><span>Create</span> a new account</h3>
        <form class="form-login" action="" method="post" id="form-create-account">
            <label id="lable-usuario" style="color:red;">Username already exists</label><br>
            <label id="lable-usr" class="form-text">Username:</label><br>
            <input class="form-login_imput" type="text" id="username" name="usr" placeholder="Create a new username.."> <br>
            <label id="label-email" style="color:red;"> Email already exists </label><br>
            <label class="form-text">Email:</label><br>
            <input class="form-login_imput" type="email" id="email" name="mail" placeholder="Your email.."> <br>
            <label class="form-text">Create password:</label><br>
            <input class="form-login_imput" id="password" type="password" name="pass" placeholder="Your password.."><br>
            <label class="form-text">Confirm password:</label><br>
            <input class="form-login_imput" id="confirm_password" type="password" placeholder="Confirm your password.." name="confirm_password"><br>
            <input type="hidden" id="type" value="2"><br>
            <input type="hidden file" id="profileImg" name="image" class="" value="preview.png" style="border:none;display:none;"/>
            <input type="text" id="descrip" name="desc" class="" style="border:none; display:none;" value="Add an account description">
            <input class="main-btn btn-register" type="button" id="btn-register" value="Register">
        </form>
    </section>
   
    <footer class="main-footer">
        <nav class="footer-nav">
            <a href="index.php"><img class="footer-logo" src="img/logo.png" alt="Secret du Chef's logo"></a>
            <ul class="footer-imgs">
                <li class="footer-li_item">
                    <a class="footer-li_link"><img class="footer-li_img" src="img/fb.png" alt="facebook"></a>
                </li>
                <li class="footer-li_item">
                    <a class="footer-li_link"><img class="footer-li_img" src="img/instagram.png" alt="instagram"></a>
                </li>
                <li class="footer-li_item">
                    <a class="footer-li_link"><img class="footer-li_img" src="img/pinterest.png" alt="pinterest"></a>
                </li>
                <li class="footer-li_item">
                    <a class="footer-li_link"><img class="footer-li_img" src="img/youtube.png" alt="youtube"></a>
                </li>
            </ul>
            <p class="footer-p"> A proyect by <br> Priscilla Rivera <br> Hiram González</p>
        </nav>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/login.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
    <script>   

    $('document').ready(function() { 

        $("#lable-usuario").hide();
        $("#label-email").hide();

        $("#btn-register").click(function(){
            var username = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var passwordCon = $("#confirm_password").val();
            var type = $("#type").val();
            var profileImage = $("#profileImg").val();
            
            var description = $("#descrip").val();
                if(username!="" && email!="" && password!="" && passwordCon!="")
                {
                        $.ajax({
                        method: 'POST',
                        url: 'new-users.php',
                        data: {
                            username: username,
                            email: email,
                            password: password,
                            type: type,
                            profileImg: profileImage,
                            descrip: description

                        },
                        error: function(){
                            console.log("error");
                        },
                        success: function(data){  
                            verifiyRegister(data);
                        }
                        
                    });
                }else{
                    alert("Rellene los espacios");
                }
                });  
               

            function  verifiyRegister($data){
                console.log("hola");
                $("#lable-usuario").hide();
                $("#label-email").hide();
                    if($data == "usuarioReady"){
                        $("#lable-usuario").show();
                        
                    }
                    if($data == "correoReady"){
                        $("#label-email").show();
                    }

                    if($data == "correoUsuarioReady")
                    {
                        $("#label-email").show();
                        $("#lable-usuario").show();
                        
                    }

                    if($data == "succesfull"){
                        window.location.href='profile.php';
                    }
            }
     
        });
    </script>
</body>

</html>