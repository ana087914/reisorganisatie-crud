<?php
include 'includes/header.php';
include 'includes/db.php';

/* ===== 1. NU există ?id=  →  arătăm doar Privacy & Voorwaarden  ===== */
if (!isset($_GET['id'])) {
    ?>
    <section id="privacy" class="privacy-section">
        <h2>Privacyverklaring</h2>
        <p>
            Family Travel respecteert de privacy van alle bezoekers en gebruikers van deze website.
            De persoonsgegevens die wij verwerken (bijv. naam, e-mailadres, contact- en
            boekingsgegevens) worden uitsluitend gebruikt voor het afhandelen van reserveringen,
            klantenservice en het verbeteren van onze diensten. Wij verkopen of verstrekken jouw
            gegevens nooit aan derden zonder jouw uitdrukkelijke toestemming, tenzij wij daartoe
            wettelijk verplicht zijn.
        </p>
        <p>
            In overeenstemming met de Algemene Verordening Gegevensbescherming (AVG) heb je het
            recht om jouw gegevens in te zien, te corrigeren of te laten verwijderen. Stuur hiervoor
            een verzoek naar <a href="mailto:privacy@familytravel.nl">privacy@familytravel.nl</a>.
            Wij reageren binnen 30 dagen op elk verzoek.
        </p>

        <h2>Algemene Voorwaarden</h2>
        <p>
            Door een boeking te plaatsen op deze website ga je een overeenkomst aan met
            Family Travel B.V. Alle gepubliceerde prijzen zijn inclusief verplichte belastingen en
            toeslagen, tenzij anders vermeld (bijvoorbeeld lokale toeristenbelasting ter plaatse).
            Annuleringen of wijzigingen zijn mogelijk volgens de annuleringsvoorwaarden die per
            reisaanbieding worden vermeld.
        </p>
        <p>
            Geschillen worden bij voorkeur in onderling overleg opgelost. Wanneer dit niet lukt, is
            het Nederlands recht van toepassing en is de rechtbank Amsterdam exclusief bevoegd.
            Family Travel behoudt zich het recht voor deze voorwaarden periodiek te wijzigen; raadpleeg
            ze daarom bij elke boeking.
        </p>
    </section>
    <?php
    include 'includes/footer.php';
    exit;          // terminăm aici; nu mai continuăm cu logica de detalii
}

/* ===== 2. EXISTĂ ?id=  →  continuăm cu detaliile călătoriei ===== */
if (!is_numeric($_GET['id'])) {
    echo "<p>Ongeldige reis-ID.</p>";
    include 'includes/footer.php';
    exit;
}

$id = $_GET['id'];

/* ----- preluăm informațiile din DB exact ca înainte ----- */
$stmt = $pdo->prepare("SELECT * FROM aanbiedingen WHERE id = ?");
$stmt->execute([$id]);
$reis = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reis) {
    echo "<p>Reis niet gevonden.</p>";
    include 'includes/footer.php';
    exit;
}

/* recenzii + adăugare recenzie (cod neschimbat) */
$reviews_stmt = $pdo->prepare("SELECT * FROM reviews WHERE reis_id = ? ORDER BY datum DESC");
$reviews_stmt->execute([$id]);
$reviews = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['naam'], $_POST['review'])) {
    $naam   = htmlspecialchars($_POST['naam']);
    $review = htmlspecialchars($_POST['review']);
    $insert_stmt = $pdo->prepare(
        "INSERT INTO reviews (reis_id, naam, tekst, datum) VALUES (?, ?, ?, NOW())"
    );
    $insert_stmt->execute([$id, $naam, $review]);
    header("Location: detail.php?id=" . $id);   // evităm re-POST
    exit;
}
?>

<!-- ===== Detalii călătorie ===== -->
<div class="detail-container">
    <div class="detail-left">
        <img src="images/<?= htmlspecialchars($reis['afbeelding']) ?>" alt="<?= htmlspecialchars($reis['titel']) ?>">
        <h1><?= htmlspecialchars($reis['titel']) ?></h1>
        <p><strong>Beschrijving:</strong> <?= htmlspecialchars($reis['beschrijving']) ?></p>
        <p><strong>Locatie:</strong> <?= htmlspecialchars($reis['locatie']) ?></p>
        <p><strong>Vertrek vanaf:</strong> <?= htmlspecialchars($reis['vertrek_luchthaven']) ?></p>
        <p><strong>Datum:</strong> <?= $reis['datum_start'] ?> – <?= $reis['datum_eind'] ?> (<?= $reis['nachten'] ?> nachten)</p>
        <p><strong>Prijs:</strong> €<?= number_format($reis['prijs'], 0) ?> per persoon</p>
        <p><strong>Afstand tot centrum:</strong> <?= $reis['afstand_stadcentrum'] ?></p>
        <p><strong>Maaltijd:</strong> <?= $reis['maaltijd'] ?></p>
        <p><strong>Beoordeling:</strong> <?= $reis['beoordeling_score'] ?>★ – <?= $reis['beoordeling_text'] ?>
           (<?= $reis['beoordeling_aantal'] ?> beoordelingen)</p>
    </div>

    <div class="detail-right">
        <h2>Recensies</h2>
        <?php if ($reviews): ?>
            <?php foreach ($reviews as $r): ?>
                <div class="review">
                    <strong><?= htmlspecialchars($r['naam']) ?></strong> op <?= date("d-m-Y", strtotime($r['datum'])) ?>
                    <p><?= htmlspecialchars($r['tekst']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Er zijn nog geen recensies voor deze reis.</p>
        <?php endif; ?>

        <h3>Schrijf een recensie</h3>
        <form method="post" class="review-form">
            <input type="text" name="naam" placeholder="Jouw naam" required>
            <textarea name="review" placeholder="Jouw ervaring..." rows="4" required></textarea>
            <button type="submit">Verzenden</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
