<?php
$host = 'db';               // ← numele corect din docker-compose.yml
$db   = 'mydatabase';
$user = 'user';             // ← așa cum ai setat în MYSQL_USER
$pass = 'password';         // ← așa cum ai setat în MYSQL_PASSWORD
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
    exit;
}
?>
