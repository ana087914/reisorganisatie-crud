<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id   = $_SESSION['user_id'];
$bookingId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$bookingId) {
    header('Location: mijn-account.php');
    exit;
}

$stmt = $pdo->prepare(
    "SELECT id, status
       FROM boekingen
      WHERE id = ? AND user_id = ?"
);
$stmt->execute([$bookingId, $user_id]);
$booking = $stmt->fetch();

if (!$booking || $booking['status'] === 'cancelled') {
    header('Location: mijn-account.php');
    exit;
}

$pdo->prepare("UPDATE boekingen SET status = 'cancelled' WHERE id = ?")
    ->execute([$bookingId]);


$_SESSION['flash'] = "Boeking #{$bookingId} is geannuleerd.";
header('Location: mijn-account.php');
exit;
