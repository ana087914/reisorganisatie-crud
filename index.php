<?php include 'includes/header.php'; ?>
<section class="search-banner">
  <form class="search-box" action="reizen.php" method="GET">
    <div class="search-item">
      <label for="to">Waarheen?</label>
      <input type="text" id="to" name="to" placeholder="Overal" class="fake-span" />
    </div>
    <div class="divider"></div>
    <div class="search-item">
      <label for="from">Waar vandaan?</label>
      <input type="text" id="from" name="from" placeholder="Alle vliegvelden" class="fake-span" />
    </div>
    <div class="divider"></div>
    <div class="search-item">
      <label for="date">Wanneer?</label>
      <input type="date" id="date" name="date" class="fake-span" />
    </div>
    <div class="divider"></div>
    <div class="search-item">
      <label for="duration">Voor hoelang?</label>
      <select id="duration" name="duration" class="fake-span">
        <option value="3-4">3 - 4 nachten</option>
        <option value="5-7">5 - 7 nachten</option>
        <option value="8+">8+ nachten</option>
      </select>
    </div>
    <div class="divider"></div>
    <div class="search-item">
      <label for="people">Hoeveel personen?</label>
      <input type="number" id="people" name="people" value="2" min="1" max="10" class="fake-span" />
    </div>
    <button class="search-button" type="submit">
      <img src="images/search-icon.png" alt="Zoeken" />
    </button>
  </form>
  <h1 class="search-title">Vlucht + Hotel. Boek samen en betaal minder!</h1>
</section>




<?php
include 'includes/db.php';
$teksten = [
    "Last minute" => "De beste tijd om op vakantie te gaan? Direct! Profiteer van onze lastminute-deals",
    "All-inclusive" => "Onbeperkt plezier, ontspannen bij het zwembad of aan het strand. Trakteer jezelf op een zorgeloze all-inclusive vakantie",
    "Stedentrip" => "Leuke steden voor 3-4 daagse trips"
];

$stmt = $pdo->prepare("SELECT * FROM aanbiedingen ORDER BY 
    FIELD(categorie, 'Last minute', 'All-inclusive', 'Stedentrip'), groot DESC, id");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$groepen = [];
foreach ($results as $row) {
    $groepen[$row['categorie']][] = $row;
}

foreach ($teksten as $categorie => $sub) {
    if (!isset($groepen[$categorie])) continue;

    echo "<section class='aanbieding-sectie'>";
    echo "<h2 class='categorie-title sansation-font'>{$categorie}</h2>";
    echo "<p class='categorie-sub'>{$sub}</p>";
    echo "<div class='aanbiedingen-grid'>";

    foreach ($groepen[$categorie] as $aanbieding) {
        $cardClass = $aanbieding['groot'] ? 'aanbieding-card groot' : 'aanbieding-card';
        echo "<a href='reizen.php' class='{$cardClass}'>
                <img src='images/{$aanbieding['afbeelding']}' alt='{$aanbieding['titel']}'>
                <div class='aanbieding-info'>
                    <h3>{$aanbieding['titel']}</h3>
                    <p>{$aanbieding['beschrijving']}</p>
                </div>
              </a>";
    }

    echo "</div></section>";
}
?>





<?php include 'includes/footer.php'; ?>
