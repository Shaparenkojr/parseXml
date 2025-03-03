<?php
$host = 'localhost'; 
$dbname = 'your_database'; 
$username = 'your_username'; 
$password = 'your_password'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

$xml = simplexml_load_file('your_file.xml');

$names = [];

foreach ($xml->children() as $item) {
    $name = (string)$item->Наименование;
    
    if (!in_array($name, $names)) {
        $names[] = $name;
        
        $stmt = $pdo->prepare("INSERT INTO products (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
?>
