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
    if($_POST){
        if(isset($_POST["id_recipe"])&&isset($_POST["recipe_status"])){
            $database->update("tb_recipes",[
                "recipe_status"=> $_POST["recipe_status"]
            ], [
                "id_recipe"=> $_POST["id_recipe"]
            ]);
        }
        if(isset($_POST['id_recipe'])&&isset($_POST['id_user'])&&isset($_POST['like'])){
            $database->insert("tb_recipe_votes",[
                "id_recipe"=> $_POST["id_recipe"],
                "id_user"=> $_POST["id_user"]
            ]);
        }
        if(isset($_POST['id_recipe'])&&isset($_POST['id_user'])&&isset($_POST['dislike'])){
            $database->delete("tb_recipe_votes",[
                "id_recipe"=> $_POST["id_recipe"],
                "id_user"=> $_POST["id_user"]
            ]);
        }
    }
?>