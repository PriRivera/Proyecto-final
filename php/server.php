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
    $currentID;
    if ($_POST) {
        if (isset($_POST['recipeName'])&&isset($_POST['recipeDescription'])&&isset($_POST['recipeInstructions'])&&isset($_POST['ingredients'])) {
            /*$img = '';
            if(!empty($_FILES['image'])){
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
                }
            }*/
            $database->insert("tb_recipes", [
                "recipe_name"=> $_POST["recipeName"],
                "recipe_description"=> $_POST["recipeDescription"],
                "recipe_instructions"=> $_POST["recipeInstructions"],
                "recipe_image"=> "Ajax me dueles"//"recipe_image"=> $img
            ]);
            $currentID = $database->id();
            if (!empty($_POST['ingredients'])) {
                foreach ($_POST['ingredients'] as $ingredient) {
                    $database->insert("tb_ingredients", [
                        "id_recipe"=> $currentID,
                        "ingredient_name"=> $ingredient[0],
                        "ingredient_amount"=> $ingredient[1],
                        "ingredient_measure"=> $ingredient[2],
                    ]);
                }
            }
        }
    }

?>

