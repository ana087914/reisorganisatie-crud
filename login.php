<?php
session_start();
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_email"] = $user["email"];
          $_SESSION["role"]      = $user["role"];
        header("Location: mijn-account.php");
        exit;
    } else {
        $error = "Ongeldig e-mailadres of wachtwoord.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<?php include 'includes/header.php'; ?>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="login-container">
        <h2>Log in met</h2>
        <div class="social-login">
            <button class="social-btn facebook">Facebook</button>
            <button class="social-btn google">Google</button>
        </div>
        <div class="divider">of</div>
        <form method="post">
            <input type="email" name="email" placeholder="Voer een e-mailadres in" required>
            <input type="password" name="password" placeholder="Voer een wachtwoord in" required>
            <button type="submit">Aanmelden</button>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
        <p><a href="forgot.php">Wachtwoord vergeten?</a></p>

    </div>
</body>
</html>