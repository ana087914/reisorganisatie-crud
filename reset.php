<?php
/****************************
 * reset.php
 * Valideert token en slaat nieuw wachtwoord op
 ****************************/
session_start();
require 'includes/db.php';

$token = $_GET['token'] ?? '';
$melding = '';

/* Stap 1: token controleren */
$stmt = $pdo->prepare(
  "SELECT rt.user_id, u.email, rt.expires_at
   FROM reset_tokens rt
   JOIN users u ON u.id = rt.user_id
   WHERE rt.token = ?"
);
$stmt->execute([$token]);
$record = $stmt->fetch();

if (!$record || new DateTime() > new DateTime($record['expires_at'])) {
    exit('Ongeldige of verlopen token.');
}

/* Stap 2: formulier verstuurd -> wachtwoord updaten */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['wachtwoord'])) {

    $hash = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);

    $upd = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $upd->execute([$hash, $record['user_id']]);

    // Token opschonen
    $del = $pdo->prepare("DELETE FROM reset_tokens WHERE user_id = ?");
    $del->execute([$record['user_id']]);

    $melding = 'Je wachtwoord is gewijzigd. Je kunt nu inloggen.';
}

include 'includes/header.php'; ?>
<div class="login-container">
  <h2>Nieuw wachtwoord instellen</h2>

  <?php if ($melding): ?>
      <p><?= $melding ?></p>
      <a href="login.php">Naar login</a>
  <?php else: ?>
      <form method="post">
        <input type="password" name="wachtwoord" placeholder="Nieuw wachtwoord" required>
        <button type="submit">Opslaan</button>
      </form>
  <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
