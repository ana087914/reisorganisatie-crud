
<?php
include 'includes/header.php';
include 'includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Ongeldige reis-ID.</p>";
    include 'includes/footer.php';
    exit;
}

$id = $_GET['id'];

// Preluare informații despre călătorie
$stmt = $pdo->prepare("SELECT * FROM aanbiedingen WHERE id = ?");
$stmt->execute([$id]);
$reis = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reis) {
    echo "<p>Reis niet gevonden.</p>";
    include 'includes/footer.php';
    exit;
}

// Recenzii
$reviews_stmt = $pdo->prepare("SELECT * FROM reviews WHERE reis_id = ? ORDER BY datum DESC");
$reviews_stmt->execute([$id]);
$reviews = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC);

// Adăugare recenzie nouă
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['naam'], $_POST['review'])) {
    $naam = htmlspecialchars($_POST['naam']);
    $review = htmlspecialchars($_POST['review']);
    $insert_stmt = $pdo->prepare("INSERT INTO reviews (reis_id, naam, tekst, datum) VALUES (?, ?, ?, NOW())");
    $insert_stmt->execute([$id, $naam, $review]);
    header("Location: detail.php?id=" . $id); // redirect pentru a evita re-post
    exit;
}
?>

<div class="detail-container">
    <div class="detail-left">
        <img src="images/<?= htmlspecialchars($reis['afbeelding']) ?>" alt="<?= htmlspecialchars($reis['titel']) ?>">
        <h1><?= htmlspecialchars($reis['titel']) ?></h1>
        <p><strong>Beschrijving:</strong> <?= htmlspecialchars($reis['beschrijving']) ?></p>
        <p><strong>Locatie:</strong> <?= htmlspecialchars($reis['locatie']) ?></p>
        <p><strong>Vertrek vanaf:</strong> <?= htmlspecialchars($reis['vertrek_luchthaven']) ?></p>
        <p><strong>Datum:</strong> <?= $reis['datum_start'] ?> - <?= $reis['datum_eind'] ?> (<?= $reis['nachten'] ?> nachten)</p>
        <p><strong>Prijs:</strong> €<?= number_format($reis['prijs'], 0) ?> per persoon</p>
        <p><strong>Afstand tot centrum:</strong> <?= $reis['afstand_stadcentrum'] ?></p>
        <p><strong>Maaltijd:</strong> <?= $reis['maaltijd'] ?></p>
        <p><strong>Beoordeling:</strong> <?= $reis['beoordeling_score'] ?>★ - <?= $reis['beoordeling_text'] ?> (<?= $reis['beoordeling_aantal'] ?> beoordelingen)</p>
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
