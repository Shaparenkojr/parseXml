<?php
// db.php

function getDBConnection() {
    $host = 'localhost'; 
    $dbname = 'iks'; 
    $username = 'root'; 
    $password = '123'; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //  вывод ошибок
        return $pdo; 
    } catch (PDOException $e) {
        die("Ошибка подключения: " . $e->getMessage());
    }
}

?>
