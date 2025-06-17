<?php
/***** detail.php ******/
include 'includes/header.php';
include 'includes/db.php';

/* === 0. PRIVACY & VOORWAARDEN fără id === */
if (!isset($_GET['id'])) { ?>
   <section id="privacy" class="privacy-section">

  <!-- ==================================
       PRIVACYVERKLARING
  =================================== -->
  <h2>Privacyverklaring</h2>

  <p>
    Bij <strong>Family Travel</strong> staat zorgvuldige omgang met jouw persoonsgegevens centraal. 
    We verwerken uitsluitend gegevens die nodig zijn voor een optimale dienstverlening 
    en gaan daar vertrouwelijk mee om, conform de Algemene Verordening Gegevensbescherming (AVG).
  </p>

  <h3>Welke gegevens verzamelen wij?</h3>
  <ul>
    <li><strong>Contactgegevens</strong> – naam, adres, e-mail en telefoonnummer wanneer je een boeking maakt of ons contactformulier invult.</li>
    <li><strong>Boekingsdetails</strong> – gekozen reis, data, medereizigers, voorkeuren (bijv. dieetwensen).</li>
    <li><strong>Betaalinformatie</strong> – uitsluitend voor het afronden van de transactie; deze wordt nooit door ons opgeslagen.</li>
    <li><strong>Website- en cookie-gegevens</strong> – anonieme statistieken om onze site te verbeteren en marketing af te stemmen.</li>
  </ul>

  <h3>Waarom verzamelen wij jouw gegevens?</h3>
  <ol>
    <li>Om je boeking te bevestigen, uit te voeren en op de hoogte te houden.</li>
    <li>Voor klantenservice: snelle beantwoording van vragen of verzoeken.</li>
    <li>Voor wettelijke verplichtingen, zoals administratie- en belastingdoeleinden.</li>
    <li>Met jouw toestemming: om je sporadisch inspirerende reisaanbiedingen toe te sturen.</li>
  </ol>

  <h3>Hoe lang bewaren wij jouw data?</h3>
  <p>
    We bewaren je gegevens niet langer dan strikt noodzakelijk. 
    Boekingsdossiers worden <em>maximaal zeven jaar</em> bewaard in overeenstemming met de Belastingdienst. 
    Nieuwsbrief­gegevens kun je altijd direct zelf verwijderen via de afmeldlink.
  </p>

  <h3>Delen met derden</h3>
  <p>
    Family Travel verkoopt jouw data nooit. 
    Gegevens worden uitsluitend gedeeld met betrouwbare partners 
    (luchtvaartmaatschappijen, accommodaties, verzekerings­maatschappijen) 
    voor zover dat nodig is om de geboekte reis uit te voeren.
  </p>

  <h3>Jouw rechten</h3>
  <p>
    Je hebt het recht op <strong>inzage, correctie, verwijdering</strong> en <strong>overdraagbaarheid</strong> van jouw persoonsgegevens. 
    Stuur ons een e-mail op <a href="mailto:privacy@familytravel.nl">privacy@familytravel.nl</a> en we reageren binnen 14 dagen.
  </p>


  <!-- ==================================
       ALGEMENE VOORWAARDEN
  =================================== -->
  <h2>Algemene Voorwaarden</h2>

  <p>
    Door een boeking te plaatsen bij Family Travel ga je akkoord met onderstaande voorwaarden. 
    We adviseren om deze zorgvuldig door te lezen; zo weet je precies wat je van ons kunt verwachten 
    en wat wij van jou verwachten.
  </p>

  <h3>1. Totstandkoming van de overeenkomst</h3>
  <p>
    De reisovereenkomst komt tot stand zodra je in het boekings­proces op “Bevestigen” klikt en je 
    per e-mail onze boekings­bevestiging ontvangt. 
    Eventuele fouten in de bevestiging dien je binnen 24 uur te melden.
  </p>

  <h3>2. Prijzen &amp; betalingen</h3>
  <ul>
    <li>Alle gepubliceerde prijzen zijn per persoon, tenzij anders vermeld.</li>
    <li>Een <strong>aanbetaling van 20 %</strong> dient binnen 7 dagen na boeking te worden voldaan.</li>
    <li>Het restantbedrag betaal je uiterlijk 6 weken voor vertrek.</li>
  </ul>

  <h3>3. Annulering door de reiziger</h3>
  <p>
    Kosteloos annuleren kan binnen 24 uur na boeking. Daarna gelden onderstaande kosten:
  </p>
  <table style="width:100%;border-collapse:collapse">
    <tr><th style="border-bottom:1px solid #ccc;text-align:left;padding:6px">Termijn voor vertrek</th>
        <th style="border-bottom:1px solid #ccc;text-align:left;padding:6px">Annuleringskosten</th></tr>
    <tr><td style="padding:6px">Tot 42 dagen</td> <td style="padding:6px">20 % van de reissom</td></tr>
    <tr><td style="padding:6px">41 – 21 dagen</td> <td style="padding:6px">50 % van de reissom</td></tr>
    <tr><td style="padding:6px">20 – 7 dagen</td>  <td style="padding:6px">75 % van de reissom</td></tr>
    <tr><td style="padding:6px">Binnen 7 dagen</td><td style="padding:6px">100 % van de reissom</td></tr>
  </table>

  <h3>4. Wijzigingen door Family Travel</h3>
  <p>
    In uitzonderlijke situaties kan het nodig zijn dat we het reisprogramma aanpassen (bijv. bij vluchtschema-wijzigingen). 
    We bieden altijd een gelijkwaardig of beter alternatief. 
    Indien de wijziging wezenlijk is, heb je het recht om kosteloos te annuleren.
  </p>

  <h3>5. Aansprakelijkheid</h3>
  <p>
    Family Travel is niet aansprakelijk voor <em>overmacht</em> zoals natuurrampen, stakingen of politieke onrust. 
    Onze totale aansprakelijkheid is in ieder geval beperkt tot de reissom van de betreffende reiziger.
  </p>

  <h3>6. Klachten</h3>
  <p>
    Heb je een klacht <em>tijdens</em> de reis, meld dit direct bij de lokale vertegenwoordiger zodat ter plekke een oplossing kan worden gezocht. 
    Wordt het niet naar tevredenheid opgelost, dien je uiterlijk 30 dagen na thuiskomst een schriftelijke klacht in. 
    We reageren binnen 14 dagen.
  </p>

  <h3>7. Toepasselijk recht</h3>
  <p>
    Op alle overeenkomsten is Nederlands recht van toepassing. Geschillen worden exclusief voorgelegd aan de bevoegde rechtbank te Amsterdam.
  </p>

</section>

<?php
    include 'includes/footer.php';
    exit;
}

