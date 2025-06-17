<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
  header('HTTP/1.1 403 Forbidden'); exit('Geen toegang.');
}
require 'includes/db.php';
include 'includes/header.php';


$trips = $pdo->query("SELECT id, titel, prijs FROM aanbiedingen ORDER BY id DESC")
             ->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="admin-main" style="max-width:900px;margin:40px auto;">
  <h1>Reizen</h1>
  <a href="trip-create.php" class="boek-knop" style="margin-bottom:15px;display:inline-block;">
     + Nieuwe reis
  </a>

  <table class="booking-table">
    <thead><tr><th>#</th><th>Titel</th><th>Prijs (€)</th><th>Acties</th></tr></thead>
    <tbody>
    <?php foreach ($trips as $t): ?>
      <tr>
        <td><?= $t['id'] ?></td>
        <td><?= htmlspecialchars($t['titel']) ?></td>
        <td><?= number_format($t['prijs'],0) ?></td>
        <td>
          <a href="trip-edit.php?id=<?= $t['id'] ?>">Edit</a> |
          <a href="trip-delete.php?id=<?= $t['id'] ?>"
             onclick="return confirm('Weet je zeker?');">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include 'includes/footer.php';?>
