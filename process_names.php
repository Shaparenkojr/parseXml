<?php
// process_names.php

function saveNamesToDB($names, $codes) {
    // Получаем соединение с БД
    $pdo = getDBConnection();

    $sql = "INSERT INTO products (name, code) VALUES (:name, :code)";
    $stmt = $pdo->prepare($sql);

    // Проходим по всем именам и кодам и вставляем их в базу данных
    foreach ($names as $index => $name) {
        if (isset($codes[$index])) {
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':code', $codes[$index]);
            $stmt->execute();
        }
    }
}

?>
