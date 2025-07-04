<?php
/* -------------------------------------------------
   contact.php
-------------------------------------------------- */
session_start();
require 'includes/db.php';


$okMsg  = '';
$errMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        $errMsg = 'Vul alle velden in.';                
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errMsg = 'E-mailadres is ongeldig.';          
    } else {
        /* tabel: contact_messages ( id | name | email | message | created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ) */
        $stmt = $pdo->prepare(
            "INSERT INTO contact_messages (name,email,message) VALUES (?,?,?)"
        );
        $stmt->execute([$name, $email, $message]);
        $okMsg = 'Bedankt voor uw bericht! Wij nemen spoedig contact op.';
    }
}
?>
<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="css/main.css">


<div class="contact-header">
  <h1>Op zoek naar hulp?</h1>
  <p>Beheer uw boeking en bekijk de antwoorden op de meest gestelde vragen</p>
</div>

<!-- ======================================================
     BOX 1 – Zoeken (→ mijn-account.php)
====================================================== -->
<div class="contact-section">
  <input type="text" placeholder="Boekingsnummer of e-mail">
  <a href="mijn-account.php" class="contact-btn">Zoeken</a>
</div>

<!-- ======================================================
     BOX 2 – Info + Inloggen (→ register.php)
====================================================== -->
<div class="contact-info">
  <h3>Beheer uw boeking</h3>
  <p>
    Met Uw account kunt u eenvoudig:<br>
    uw boekingsstatus controleren,<br>
    een wijziging aanvragen in de datum van uw reis,<br>
    ontdekken hoe u online kunt inchecken,<br>
    bagage en instappen met prioriteit toevoegen,<br>
    meer te weten komen over de huidige veiligheidsregels,<br>
    een visum of ESTA aanschaffen,<br>
    en meer.
  </p>

  <a href="register.php" class="contact-btn">Inloggen</a>
</div>

<!-- ======================================================
     FAQ / actuele info
====================================================== -->
<div class="current-info">
  <h2>Huidige informatie</h2>

  <div class="info-box">
    <p>Waarom wordt mijn betaling van de boeking bij sommige luchtvaartmaatschappijen opgesplitst in twee afschrijvingen?</p>
    <h3>De vervoerder vereist dat de betaling van de boeking in twee afzonderlijke betalingen moet worden opgesplitst. In de eerste stap betaalt u voor het ticket. In de tweede stap worden de servicekosten en andere diensten (bijvoorbeeld een aangeschafte verzekering) in rekening gebracht. U kunt toegang krijgen tot elke stap wanneer u uw betaalmethode selecteert.</h3>
  </div>

  <div class="info-box">
    <p>Wat moet ik doen als mijn vlucht is geannuleerd?</p>
    <h3>Als uw vlucht is geannuleerd, ontvangt u een melding van de luchtvaartmaatschappij. U kunt dan een alternatieve vlucht boeken of een terugbetaling aanvragen.</h3>
  </div>

  <div class="info-box">
    <p>Hoe kan ik mijn bagage registreren voor mijn vlucht?</p>
    <h3>U kunt uw bagage registreren tijdens het inchecken op de luchthaven of via de website van de luchtvaartmaatschappij.</h3>
  </div>
</div>


<div class="contact-form-section">
  <h2>Contactformulier</h2>
  <p>Selecteer het relevante onderwerp en geef de benodigde informatie op.</p>

  <form>
    <label>Hoe kunnen wij u helpen?</label>
    <div class="dropdowns">
      <select><option>Onderwerp</option></select>
      <select><option>Details</option></select>
    </div>
  </form>
</div>


<section class="contact-section">
  <h2>Neem contact met ons op</h2>
  <p class="subheading">Heeft u overige vragen of wilt u meer informatie?</p>
  <p>Neem gerust contact met ons op via het onderstaande formulier of bel ons op +31 20 123 4567.</p>

  <!-- feedback -->
  <?php if ($okMsg): ?>
      <p style="color:green;font-weight:bold;"><?= htmlspecialchars($okMsg) ?></p>
  <?php elseif ($errMsg): ?>
      <p style="color:red;font-weight:bold;"><?= htmlspecialchars($errMsg) ?></p>
  <?php endif; ?>

  <form action="contact.php" method="post">
    <label for="name">Naam:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Bericht:</label>
    <textarea id="message" name="message" rows="4" required></textarea>

    <button type="submit">Verstuur</button>
  </form>
</section>

<?php include 'includes/footer.php'; ?>
