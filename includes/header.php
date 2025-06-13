<?php
// ─── PORNEȘTE SESIUNEA DACĂ NU EXISTĂ ─────────────────────────
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Family Travel</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="logo">
        <img src="images/icon.png" alt="Logo" width="40">
        <span class="logo-text">Family Travel</span>
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">Over ons</a></li>
            <li><a href="reizen.php">Reizen</a></li>
            <li><a href="detail.php">Reis detailpagina</a></li>
            <li><a href="contact.php">Contact</a></li>

            <!-- Link ADMIN dacă ești logat ca admin -->
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="admin.php">Admin</a></li>
            <?php endif; ?>

            <!-- Login / Logout / Mijn account -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="mijn-account.php">Mijn account</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
