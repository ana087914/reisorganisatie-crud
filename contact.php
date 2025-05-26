
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/main.css">
<div class="contact-header">
  <h1>Op zoek naar hulp?</h1>
  <p>Beheer uw boeking en bekijk de antwoorden op de meest gestelde vragen</p>
</div>

<div class="contact-boxes">
  <div class="contact-section">
    <input type="text" placeholder="Boekingsnummer of e-mail">
    <button class="contact-btn">Zoeken</button>
  </div>

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
    <button class="contact-btn">Inloggen</button>
  </div>
</div>

<div class="current-info">
  <h2>Huidige informatie</h2>
  <div class="info-box"></div>
  <div class="info-box"></div>
  <div class="info-box"></div>
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

<?php include 'includes/footer.php'; ?>
