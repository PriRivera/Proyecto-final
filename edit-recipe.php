<?php
    namespace Medoo;
    require 'Medoo.php';
    session_start();
    if(!isset($_SESSION["isLoggedIn"])){
        header("location:login.php");
    }
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'secret_du_chef',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);
    $categories = $database->select("tb_recipe_categories", "*");
    $len = count($categories);
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    if($_GET){
        $recipe = $database->select("tb_recipes", "*", ["id_recipe"=>$_GET["id"]]);
        if($recipe[0]["recipe_user_id"]==$_SESSION["usrid"]){
            $ingredients =  $database->select("tb_ingredients", "*", ["id_recipe"=>$recipe[0]['id_recipe']]);
            $recipeCategories =  $database->select("tb_recipe_in_categories", "id_category", ["id_recipe"=>$recipe[0]['id_recipe']]);
        }else{
            header('location:recipe.php?id='.$_GET['id']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Submit a new recipe">
    <!--Aiuda-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Icon Library-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.6.0/Sortable.min.js"></script>
    <script src="js/new-recipe.js"></script>
    <title>Submit recipe</title>
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
    </header>
    <section>
        <img class="main-title" src="img/new-recipe.png" alt="New recipe title">
        <form class="recipe-form" action="edit-recipe-server.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_recipe" value="<?php echo $recipe[0]["id_recipe"] ?>">
            <div class="left-block">
                <div class="img-block border">
                    <img id="preview" class = "img-block" src="imgs/<?php echo $recipe[0]['recipe_image']?>" alt="image to upload"/><br>
                    <p class="img-block__p">Drop an image here <br> or</p>
                    <input type="file" id="file" name="image" class="file-chooser" onchange="readURL(this)"/>
                    <label for=file class="main-btn main-btn--size"> Choose a file..</label>
                </div>
            </div>
            <div class="right-block" id="right-block">
                <h3><span>Name</span> for your recipe.</h3>
                <input class="form-text border right-block__input" type="text" name="recipeName" id="recipe-name" value="<?php echo $recipe[0]['recipe_name']?>">
                <br><br><br>
                <h3><span>Description</span> to show.</h3>
                <textarea class="form-text text-area border right-block__input" name="recipeDescription" id="recipe-description" cols="30" rows="10"> <?php echo $recipe[0]['recipe_description']?> </textarea>
            </div>
            <div class="add-block">
                <br><br>
                <h3><span>Ingredients</span> to be used.</h3> <br>
                <ul id="ingredient-container" class="ingredient"></ul>
                <?php
                    foreach ($ingredients as $value) {
                        echo "<script>  loadIngredient('".$value['ingredient_name']."', '".$value['ingredient_amount']."', '".$value['ingredient_measure']."'); </script>";
                    }
                ?>
                <div id="ingredient" class="ingredient">
                    <div class="form-text generic-container border">
                        <input id="ingredient_name" class="input-base input-name" type="text" placeholder="Ingredient name">
                        <input id="quantity" class="input-base input-quantity" type="number" min="0" step="1" placeholder="0">
                        <input id="measure" class="input-base input-unit" list="medidas" placeholder="Measure">
                    </div>
                </div>
                <input id="add-ingredient-btn" class="main-btn btn-submit" type="button" value="Add ingredient">
                <datalist id="medidas">
                    <option value="Grams">
                    <option value="Ounces">
                    <option value="Liter">
                    <option value="Milliliter">
                    <option value="Cups">
                    <option value="Teaspoon">
                    <option value="Tablespoon"> 
                    <option value="Units"> 
                </datalist>
                <br><br>
                <h3><span>Preparation</span> instructions.</h3>
                <textarea class="form-steps text-area border" name="recipeInstructions" id="recipe-instructions" cols="30" rows="10"><?php echo $recipe[0]['recipe_instructions'] ?></textarea>     
            </div> 
            <div class="div_checkbox">  
            <h3><span>Please choose the category your recipe belongs to:<span></h3>
                <?php
                    for($i = 0; $i<$len; $i++){
                        if(in_array($categories[$i]['id_recipe_category'], $recipeCategories)){
                            echo "<input type='checkbox' id='' class='checkbox_submit' name='categories[]' value='".$categories[$i]["id_recipe_category"]."' checked>";
                        } else{
                            echo "<input type='checkbox' id='' class='checkbox_submit' name='categories[]' value='".$categories[$i]["id_recipe_category"]."'>";
                        }
                        echo "<label for='' class='recipe-category'>".$categories[$i]["recipe_category"]."</label><br>";
                    }
                ?>
                <label for="categories[]" class="error"></label>
            </div> 
            <input type="submit" id="submit-recipe" class="main-btn" value="Save & publish">
        </form>
        <form class="recipe-form" action="edit-recipe-server.php" method="post">
            <input type="hidden" name="delete" value="true">
            <input type="hidden" name="id_recipe" value="<?php echo $recipe[0]["id_recipe"] ?>">
            <input type="submit" id="submit-recipe" class="main-btn" value="Delete recipe">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
    <script src="js/new-recipe.js"></script>
</body>
</html>