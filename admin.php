
<?php include 'includes/header.php'; ?>

<div class="admin-dashboard">
  <aside class="admin-sidebar">
    <h2>Family<br>Travel</h2>
    <nav>
<<<<<<< Updated upstream
      <ul>
        <li><a href="#">dashboard</a></li>
        <li><a href="#">reizen</a></li>
        <li><a href="#">klanten</a></li>
        <li><a href="logout.php">log out</a></li>
      </ul>
=======
     <ul>
  <li><a href="admin.php">Dashboard</a></li>
  <li><a href="trip-list.php">Reizen beheer</a></li>
  <li><a href="logout.php">Log out</a></li>
</ul>

>>>>>>> Stashed changes
    </nav>
  </aside>

  <main class="admin-main">
    <div class="status-tabs">
      <button class="tab new">nieuwe boekingen</button>
      <button class="tab pending">in afwachting</button>
      <button class="tab confirmed">bevestigd</button>
      <button class="tab cancelled">geannuleerd</button>
    </div>

    <table class="booking-table">
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>Datum</th>
          <th>Reis</th>
          <th>Klant</th>
          <th>Bedrag</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>#10956</td><td>17-06-2020</td><td>Stedentrip Parijs</td><td>Sarah Janssen</td><td>€850</td><td><span class="status new">Nieuw</span></td></tr>
        <tr><td>#10843</td><td>18-06-2020</td><td>Strandvakantie Bali</td><td>Mark de Vries</td><td>€1200</td><td><span class="status pending">In Afwachting</span></td></tr>
        <tr><td>#10932</td><td>24-06-2020</td><td>Avontuur in IJsland</td><td>Linda Smit</td><td>€1500</td><td><span class="status confirmed">Bevestigd</span></td></tr>
        <tr><td>#10909</td><td>19-06-2020</td><td>Vakantie in Dubrovnik</td><td>Sophie Kuipers</td><td>€1100</td><td><span class="status cancelled">Geannuleerd</span></td></tr>
      </tbody>
    </table>
  </main>
</div>

<?php include 'includes/footer.php'; ?>
