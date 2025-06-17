<?php
/* ───────────── Config & session ───────────── */
session_start();
require_once 'includes/db.php';


if (isset($_SESSION['user_id'])) {
    header('Location: mijn-account.php');
    exit;
}

$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    $email        = filter_var($_POST['email']            ?? '', FILTER_VALIDATE_EMAIL);
    $password     = $_POST['password']                    ?? '';
    $passwordConf = $_POST['password_confirm']            ?? '';

    if (!$email)                       $errors[] = 'Vul een geldig e-mailadres in.';
    if (strlen($password) < 6)         $errors[] = 'Wachtwoord moet ≥ 6 tekens zijn.';
    if ($password !== $passwordConf)   $errors[] = 'Wachtwoorden komen niet overeen.';

    
    if (!$errors) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) $errors[] = 'E-mailadres is al geregistreerd.';
    }

    
    if (!$errors) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $ins  = $pdo->prepare(
            'INSERT INTO users (email, password, role)
             VALUES (?, ?, "user")'
        );
        $ins->execute([$email, $hash]);

       
        $_SESSION['user_id']    = $pdo->lastInsertId();
        $_SESSION['user_email'] = $email;
        $_SESSION['role']       = 'user';

        header('Location: mijn-account.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <?php include 'includes/header.php'; ?>
    <meta charset="UTF-8">
    <title>Registreren</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<div class="login-container" style="max-width:480px">
    <h2>Account aanmaken</h2>

   
    <?php if ($errors): ?>
        <ul class="error" style="color:#e44;text-align:left;">
            <?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
        </ul>
    <?php endif; ?>

    <form method="post" data-validate>
        <input type="email"    name="email"            placeholder="E-mail" required>
        <input type="password" name="password"         placeholder="Wachtwoord (≥ 6 tekens)" minlength="6" required>
        <input type="password" name="password_confirm" placeholder="Herhaal wachtwoord"      required>
        <button type="submit">Registreren</button>
    </form>

    <p style="margin-top:15px">
        Heb je al een account?
        <a href="login.php">Log hier in</a>
    </p>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
