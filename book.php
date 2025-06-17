<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$reis_id = isset($_POST['reis_id']) ? (int)$_POST['reis_id'] : 0;
$persons = isset($_POST['persons']) ? (int)$_POST['persons'] : 1;
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT prijs FROM aanbiedingen WHERE id = ?");
$stmt->execute([$reis_id]);
$price_pp = $stmt->fetchColumn();

if (!$price_pp) {
    exit("Reis niet gevonden.");
}

$total = $price_pp * $persons;

$ins = $pdo->prepare(
  "INSERT INTO boekingen (user_id, trip_id, persons, total_price, status, booked_at)
   VALUES (?,?,?,?, 'new', NOW())"
);
$ins->execute([$user_id, $reis_id, $persons, $total]);

header("Location: mijn-account.php?msg=booked");
exit;
?>
