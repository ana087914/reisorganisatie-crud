
<?php
$to = $_GET['to'] ?? '';
$from = $_GET['from'] ?? '';
$date = $_GET['date'] ?? '';
$duration = $_GET['duration'] ?? '';
$people = $_GET['people'] ?? '';
?>
<?php
include 'includes/header.php';
include 'includes/db.php';

// Filtrare GET (opțional)
$conditions = [];
$params = [];

if (!empty($_GET['to'])) {
    $conditions[] = "titel LIKE :to";
    $params[':to'] = '%' . $_GET['to'] . '%';
}
if (!empty($_GET['from'])) {
    $conditions[] = "vertrek_luchthaven LIKE :from";
    $params[':from'] = '%' . $_GET['from'] . '%';
}
if (!empty($_GET['date'])) {
    $conditions[] = ":date BETWEEN datum_start AND datum_eind";
    $params[':date'] = $_GET['date'];
}
if (!empty($_GET['duration'])) {
    if ($_GET['duration'] == '3-4') {
        $conditions[] = "nachten BETWEEN 3 AND 4";
    } elseif ($_GET['duration'] == '5-7') {
        $conditions[] = "nachten BETWEEN 5 AND 7";
    } elseif ($_GET['duration'] == '8+') {
        $conditions[] = "nachten >= 8";
    }
}
if (!empty($_GET['people'])) {
    // momentan nu este relevant, doar exemplu
}

$where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
$sql = "SELECT * FROM aanbiedingen $where ORDER BY datum_start ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$reizen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="reizen-title">Vlucht+Hotel - kies uw reis</h1>

<div class="reizen-container">
<?php foreach ($reizen as $reis): ?>
    <div class="reis-card" onclick="window.location.href='detail.php?id=<?= $reis['id'] ?>'">
        <div class="reis-image">
            <img src="images/<?= htmlspecialchars($reis['afbeelding']) ?>" alt="<?= htmlspecialchars($reis['titel']) ?>">
        </div>
        <div class="reis-info">
            <h2><?= htmlspecialchars($reis['titel']) ?></h2>
            <p><?= htmlspecialchars($reis['locatie']) ?></p>
            <p><strong>Vertrek:</strong> <?= htmlspecialchars($reis['vertrek_luchthaven']) ?><br>
            Datum: <?= htmlspecialchars(date("j M Y", strtotime($reis['datum_start']))) ?> - <?= htmlspecialchars(date("j M Y", strtotime($reis['datum_eind']))) ?> (<?= $reis['nachten'] ?> nachten)</p>
            <p><?= htmlspecialchars($reis['afstand_stadcentrum']) ?> van het stadscentrum</p>
            <p>
                <?= htmlspecialchars($reis['maaltijd']) ?> -
                <?= $reis['vlucht_inbegrepen'] ? "Directe vlucht is in de prijs inbegrepen." : "Vlucht niet inbegrepen." ?>
            </p>
            <p>
                <strong><?= $reis['beoordeling_score'] ?> ★</strong>
                (<?= $reis['beoordeling_aantal'] ?> beoordelingen - <?= htmlspecialchars($reis['beoordeling_text']) ?>)
            </p>
        </div>
        <div class="reis-prijs">
            <div>€<?= number_format($reis['prijs'], 0) ?></div>
            <small>Prijs per persoon<br>(vlucht + verblijf)</small>
            <a class="boek-knop" href="detail.php?id=<?= $reis['id'] ?>">Kies</a>
        </div>
    </div>
<?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
