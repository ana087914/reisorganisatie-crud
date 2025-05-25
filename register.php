<?php
require 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $naam = $_POST['naam'];
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (email, naam, password) VALUES (?, ?, ?)");
    $stmt->execute([$email, $naam, $wachtwoord]);

    header("Location: login.php");
    exit;
}
?>
<form method="POST" class="login-container">
  <h2>Account aanmaken</h2>
  <input type="text" name="naam" placeholder="Naam" required>
  <input type="email" name="email" placeholder="E-mail" required>
  <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
  <button type="submit">Registreren</button>
</form>