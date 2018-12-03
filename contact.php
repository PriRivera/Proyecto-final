<?php
    namespace Medoo;
    require 'Medoo.php';

    $database = new Medoo([

        'database_type' => 'mysql',
        'database_name' => 'secret_du_chef',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);
    session_start();
    $user = $database->select("tb_users","*",["id_user"=>$_SESSION['usrid']]);
    if(!isset($_SESSION["isLoggedIn"])){
        header("location:login.php");
    }
    if($_POST){
        if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['comments'])){
            $database->insert("tb_contact", [
                "name"=> $_POST["name"],
                "email"=> $_POST["email"],
                "comments"=>$_POST["comments"]
            ]);
            header("location:index.php"); #feedBack positivo
        }else{
            print_r($_POST);
        }
        if(isset($_POST["logout"])){
            session_destroy();
            header("location:login.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Contact page">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact</title>
</head>

<body class="body-contact">
    <header>
        <nav class="main-nav">            
            <div class="burger">
                <input type="checkbox" class="burger__button">
                <span class="burger__span"></span>
                <span class="burger__span"></span>
                <span class="burger__span"></span>
                <ul class="burger-menu">
                    <a href="index.php" class="burger-menu__link"><li class="burger-menu__li">Home</li></a>
                    <a href="contact.php" class="burger-menu__link"><li class="burger-menu__li">Contact</li></a>
                    <a href="login.php" class="burger-menu__link"><li class="burger-menu__li">Login</li></a>
                    <a href="profile.php" class="burger-menu__link"><li class="burger-menu__li">Profile</li></a>
                    <a href="submit.php" class="burger-menu__link"><li class="burger-menu__li">New recipe</li></a>
                    <a href="#" class="burger-menu__link"><li class="burger-menu__li">Logout</li></a>
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
                    <?php 
                        if (isset($_SESSION["isLoggedIn"])) {
                            echo "<div id='logedin' class='main-nav__item  dropdown'>
                                    <button class='dropbtn'>".$_SESSION["usr"]."</button>
                                    <div class='dropdown-content'>
                                        <a href='profile.php' class='dropdown-content__a'>Profile</a>
                                        <a href='submit.php' class='dropdown-content__a'>New recipe</a>
                                        <form action='profile.php' method='POST'>
                                            <input type='submit' id='sublogout' name='logout' value='true' style='display:none;'>
                                            <label for='sublogout' id='logout' class='dropdown-content__a'>Log out
                                        </form>
                                    </div>
                                </div>";
                        }else{
                            echo "<li class='main-nav__item'><a class='main-nav__link'href='login.php'>Login</a></li>";
                        }
                    ?>                   
            </ul>
        </nav>
    </header>
    <section class="contact-box">
        <p class="p-have">Have <span class="p-have--span">Questions?</span></p>
        <form  action="contact.php" method="post"  class="form-contact" id="contact-form">
            <label class="form-text">Name:</label><br>
            <input class="form-login_imput" id="name" type="text" name="name" value="<?php echo $user[0]['username'] ?>" minlength="1" data-msg="Please enter your name" style="pointer-events: none;"> <br>
            <label class="form-text">Email:</label><br>
            <input class="form-login_imput" id="email" type="email" name="email" value="<?php echo $user[0]['email'] ?>" minlength="1" data-msg="Please enter your email" style="pointer-events: none;"> <br>
            <label class="form-text">Comments:</label><br>
            <textarea class="form-login_imput comments" id="comments" type="text" name="comments" placeholder="Give us your feedback.." minlength="1" data-msg="Please enter your feedback" required></textarea> <br>
            <input id="send" class="main-btn send-btn" type="submit" value="Send">
        </form>
    </section>
    <footer class="main-footer">
        <nav class="footer-nav">
            <a href="index.html"><img class="footer-logo" src="img/logo.png" alt="Secret du Chef's logo"></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
    <script>
        $('document').ready(function() {

            $('#contact-form').validate();

        });
    </script>
</body>

</html>