if (!is_numeric($_GET['id'])) {
    echo "<p>Ongeldige reis-ID.</p>";
    include 'includes/footer.php';
    exit;
}
$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM aanbiedingen WHERE id = ?");
$stmt->execute([$id]);
$reis = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$reis) {
    echo "<p>Reis niet gevonden.</p>";
    include 'includes/footer.php';
    exit;
}

$reviews_stmt = $pdo->prepare(
  "SELECT * FROM reviews WHERE reis_id = ? ORDER BY datum DESC"
);
$reviews_stmt->execute([$id]);
$reviews = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['naam'], $_POST['review'])) {
    $naam   = htmlspecialchars($_POST['naam']);
    $review = htmlspecialchars($_POST['review']);
    $ins = $pdo->prepare(
      "INSERT INTO reviews (reis_id, naam, tekst, datum) VALUES (?, ?, ?, NOW())"
    );
    $ins->execute([$id, $naam, $review]);
    header("Location: detail.php?id=".$id);
    exit;
}
?>

<div class="detail-container">

  <div class="detail-left">
    <img src="images/<?= htmlspecialchars($reis['afbeelding']) ?>"
         alt="<?= htmlspecialchars($reis['titel']) ?>">
    <h1><?= htmlspecialchars($reis['titel']) ?></h1>

    <p><strong>Beschrijving:</strong> <?= htmlspecialchars($reis['beschrijving']) ?></p>
    <p><strong>Locatie:</strong> <?= htmlspecialchars($reis['locatie']) ?></p>
    <p><strong>Vertrek vanaf:</strong> <?= htmlspecialchars($reis['vertrek_luchthaven']) ?></p>
    <p><strong>Datum:</strong>
       <?= $reis['datum_start'] ?> – <?= $reis['datum_eind'] ?>
       (<?= $reis['nachten'] ?> nachten)
    </p>
    <p><strong>Prijs:</strong> €<?= number_format($reis['prijs'],0) ?> per persoon</p>
    <p><strong>Afstand tot centrum:</strong> <?= $reis['afstand_stadcentrum'] ?></p>
    <p><strong>Maaltijd:</strong> <?= $reis['maaltijd'] ?></p>
    <p><strong>Beoordeling:</strong>
       <?= $reis['beoordeling_score'] ?>★ – <?= $reis['beoordeling_text'] ?> 
       (<?= $reis['beoordeling_aantal'] ?> beoordelingen)
    </p>

    <form action="book.php" method="post" style="margin-top:25px;">
      <input type="hidden" name="reis_id" value="<?= $reis['id'] ?>">
      <label>Aantal personen:
        <input type="number" name="persons" value="2" min="1" max="10"
               style="width:60px;margin-left:6px;">
      </label>
      <button class="boek-knop" type="submit" style="margin-left:15px;">
        Boek nu
      </button>
    </form>
  </div>

  <div class="detail-right">
    <h2>Recensies</h2>
    <?php if ($reviews): foreach ($reviews as $r): ?>
      <div class="review">
        <strong><?= htmlspecialchars($r['naam']) ?></strong>
        op <?= date('d-m-Y', strtotime($r['datum'])) ?>
        <p><?= htmlspecialchars($r['tekst']) ?></p>
      </div>
    <?php endforeach; else: ?>
      <p>Er zijn nog geen recensies voor deze reis.</p>
    <?php endif; ?>

    <h3>Schrijf een recensie</h3>
    <form method="post" class="review-form">
      <input  type="text"   name="naam"   placeholder="Jouw naam" required>
      <textarea name="review" placeholder="Jouw ervaring…" rows="4" required></textarea>
      <button type="submit">Verzenden</button>
    </form>
  </div>

</div>

<?php include 'includes/footer.php'; ?>
