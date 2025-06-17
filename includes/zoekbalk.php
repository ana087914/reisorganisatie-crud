<?php
$zoekterm = $_GET['to'] ?? '';   // ingevulde zoekterm bewaren
?>
<div class="zoekbalk-container">
  <form class="zoekbalk-form" action="/reizen.php" method="get">
      <input  type="text"
              name="to"
              class="zoekbalk-input"
              placeholder="Bestemming (bijv. Rome)"
              value="<?= htmlspecialchars($zoekterm) ?>"
              required>

      <button type="submit" class="zoekbalk-btn">
        🔍 Zoeken
      </button>
  </form>
</div>
