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
    if(isset($_SESSION["usrid"])){
        $user = $database->select("tb_users", "*",[
            "id_user"=> $_SESSION["usrid"]
        ]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--Icon Library-->
    <title><?PHP echo $user[0]["username"] ?>'s Profile</title>
</head>
<body>
    <header class="header-background__profile">
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
            <div class="main-nav__search-container">
                <input class="search-text" type="text" placeholder="Search.." name="search">
                <a class="main-nav__button" href="#"><i class="fa fa-search"></i></a>
            </div>
            <ul class="main-nav__list">
                    <li class="main-nav__item"><a class="main-nav__link" href="index.php">Home</a></li>
                    <li class="main-nav__item"><a class="main-nav__link" href="contact.php">Contact</a></li>
                    <li class="main-nav__item"><a class="main-nav__link"href="login.php">Login</a></li>
                    <div id="logedin" class="main-nav__item  dropdown">
                        <button class="dropbtn">Hiram</button>
                        <div class="dropdown-content">
                            <a href="profile.php" class="dropdown-content__a">Profile</a>
                            <a href="submit.php" class="dropdown-content__a">New recipe</a>
                            <a id="logout" href="#" class="dropdown-content__a">Log out</a>
                        </div>
                    </div>
            </ul>
        </nav>
        <div class="img-block border profile-block">
           <a><img class="login-icon profile-img" src="img/Recurso 10.svg" alt="profile image"></a> 
            <p class="p-drop">Drop an image here or</p>
            <input type="file" name="profile photo" class="file-chooser" id="file"> 
            <label for=file class="main-btn main-btn--size" id="profile-chooser"> Choose a file..</label>
        </div>
        <div class="main-profile_div">
        <p class="main-name"><?PHP echo $user[0]["username"] ?></p>
            <label class="form-text account-description">Account Description:</label><br>
            <textarea class="form-login_imput account-description--textarea" placeholder="I like to make healthy and fat food." id="textArea"></textarea>
            <button class="main-btn save-btn" onclick="guardarDatos()">Save</button>
        </header>
        </div>
    <section>
        <h1 class="main-h1__profile">My Recipes</h1>
        <img class="spatulas-img" src="img/paletas.svg" alt="spoon and spatula">
        <ul class="search-content search-content-profile">  
            <li class="search-content_item"><a class="search-content_link">
                <div class="text-img__background"><p class="inside-text">Click to edit</p></div>     
                <img class="profile-content-img pruebaImagen" src="img/receta1.jpg" alt="">
                <p class="recipe-menu_description profile-img__names">Manicotti</p></a>
            </li>
            <li class="search-content_item"><a class="search-content_link">
                <div class="text-img__background"><p class="inside-text">Click to edit</p></div> 
                <img class="profile-content-img" src="img/receta2.jpg" alt="">
                <p class="recipe-menu_description profile-img__names">Mushrooms and beef</p></a>
            </li>
            <li class="search-content_item"><a class="search-content_link">
                <div class="text-img__background"><p class="inside-text">Click to edit</p></div> 
                <img class="profile-content-img" src="img/receta3.png" alt="">
                <p class="recipe-menu_description profile-img__names">Garlic Mushrooms</p></a>
            </li>
            <li class="search-content_item"><a class="search-content_link"> 
                <i class="search-content_img img-block border profile-item plus fa fa-plus style" style="font-size:100px"></i>
                <img class="" src="" alt=""><p class="recipe-menu_description profile-img__names" id="add-id">Add a new recipe</p></a>
            </li>
        </li>
    </ul>
    </section>
<section>
    <i class="fa fa-heart main-heart"style="font-size:50px"></i>
        <h2 class="main-h2__profile">Favorite Recipes</h2>
        <ul class="search-content search-content-favorites">
                <li class="search-content_item"><a class="search-content_link"><img class="search-content_img" src="img/favrecipes.jpeg" alt=""><p class="recipe-menu_description profile-img__names responsive-big_text">Fried Chicken<br>By:Priscilla_Rivera</p></a></li>
                <li class="search-content_item"><a class="search-content_link"><img class="search-content_img" src="img/tortillas.jpeg" alt=""><p class="recipe-menu_description profile-img__names responsive-big_text">Tortillas<br>By:Jorge_Miranda</p></a></li>
        </li>
       </ul>
    </section>
    <footer class="main-footer">
        <nav class="footer-nav">
            <a href="index.php"><img class="footer-logo" src="img/logo.png" alt="Secret du Chef's logo"></a>
            <ul class="footer-imgs">
                <li class="footer-li_item"><a class="footer-li_link"><img class="footer-li_img" src="img/fb.png" alt="facebook"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"><img class="footer-li_img" src="img/instagram.png" alt="instagram"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"><img class="footer-li_img" src="img/pinterest.png" alt="pinterest"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"><img class="footer-li_img" src="img/youtube.png" alt="youtube"></a></li>
            </ul>   
            <p class="footer-p"> A proyect by <br> Priscilla Rivera <br> Hiram González</p> 
        </nav>       
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>