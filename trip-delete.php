<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role']!=='admin') { header('HTTP/1.1 403'); exit; }
require 'includes/db.php';
$id = (int)($_GET['id'] ?? 0);
$del = $pdo->prepare("DELETE FROM aanbiedingen WHERE id=?");
$del->execute([$id]);
header("Location: trip-list.php");
exit;
