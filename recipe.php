<?php
//'response.php?id=".$i."
    namespace Medoo;
    require 'Medoo.php';
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'secret_du_chef',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);
    $recipesId = $database->select("tb_recipes", "id_recipe");
    if($_GET){
        foreach ($recipesId as $id) {
            if ($_GET["id"]==$id) {
                $recipe = $database->select("tb_recipes", "*",["id_recipe"=>$id]);
                $ingredients = $database -> select("tb_ingredients","*",["id_recipe"=>$id]);
                $user = $database -> select("tb_users","*",["id_user"=>$recipe["recipe_user_id"]]);
            }
        }
        if($recipe==null){
            print_r("when get id is false we sould set default values for the recipe");
        }
    }else{        
        header("location:index.php");
    }
    session_start();
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
    <meta name="description" content="¿Que se supone que va aquí"> <!--Aiuda-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--Icon Library-->
    <title>Baked potato</title>
</head>
<body class="">
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
                                        <form action='recipe.php' method='POST'>
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
    <section class="recipe-sector">
        <h1 class="recipe-title"><?php echo $recipe[0]["recipe_name"]?></h1>
        <div class="left-block">
            <div class="recipe-image--container">
                <img class="recipe-image" src="imgs/<?php echo $recipe[0]["recipe_image"]?>" alt="Baked potato.">
            </div>
        </div>
        <div class="right-block">
            <h3><span>Author</span></h3>
            <p>By: Priscilla la loca</p>
            <br>
            <h3><span>Description</span></h3>
            <p class="main-p"><?php echo $recipe[0]["recipe_description"]?></p>
        </div>
        <div class="central-block">
            <br><br>
            <h3><span>Ingredients</span> list</h3> <br>
            <table class="ingredient-table">
                <tr class="ingredient-title">
                    <th>Ingredient</th>
                    <th>Amount</th> 
                    <th>Measure</th>
                </tr>         
                <?php
                    foreach ($ingredients as $value) {
                        echo "<tr><th>".$value["ingredient_name"]."</th><th>".$value["ingredient_amount"]."</th><th>".$value["ingredient_measure"]."</th></tr>";
                    }
                ?>
            </table>
            <br><br>
            <h3><span>Preparation</span> instructions.</h3>
            <p class="main-p"><?php echo $recipe[0]["recipe_instructions"]?></p>
                <div class="vote_recipe">
                <h4>Vote for this recipe</h4>
                <button class="fa fa-heart-o main-heart vote_btn"style="font-size:50px"></button>
            </div>
        </div>
    </section>
    <footer class="main-footer">
        <nav class="footer-nav">
            <a href="index.php"><img class="footer-logo" src="img/logo.png" alt="Secret du Chef's logo"></a>
            <ul class="footer-imgs">
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/fb.png" alt="facebook"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/instagram.png" alt="instagram"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/pinterest.png" alt="pinterest"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/youtube.png" alt="youtube"></a></li>
            </ul>   
            <p class="footer-p"> A proyect by <br> Priscilla Rivera <br> Hiram González</p> 
        </nav>       
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>