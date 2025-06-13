<?php
/****************************
 * forgot.php
 * Formulier om reset-link aan te vragen
 ****************************/
session_start();
require 'includes/db.php';

$melding = '';

/* Zodra formulier is verstuurd */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {

    $email = trim($_POST['email']);

    // 1. Zoek gebruiker
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $gebruiker = $stmt->fetch();

    // 2. Alleen als e-mail bestaat maken we token (anders stille succesmelding)
    if ($gebruiker) {
        $token  = bin2hex(random_bytes(32));          // 64 tekens
        $einde  = (new DateTime('+1 hour'))->format('Y-m-d H:i:s');

        // 3. Opslaan in reset_tokens
        $ins = $pdo->prepare(
            "INSERT INTO reset_tokens (user_id, token, expires_at)
             VALUES (?,?,?)"
        );
        $ins->execute([$gebruiker['id'], $token, $einde]);

        // 4. Bouw reset-link
        $link = sprintf(
            "%s://%s/reset.php?token=%s",
            isset($_SERVER['HTTPS']) ? 'https' : 'http',
            $_SERVER['HTTP_HOST'],
            $token
        );

        /* 5. E-mail versturen
           Gebruik hier bij voorkeur PHPMailer; voor demo doen we mail()
           Let op: in veel dev-omgevingen komt mail() niet echt aan.
        */
        $onderwerp = 'Wachtwoord resetten - Family Travel';
        $bericht   = "Klik op onderstaande link om een nieuw wachtwoord in te stellen:\n\n" . $link .
                     "\n\nDe link verloopt over één uur.";
        @mail($email, $onderwerp, $bericht);

        // Altijd succesmelding tonen – ook als e-mail niet bestond
    }
    $melding = 'Als dit e-mailadres bekend is, hebben we een resetlink verzonden.';
}

include 'includes/header.php'; ?>
<div class="login-container">
  <h2>Wachtwoord vergeten</h2>

  <?php if ($melding): ?>
      <p><?= $melding ?></p>
  <?php else: ?>
      <form method="post">
        <input type="email" name="email" placeholder="Vul je e-mail in" required>
        <button type="submit">Stuur resetlink</button>
      </form>
  <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
