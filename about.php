
<?php
include 'includes/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Travel-Overons</title>
</head>
<body>

    <section class= hero>
       <h1>Over ons</h1>
       <div class="scroll-down">&#8595;</div>
    </section>

    <section class="info-section">
        <h2> Wij zijn beschikbaar voor iedere fase van uw ries</h2>
        <p>
            Wij Weten hoe moeilijk het is om een reis te plannen. Wij hebben veel reizen gemaakt en willen onze ervaringen gebruiken om jou reis te plannen!
        </p>
    </section>

   <section class="inspiration">
  <img class="inspiration-image" src="images/vakantie-malediven.jpg" alt="Zonsondergang over waterbungalows">
  <div class="inspiration-text">
    <p class="inspiration-description">
      Laat u door ons inspireren. Iedereen verdient een adembenemende reis, prachtige stedentrip of een zonvakantie.
      Wij zoeken naar unieke deals en combineren deze. U vindt eenvoudig de beste opties!
    </p>
    <button class="button-inspiration" onclick="window.location.href='reizen.php'">
     Ontdek onze reis deals
    </button>
  </div>
</section>

  <section class="plannen">
    <h2>Wij zijn beschikbaar voor iedere fase van uw reis</h2>
    <p>
      Wij weten hoe moeilijk het is om een reis te plannen. Wij hebben veel reizen gemaakt en willen onze ervaringen gebruiken om jouw reis te plannen!
    </p>
  <img class="plannen-image" src="images/plannen.jpg" alt="Zonsondergang over waterbungalows">
  <div class="plannen-text">
    <p class="plannen-description">
      De reis is niet alleen een vlucht. Wij bieden nog veel meer: een aangenaam verblijf, goedkope autohuur en een betrouwbare verzekering. De keuze is aan jou!
    </p>
    <button class="button-plannen" onclick="window.location.href='reizen.php'">
      Reis zoals u wilt
    </button>
  </div>
</section>

 <section class="testimonial-section">
    <h2>Meer dan een miljoen tevreden reizigers</h2>
    <p class="subheading">Wij helpen al jarenlang reizigers de wereld te verkennen</p>

    <div class="testimonial-carousel">
      <button>&larr;</button>
      <div class="testimonial">
        <img src="images/daan.jpg" alt="Daan">
        <h3>Daan</h3>
        <small>Haag</small>
        <p>Het is makkelijker om te kopen bij edestinos dan naar een bureau te gaan.</p>
      </div>
      <button>&rarr;</button>
    </div>

    <div class="carousel-nav">
      <span></span>
      <span class="active"></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </section>


</body>
</html>

