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

$sql = "SELECT * FROM aanbiedingen ORDER BY categorie, id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$currentCategorie = '';
foreach ($result as $row) {
    if ($currentCategorie !== $row['categorie']) {
        if ($currentCategorie !== '') echo "</div>"; // Închide secțiune anterioară
        $currentCategorie = $row['categorie'];
        echo "<h2 class='categorie-title'>{$currentCategorie}</h2>";
        echo "<div class='aanbiedingen-grid'>";
    }

    echo "<div class='aanbieding-card'>
            <img src='images/{$row['afbeelding']}' alt='{$row['titel']}'>
            <h3>{$row['titel']}</h3>
            <p>{$row['beschrijving']}</p>
          </div>";
}
if ($currentCategorie !== '') echo "</div>";
?>



<?php include 'includes/footer.php'; ?>
