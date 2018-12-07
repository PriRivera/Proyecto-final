<?php
    namespace Medoo;
    require 'Medoo.php';
    session_start();
    if(isset($_SESSION["isLoggedIn"])){  
        $database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'ai_2018',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
        $users = $database->select("tb_users", "*");    
    }
    if($_POST){
        if(isset($_POST["logout"])){
            session_destroy();
            header("location:index.php");
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
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
                    <a href="index.php" class="burger-menu__link"><li class="burger-menu__li">Home</li></a>
                    <a href="contact.php" class="burger-menu__link"><li class="burger-menu__li">Contact</li></a>
                    <?php
                        if (isset($_SESSION["isLoggedIn"])) {
                            echo"
                                <a href='profile.php' class='burger-menu__link'><li class='burger-menu__li'>Profile</li></a>
                                <a href='submit.php' class='burger-menu__link'><li class='burger-menu__li'>New recipe</li></a>
                                <form action='profile.php' method='POST'>
                                    <input type='submit' id='sublogout' name='logout' value='true' style='display:none;'>
                                    <label for='sublogout' id='logout' class='burger-menu__link'>Log out
                                </form>
                            ";#<a href="" class="burger-menu__link"><li class="burger-menu__li">Logout</li></a>
                        } else {
                            echo"
                                <a href='login.php' class='burger-menu__link'><li class='burger-menu__li'>Login</li></a>
                            ";
                        }                    
                    ?>
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
        <div class="main-background__container">
            <div class="main-slider">
                <div class="slider-background">
                    <h1 class="main-text_index  wow slideInRight" data-wow-delay="0s" data-wow-duration="3s" data-wow-iteration="1">Chef's recommendation</h1> 
                    <?php echo "<ul class='slider-ul'>
                        <li class='slider-li'><a href='recipe.php?id=9'><img class='slider-img' src='img/arroz-con-leche.jpg' alt='Sweet rice dessert'></a></li>
                        <li class='slider-li'><a href='recipe.php?id=10'><img class='slider-img' src='img/ensalada-cesar.jpg' alt='Caesar salad'></a></li>
                        <li class='slider-li'><a href='recipe.php?id=11'><img class='slider-img' src='img/gallo-pinto.jpg'  alt='Gallo pinto'></a></li>
                        <li class='slider-li'><a href='recipe.php?id=12'><img class='slider-img' src='img/penne-tomate.jpg' alt='Penne pasta with tomato'></a></li>
                        <li class='slider-li'><a href='recipe.php?id=13'><img class='slider-img slider-img--queque' src='img/queque.jpeg' alt='cake'></a></li>   
                    </ul>"?>  
                </div>
            </div>
            <img src="img/logo.png" alt="" class="mobile-logo">
        </div>
    </header>
    <section class="mid-container">
        <ul class="sub-menu">
            <li class="sub-menu_item"><a class="sub-menu_link" href="search.php?keyWord=Healthy">Healthy</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="search.php?keyWord=Dessert">Desserts</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="search.php?keyWord=Meat">Meats</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="search.php?keyWord=Pasta">Pastas</a></li>
            <li class="sub-menu_item"><a class="sub-menu_link" href="search.php?keyWord=Baked">Baked</a></li>
        </ul>
        <div class="main-recipies">
            <img class="recipe-img wow fadeIn" src="img/recipes.png" alt="recepies">
            <ul class="recipe-menu">
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link" href="recipe.php?id=4"><img class="recipe-menu_img wow fadeIn" src="img/frenchToast.png" alt="French Toast">French Toast</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link" href="recipe.php?id=6"><img class="recipe-menu_img wow fadeIn" src="img/elementoLista.jpeg" alt="lasagna">Pasta Pie</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link" href="recipe.php?id=3"><img class="recipe-menu_img wow fadeIn" src="img/chicken.png" alt="fried chicken">Chicken Tenders</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link" href="recipe.php?id=7"><img class="recipe-menu_img wow fadeIn" src="img/favrecipes.jpeg" alt="fried chicken wings">Chicken Wings</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link" href="recipe.php?id=2"><img class="recipe-menu_img wow fadeIn" src="img/papa.jpg" alt="baked potato">Baked Potato</a>
                </li>
                <li class="recipe-menu_item">
                    <a class="recipe-menu_link" href="recipe.php?id=5"><img class="recipe-menu_img wow fadeIn" src="img/ultreia-039.jpg" alt="fish">Gourmet Fish</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    
    <script>
        new WOW().init();
    </script>
</body>

</html>