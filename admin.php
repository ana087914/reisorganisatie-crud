<?php
/********  SECURITATE + CONEXIUNE  ********/
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    exit('Geen toegang – alleen voor admins.');
}
require 'includes/db.php';

/********  SELECTĂM BOOKING-URILE  ********/
$stmt = $pdo->query(
    "SELECT b.id,
            b.booked_at,
            b.total_price,
            b.status,
            u.email        AS klant,
            a.titel        AS reis
     FROM boekingen b
     JOIN users u        ON u.id  = b.user_id
     JOIN aanbiedingen a ON a.id  = b.trip_id
     ORDER BY b.booked_at DESC"
);
$boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="admin-dashboard">
  <aside class="admin-sidebar">
    <h2>Family<br>Travel</h2>
    <nav>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
      <ul>
        <li><a href="admin.php">Dashboard</a></li>
        <li><a href="#">Reizen (în curând)</a></li>
        <li><a href="#">Klanten (în curând)</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes

     <ul>
  <li><a href="admin.php">Dashboard</a></li>
  <li><a href="trip-list.php">Reizen beheer</a></li>
  <li><a href="logout.php">Log out</a></li>
</ul>

<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    </nav>
  </aside>

  <main class="admin-main">
    <h1>Boekingen recente</h1>

    <table class="booking-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Datum</th>
          <th>Reis</th>
          <th>Klant</th>
          <th>Bedrag</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!$boekingen): ?>
          <tr><td colspan="6">Nog geen boekingen.</td></tr>
        <?php else: ?>
          <?php foreach ($boekingen as $b): ?>
            <tr>
              <td>#<?= $b['id'] ?></td>
              <td><?= date('d-m-Y', strtotime($b['booked_at'])) ?></td>
              <td><?= htmlspecialchars($b['reis']) ?></td>
              <td><?= htmlspecialchars($b['klant']) ?></td>
              <td>€<?= number_format($b['total_price'], 0) ?></td>
              <td><span class="status <?= $b['status'] ?>"><?= $b['status'] ?></span></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </main>
</div>

<?php include 'includes/footer.php'; ?>
