<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role']!=='admin') {
    header('HTTP/1.1 403 Forbidden'); exit('Geen toegang');
}
require 'includes/db.php';
include 'includes/header.php';


$msgs = $pdo->query("SELECT * FROM contact_messages ORDER BY submitted_at DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="admin-main" style="max-width:900px;margin:40px auto;">
  <h1>Contactberichten</h1>

  <?php if (!$msgs): ?>
      <p>Er zijn nog geen berichten.</p>
  <?php else: ?>
    <table class="booking-table">
      <thead>
        <tr>
          <th>#</th><th>Datum</th><th>Naam</th><th>E-mail</th><th>Bericht</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($msgs as $m): ?>
        <tr>
          <td><?= $m['id'] ?></td>
          <td><?= date('d-m-Y H:i', strtotime($m['submitted_at'])) ?></td>
          <td><?= htmlspecialchars($m['name']) ?></td>
          <td><?= htmlspecialchars($m['email']) ?></td>
          <td><?= nl2br(htmlspecialchars($m['message'])) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
