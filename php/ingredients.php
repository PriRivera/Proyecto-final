<?php

    namespace Medoo;
    require 'Medoo.php';

    $database = new Medoo([
        // required
        'database_type' => 'mysql',
        'database_name' => 'secret_du_chef',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);

    $ingredients = $database->select("tb_ingredients", "*");
    $len = count($ingredients);

?>
