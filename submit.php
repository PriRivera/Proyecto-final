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
    
    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext_arr = explode('.',$_FILES['image']['name']);       
        $file_ext = end($file_ext_arr);      
        $img_ext = array("jpeg","jpg","png");      
        if(in_array($file_ext, $img_ext) === false){
            $errors[] = "choose a JPEG or PNG file.";
        }      
        if($file_size > 2097152){
            $errors[]='2 MB Max';
        }      
        if(empty($errors)){
            $img = "recipe-img-".generateRandomString().".".pathinfo($file_name, PATHINFO_EXTENSION);
            move_uploaded_file($file_tmp, "imgs/".$img);         
            if($_POST){
                $database->insert("tb_recipes", [
                    "recipe_name"=> $_POST["recipeName"],
                    "recipe_description"=> $_POST["recipeDescription"],
                    "recipe_instructions"=> $_POST["recipeInstructions"],
                    "recipe_image"=> $img
                ]);
                $last_recipe_id = $database->id();
                print_r($_POST['ingredients']);
                if(!empty($_POST['ingredients'])) {    
                    foreach($_POST['ingredients'] as $value){
                        $database->insert("tb_ingredients", [
                                "id_recipe" => $last_recipe_id,
                                "ingredient_name" => $value[0],
                                "ingredient_amount" => $value[1],
                                "ingredient_measure" => $value[2]
                        ]);
                    }
                }
            }
        }
    }else{
        //print_r($errors);
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
            <div class="main-nav__search-container">
                <input class="search-text" type="text" placeholder="Search.." name="search">
                <a class="main-nav__button" href="#"><i class="fa fa-search"></i></a>
            </div>
            <ul class="main-nav__list">
                <li class="main-nav__item"><a class="main-nav__link" href="index.php">Home</a></li>
                <li class="main-nav__item"><a class="main-nav__link" href="contact.php">Contact</a></li>
                <li class="main-nav__item"><a class="main-nav__link" href="login.php">Login</a></li>
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
    </header>

    <section>
        <img class="main-title" src="img/new-recipe.png" alt="New recipe title">
        <form class="recipe-form" action="submit.php" method="post" enctype="multipart/form-data">
            <div class="left-block">
                <div class="img-block border">
                    <img id="preview" class = "img-block" src="imgs/preview.png" alt="image to upload"/><br>
                    <p class="img-block__p">Drop an image here <br> or</p>
                    <input type="file" id="file" name="image" class="file-chooser" onchange="readURL(this)"/>
                    <label for=file class="main-btn main-btn--size"> Choose a file..</label>
                </div>
            </div>
            <div class="right-block" id="right-block">
                <h3><span>Name</span> for your recipe.</h3>
                <input class="form-text border right-block__input" type="text" name="recipeName" id="recipe-name" placeholder="Title" autofocus>
                <br><br><br>
                <h3><span>Description</span> to show.</h3>
                <textarea class="form-text text-area border right-block__input" name="recipeDescription" id="recipe-description" cols="30" rows="10" placeholder="Small and clear description."></textarea>
            </div>

            <div class="add-block">
                <br><br>
                <h3><span>Ingredients</span> to be used.</h3> <br>
                <ul id="ingredient-container" class="ingredient"></ul>
                <div id="ingredient" class="ingredient">
                    <div class="form-text generic-container border">
                        <input id="ingredient_name" class="input-base input-name" type="text" placeholder="Ingredient name">
                        <input id="quantity" class="input-base input-quantity" type="number" min="0" step="1" placeholder="0">
                        <input id="measure" class="input-base input-unit" list="medidas" placeholder="Measure">
                    </div>

                </div>
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
                <input id="add-ingredient-btn" class="main-btn btn-submit" type="button" value="Add ingredient">
                <br><br>
                <h3><span>Preparation</span> instructions.</h3>
                <textarea class="form-steps text-area border" name="recipeInstructions" id="recipe-instructions" cols="30" rows="10" placeholder="Step by step description of the preparation."></textarea>
                <input type="submit" id="submit-recipe" class="main-btn btn-submit" value="Save & publish">
            </div>
        </form>
    </section>
    <script src="js/new-recipe.js">
    </script>

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