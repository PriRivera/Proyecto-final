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
                    $database->update("tb_recipes",[
                        "recipe_image"=> $img
                    ], [
                        "id_recipe"=> $_POST["id_recipe"]
                    ]);
                }
            }         
            $database->update("tb_recipes", [
                "recipe_name"=> $_POST["recipeName"],
                "recipe_description"=> $_POST["recipeDescription"],
                "recipe_instructions"=> $_POST["recipeInstructions"],
                "recipe_status" => NULL
            ],[
                "id_recipe"=> $_POST["id_recipe"]
            ]);
            if(!empty($_POST['ingredients'])) {    
                $database->delete("tb_ingredients", "*", ["id_recipe"=> $_POST["id_recipe"]]);
                foreach($_POST['ingredients'] as $value){
                    $database->insert("tb_ingredients", [
                            "id_recipe" => $_POST["id_recipe"],
                            "ingredient_name" => $value[0],
                            "ingredient_amount" => $value[1],
                            "ingredient_measure" => $value[2]
                    ]);
                }
            }
            if(!empty($_POST['categories'])) {    
                $database->delete("tb_recipe_in_categories", "*", ["id_recipe"=> $_POST["id_recipe"]]);
                foreach($_POST['categories'] as $value){
                    $database->insert("tb_recipe_in_categories", [
                            "id_recipe" => $_POST["id_recipe"],
                            "id_category" => $value
                    ]);
                }
            }
            header('location:recipe.php?id='.$_POST["id_recipe"]);
        }
    }
?>