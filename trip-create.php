<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role']!=='admin') { header('HTTP/1.1 403'); exit; }
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $titel = $_POST['titel'] ?? '';
  $beschrijving = $_POST['beschrijving'] ?? '';
  $prijs = (float)$_POST['prijs'];
  $afbeelding = $_POST['afbeelding'] ?? 'placeholder.jpg';   // simplu: cale imagine

  $ins = $pdo->prepare(
    "INSERT INTO aanbiedingen (titel, beschrijving, prijs, afbeelding)
     VALUES (?,?,?,?)"
  );
  $ins->execute([$titel, $beschrijving, $prijs, $afbeelding]);
  header("Location: trip-list.php");
  exit;
}

include 'includes/header.php'; ?>
<div class="login-container" style="max-width:600px;">
  <h2>Nieuwe reis</h2>
  <form method="post">
    <input type="text" name="titel" placeholder="Titel" required>
    <textarea name="beschrijving" placeholder="Beschrijving" rows="4" required></textarea>
    <input type="number" name="prijs" placeholder="Prijs €" required>
    <input type="text" name="afbeelding" placeholder="Afbeelding (ex: rome.jpg)" required>
    <button type="submit">Opslaan</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
