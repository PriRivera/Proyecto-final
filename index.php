<?php

    namespace Medoo;
    require 'Medoo.php';
    if(isset($_SESSION["isLoggedIn"])){//isset si una funcion existe    
        $database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'ai_2018',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
        $users = $database->select("tb_users", "*");    
    }else{
        //header("location:login.php");

    }
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Secret du chef">
    <!--Aiuda-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Icon Library-->
    <title>Home</title>
</head>

<body>
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
                        <li class="burger-menu__li login_menu">Login</li>
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
            <div class="main-nav__search-container">
                <input class="search-text" type="text" placeholder="Search.." name="search">
                <a class="main-nav__button" href="#"><i class="fa fa-search"></i></a>
            </div>
            <ul class="main-nav__list">
                <li class="main-nav__item"><a class="main-nav__link" href="index.php">Home</a></li>
                <li class="main-nav__item"><a class="main-nav__link" href="contact.php">Contact</a></li>
                <li class="main-nav__item"><a class="main-nav__link" href="login.php">Login</a></li>
                
                <div class="prueba">
                <button class="dropbtn"><?php echo $_SESSION["usr"];?></button>
                <div id="logedin" class="main-nav__item  dropdown"> 
                    <div class="dropdown-content">
                        <a href="profile.php" class="dropdown-content__a">Profile</a>
                        <a href="submit.php" class="dropdown-content__a">New recipe</a>
                        <a id="logout" href="#" class="dropdown-content__a">Log out</a>
                    </div>
                </div>
                </div>
            </ul>
        </nav>
        <div class="main-background__container">
            <div class="main-slider">
                <div class="slider-background">
                    <ul class="slider-ul">
                        <li class="slider-li"><img class="slider-img" src="img/arroz-con-leche.jpg" alt="Sweet rice dessert"></li>
                        <li class="slider-li"><img class="slider-img" src="img/ensalada-cesar.jpg" alt="Caesar salad"></li>
                        <li class="slider-li"><img class="slider-img" src="img/gallo-pinto.jpg" alt="Gallo pinto"></li>
                        <li class="slider-li"><img class="slider-img" src="img/penne-tomate.jpg" alt="Penne pasta with tomato"></li>
                        <li class="slider-li"><img class="slider-img slider-img--queque" src="img/queque.jpeg" alt="cake"></li>
                    </ul>
                </div>
            </div>
            <img src="img/logo.png" alt="" class="mobile-logo">
        </div>
    </header>
    <section class="mid-container">
        <ul class="sub-menu">
            <li class="sub-menu_item"><a class="sub-menu_link" href="#">Healthy</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="#">Desserts</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="#">Meats</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="#">Pastas</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="search.php">Baked</a></li>
        </ul>
        <div class="main-recipies">
            <img class="recipe-img" src="img/recipes.png" alt="recepies">
            <ul class="recipe-menu">
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link"><img class="recipe-menu_img" src="img/frenchToast.png" alt="French Toast">French Toast</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link"><img class="recipe-menu_img" src="img/elementoLista.jpeg" alt="lasagna">Pasta Pie</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link"><img class="recipe-menu_img" src="img/chicken.png" alt="fried chicken">Chicken Tenders</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link"><img class="recipe-menu_img" src="img/favrecipes.jpeg" alt="fried chicken wings">Chicken Wings</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link"><img class="recipe-menu_img" src="img/papa.jpg" alt="baked potato">Baked Potato</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link"><img class="recipe-menu_img" src="img/ultreia-039.jpg" alt="fish">Gourmet Fish</a>
                </li>
            </ul>
            <div class="red-block"></div>
        </div>
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
</body>

</html>