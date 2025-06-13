<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role']!=='admin') { header('HTTP/1.1 403'); exit; }
require 'includes/db.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM aanbiedingen WHERE id=?");
$stmt->execute([$id]);
$trip = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$trip) { exit('Reis niet gevonden.'); }

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $titel = $_POST['titel'];
  $beschrijving = $_POST['beschrijving'];
  $prijs = (float)$_POST['prijs'];
  $afbeelding = $_POST['afbeelding'];

  $upd = $pdo->prepare(
    "UPDATE aanbiedingen SET titel=?, beschrijving=?, prijs=?, afbeelding=? WHERE id=?"
  );
  $upd->execute([$titel, $beschrijving, $prijs, $afbeelding, $id]);
  header("Location: trip-list.php");
  exit;
}

include 'includes/header.php'; ?>
<div class="login-container" style="max-width:600px;">
  <h2>Reis bewerken</h2>
  <form method="post">
    <input type="text" name="titel" value="<?= htmlspecialchars($trip['titel']) ?>" required>
    <textarea name="beschrijving" rows="4" required><?= htmlspecialchars($trip['beschrijving']) ?></textarea>
    <input type="number" name="prijs" value="<?= $trip['prijs'] ?>" required>
    <input type="text" name="afbeelding" value="<?= $trip['afbeelding'] ?>" required>
    <button type="submit">Bijwerken</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
