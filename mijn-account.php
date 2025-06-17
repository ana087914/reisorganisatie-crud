<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

/* ───── Date user + bookings ───── */
$user_id  = $_SESSION['user_id'];

/* user */
$stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$stmt = $pdo->prepare(
  "SELECT  b.*,
           a.titel      AS reis_naam,
           a.afbeelding AS afbeelding
     FROM boekingen b
     JOIN aanbiedingen a ON a.id = b.trip_id
    WHERE b.user_id = ?
    ORDER BY b.booked_at DESC"
);
$stmt->execute([$user_id]);
$boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ───── View ───── */
include 'includes/header.php';
?>

<?php
if (!empty($_SESSION['flash'])) {
    echo '<p style="text-align:center;color:green;margin-top:20px">'
       . htmlspecialchars($_SESSION['flash']) .
       '</p>';
    unset($_SESSION['flash']);
}
?>

<h1 class="reizen-title">Welkom, <?= htmlspecialchars($user['email']) ?></h1>
<h2 class="reizen-title" style="font-size:26px;">Mijn Boekingen</h2>

<?php if (!$boekingen): ?>
    <p style="text-align:center;">
        Je hebt nog geen boekingen.<br>
        Ga naar <a href="index.php">Home</a> en boek een reis!
    </p>
<?php else: ?>
    <div class="boekingen-lijst">
        <?php foreach ($boekingen as $b): ?>
            <?php
              $imgFile = $b['afbeelding'] ?: 'placeholder.jpg';
            ?>
            <div class="boeking-kaart">
                <img src="images/<?= htmlspecialchars($imgFile) ?>"
                     alt="<?= htmlspecialchars($b['reis_naam']) ?>">

                <div>
                    <h3><?= htmlspecialchars($b['reis_naam']) ?></h3>
                    <p><?= date('d-m-Y', strtotime($b['booked_at'])) ?></p>
                    <p><?= $b['persons'] ?> personen – €<?= number_format($b['total_price'], 0) ?></p>
                    <p>Status: <strong><?= $b['status'] ?></strong></p>

                    <?php if ($b['status'] !== 'cancelled'): ?>
                        <a class="annuleer-btn"
                           href="cancel.php?id=<?= $b['id'] ?>"
                           onclick="return confirm('Weet je zeker dat je wilt annuleren?');">
                            Annuleer
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
