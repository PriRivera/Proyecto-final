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


    $email= $_POST["email"];
    $username= $_POST["username"];
    $verifyUsr=$database->select("tb_users","*",[
        "username" => $username
    ]);
    $verifyEmail=$database->select("tb_users","*",[
        "email" => $email
    ]);
    $verify ="";
    
    if(!empty($verifyUsr)){
        $verify="usuarioReady";
        if(!empty($verifyEmail))
        {
            $verify="correoUsuarioReady";
        }
    }elseif(!empty($verifyEmail)){
        $verify="correoReady";
    }else{
      
      $verify="succesfull";
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT,['cost'=>12]);
        $database->insert("tb_users", [
            "username"=> $_POST["username"],
            "password"=> $pass,
            "email"=> $_POST["email"],
            "type"=>$_POST["type"]
        ]);
        $user_id = $database->id();
        session_start();
        $_SESSION["isLoggedIn"] = true;
        $_SESSION["usr"] =  $_POST["username"];
        $_SESSION["usrid"] = $user_id;
        $_SESSION["usrtype"] = $user_id;
    
        $database->insert("tb_profile", [
            "id_user"=> $user_id,
            "profile_img"=> $_POST["profileImg"],
            "description"=> $_POST["descrip"]
        ]);
    }
echo $verify;
?>