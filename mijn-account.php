<?php
session_start();
require_once "includes/db.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$stmt2 = $pdo->prepare("SELECT * FROM boekingen WHERE user_id = ?");
$stmt2->execute([$user_id]);
$boekingen = $stmt2->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn Account</title>
</head>
<body>
    <h1>Welkom, <?= htmlspecialchars($user["email"]) ?></h1>
    <h2>Mijn Boekingen</h2>
    <ul>
    <?php foreach ($boekingen as $b): ?>
        <li><?= htmlspecialchars($b["reis_naam"]) ?> – <?= htmlspecialchars($b["datum"]) ?></li>
    <?php endforeach; ?>
    </ul>
    <a href="logout.php">Uitloggen</a>
</body>
</html>