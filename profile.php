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
    session_start();
    if(isset($_SESSION["isLoggedIn"])){
        if($_SESSION["usrtype"]==1){
            header("location:administrador.php");
        }
        $user = $database->select("tb_users", "*",[
            "id_user"=> $_SESSION["usrid"]
        ]);
        $profile = $database->select("tb_profile", "*",[
            "id_user"=> $_SESSION["usrid"]
        ]);
        $recipes = $database->select("tb_recipes", "*",[
            "recipe_user_id"=> $_SESSION["usrid"]
        ]);
        $votes = $database->select("tb_recipe_votes", "*",[
            "id_user"=> $_SESSION["usrid"]
        ]);   
        $votedRecipes = [];
        foreach ($votes as $value) {
            $counter = 0;
            $data =  $database->select("tb_recipes", "*", ["id_recipe"=>$value["id_recipe"]]);
            $data[0] = array_merge($data[0], $database->select("tb_users", "username", ["id_user"=>$data[0]["recipe_user_id"]]));
            array_push($votedRecipes, $data[0]);
        }
    }else{
        header("location:login.php");
    }

    if($_POST){
        if(isset($_POST["logout"])){
            session_destroy();
            header("location:login.php");
        }
        if(isset($_FILES['image'])){
            if(!empty($_FILES['image']['name'])){
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
                    $img = "profile_img-".generateRandomString().".".pathinfo($file_name, PATHINFO_EXTENSION);
                    move_uploaded_file($file_tmp, "imgs/".$img);
                    $database->update("tb_profile",[
                        "profile_img"=> $img
                    ], [
                        "id_user"=> $_SESSION["usrid"]
                    ]);
                }
            }
            if(!empty($_POST["description"])){
                $database->update("tb_profile",[
                    "description"=> $_POST["description"]
                ], [
                    "id_user"=> $_SESSION["usrid"]
                ]);
            }            
            header("location:login.php");
        }
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
                    <?php
                        if (isset($_SESSION["isLoggedIn"])) {
                            echo"
                                <a href='profile.php' class='burger-menu__link'><li class='burger-menu__li'>Profile</li></a>
                                <a href='submit.php' class='burger-menu__link'><li class='burger-menu__li'>New recipe</li></a>
                                <form action='profile.php' method='POST'>
                                    <input type='submit' id='sublogout' name='logout' value='true' style='display:none;'>
                                    <label for='sublogout' id='logout' class='burger-menu__link'>Log out
                                </form>
                            ";
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
        <div class="profile-edit"> 
            <form class="" action="profile.php" method="post" enctype="multipart/form-data">
                <div class="img-block border profile-block" style = "margin-bottom: 0em; width:17%">
                    <a><img id="preview" class = "img-block" src="imgs/<?php echo  $profile[0]["profile_img"] ?>" alt="image to upload" style="width:75%"/><br>
                    <p class="p-drop">Drop an image here or</p>
                    <input type="file" id="file" name="image" class="file-chooser" onchange="readURL(this)"/>
                    <label for=file class="choose_size main-btn" id="img"> Choose a file..</label>
                </div>
                <div class="main-profile_div">
                    <p class="main-name"><?PHP echo $user[0]["username"] ?></p>
                    <label class="form-text account-description">Account Description:</label><br>
                    <textarea id="desc" class="form-login_imput account-description--textarea" name="description"><?PHP echo $profile[0]["description"]?></textarea>
                </div>
                <div class="profile-btn">
                    <input type="submit" value="Accept" class="main-btn save-btn" id="accept">
                </div>
            </form>
        </div>
        <div class="profile_non_edit"> 
            <div class="img-block border profile-block">
                <a><img id="preview" class = "img-block_profile" src="imgs/<?php echo  $profile[0]["profile_img"] ?>" alt="profile image"/>
            </div>
            <div class="main-profile_div">
                <p class="main-name"><?PHP echo $user[0]["username"] ?></p>
                <label class="form-text account-description">Account Description:</label><br>
                <textarea id="description" class="form-login_imput account-description--textarea" disabled><?PHP echo $profile[0]["description"]?></textarea>
            </div>
            <div class="profile-btn">
                <button class="main-btn save-btn" id="edit">Edit</button>
            </div>
        </div>
    </header>
    <section>
        <div class="my_recipes">
            <h1 class="main-h1__profile">My Recipes</h1>
            <img class="spatulas-img" src="img/paletas.svg" alt="spoon and spatula">
        </div>
        <ul class="search-content search-content-profile">  
            <?php
                foreach($recipes as $value){
                    echo "
                    <li class='search-content_item'><a class='search-content_link' href='edit-recipe.php?id=".$value['id_recipe']."'>
                        <div class='text-img__background'";
                    if($value['recipe_status']=='0'){
                        echo "style='background-color:red;'";
                    }
                    echo ">
                            <p class='search-content_link inside-text' href='edit-recipe.php?id=".$value["id_recipe"]."'>";
                    if($value['recipe_status']=='0'){
                        echo "Rcp rejected";
                    }else{
                        echo "Click to edit";
                    }
                    echo "</p> 
                        </div>
                        <div class='search_content_container'><img class='profile-content-img pruebaImagen' src= imgs/".$value["recipe_image"]." alt=''></div>   
                        <br>                     
                        <p class='recipe-menu_description profile-img__names'>".$value["recipe_name"]."</p> 
                    </a></li>";
                }
            ?>
            <li class="search-content_item">
                <a class="search-content_link" href="submit.php"> 
                    <p class="search-content_img img-block border profile-item plus fa fa-plus style" style="font-size:100px"></p>
                    <a class="recipe-menu_description profile-img__names" id="add-id" >Add a new recipe</a>
                </a>
            </li>
        </ul>
    </section>
    <section>
        <i class="fa fa-heart main-heart"style="font-size:50px"></i>
            <h2 class="main-h2__profile">Favorite Recipes</h2>
            <ul class="search-content search-content-favorites">
                <?php
                if(!empty($votedRecipes)){
                    foreach ($votedRecipes as $value) {
                        echo "
                            <li class='search-content_item'><a class='search-content_link' href='recipe.php?id=".$value['id_recipe']."'>
                                <div class='search_content_container'><img class='search-content_img'  src='imgs/".$value['recipe_image']."' alt='''></div>
                                <p class='recipe-menu_description profile-img__names responsive-big_text'>".$value['recipe_name']."<br>By:".$value['0']."</p>
                            </a></li>
                            ";
                    }
                }
                ?>
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var item = document.getElementById('preview');
                    item.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        var toEdit = $('#edit');
            toEdit.click(function(){
            $('.profile-edit').css({"display":"block"}),
            $('.profile_non_edit').css({"display":"none"});
            });
    </script>
</body>
</html>