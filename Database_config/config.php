<?php 
    

    $host = 'localhost:3306';
    $username = 'shop';
    $password = 'shop@#1';
    $dbname = 'shopDatabase';
    $salt = "213@345dsf";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

?>