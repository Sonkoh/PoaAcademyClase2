<?php
    $server = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "prueba1";



    try{
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch (PDOException $e){
        die('La conexion fallo Error: '.$e->getMessage());
    } 

?>