<?php

include 'includes/header.php';
include 'includes/db.php';


$conditions = [];
$params     = [];

/* 1a. Vrije zoekterm (“to”) – zoek in titel, beschrijving én locatie.
       Elk woord moet voorkomen (AND).                       */
if (!empty($_GET['to'])) {
    $woorden  = preg_split('/\s+/', trim($_GET['to']));
    $subConds = [];
    foreach ($woorden as $i => $woord) {
        $key = ":to$i";
        $subConds[] = "(titel LIKE $key OR beschrijving LIKE $key OR locatie LIKE $key)";
        $params[$key] = '%' . $woord . '%';
    }
    $conditions[] = '(' . implode(' AND ', $subConds) . ')';
}

/* 1b. Vertrek-luchthaven (“from”)                          */
if (!empty($_GET['from'])) {
    $conditions[] = "vertrek_luchthaven LIKE :from";
    $params[':from'] = '%' . $_GET['from'] . '%';
}

/* 1c. Datum binnen start/eind                              */
if (!empty($_GET['date'])) {
    $conditions[] = ":date BETWEEN datum_start AND datum_eind";
    $params[':date'] = $_GET['date'];
}

/* 1d. Duur                                                 */
if (!empty($_GET['duration'])) {
    switch ($_GET['duration']) {
        case '3-4': $conditions[] = "nachten BETWEEN 3 AND 4"; break;
        case '5-7': $conditions[] = "nachten BETWEEN 5 AND 7"; break;
        case '8+':  $conditions[] = "nachten >= 8";            break;
    }
}

/* (people niet gebruikt in prijsberekening, dus genegeerd) */

$where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
$sql   = "SELECT * FROM aanbiedingen $where ORDER BY datum_start ASC";


$stmt   = $pdo->prepare($sql);
$stmt->execute($params);
$reizen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="reizen-title">Vlucht + Hotel – kies uw reis</h1>



<div class="reizen-container">
<?php if (!$reizen): ?>
    <p style="text-align:center;">
      Geen reizen gevonden voor
      <strong><?= htmlspecialchars($_GET['to'] ?? 'jouw zoekopdracht') ?></strong>.
      Probeer een andere bestemming of datum.
    </p>
<?php else: ?>
  <?php foreach ($reizen as $reis): ?>
    <div class="reis-card"
         onclick="window.location.href='detail.php?id=<?= $reis['id'] ?>'">

        <div class="reis-image">
            <img src="images/<?= htmlspecialchars($reis['afbeelding']) ?>"
                 alt="<?= htmlspecialchars($reis['titel']) ?>">
        </div>

        <div class="reis-info">
            <h2><?= htmlspecialchars($reis['titel']) ?></h2>
            <p><?= htmlspecialchars($reis['locatie']) ?></p>
            <p><strong>Vertrek:</strong> <?= htmlspecialchars($reis['vertrek_luchthaven']) ?><br>
               Datum: <?= date("j M Y", strtotime($reis['datum_start'])) ?> –
               <?= date("j M Y", strtotime($reis['datum_eind'])) ?>
               (<?= $reis['nachten'] ?> nachten)</p>
            <p><?= htmlspecialchars($reis['afstand_stadcentrum']) ?> van het stadscentrum</p>
            <p>
              <?= htmlspecialchars($reis['maaltijd']) ?> –
              <?= $reis['vlucht_inbegrepen'] ? "Directe vlucht inbegrepen." : "Vlucht niet inbegrepen." ?>
            </p>
            <p>
              <strong><?= $reis['beoordeling_score'] ?> ★</strong>
              (<?= $reis['beoordeling_aantal'] ?> – <?= htmlspecialchars($reis['beoordeling_text']) ?>)
            </p>
        </div>

        <div class="reis-prijs">
            <div>€<?= number_format($reis['prijs'], 0) ?></div>
            <small>Prijs p.p.<br>(vlucht + verblijf)</small>
            <a class="boek-knop" href="detail.php?id=<?= $reis['id'] ?>">Kies</a>
        </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
