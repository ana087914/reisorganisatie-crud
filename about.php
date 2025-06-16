
<?php
include 'includes/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Travel-Overons</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

</head>
<body>
  
    <section class="hero">
       <h1>Over ons</h1>
       <div class="scroll-down">&#8595;</div>
    </section>

    <section class="info-section">
        <h2> Wij zijn beschikbaar voor iedere fase van uw reis</h2>
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

<section class="take-care">
    <h2>U bent belangrijk voor ons</h2>
  <img class="take-care-image" src="images/take-care.jpg" alt="Zonsondergang over waterbungalows">
  <div class="take-care-text">
    <p class="take-care-description">
      Wij zullen u ondersteunen met onze reiservaring, waar u ook bent. U hoeft alleen maar contact met ons op te nemen.
    </p>
    <button class="button-take-care" onclick="window.location.href='contact.php'">
      Neem contact met ons op
    </button>
  </div>
</section>


 <section class="team-section">
  <h2>Maak kennis met ons team</h2>
  <p class="subheading">Wij zijn er om u te helpen bij het plannen van uw droomreis</p>
  <div class="team-wrapper">
  <div class="team-box1">
    <div class="team-member">
      <img src="images/Jan.png" alt="Team Member 1">
      <h3>Jan</h3>
      <small>Reisadviseur</small>
      <p>Met jarenlange ervaring in de reisbranche helpt Jan u bij het vinden van uw perfecte vakantie naar de zon.</p>
    </div>
  </div>

  <div class="team-box2">
    <div class="team-member">
      <img src="images/Lisa.png" alt="Team Member 2">
      <h3>Lisa</h3>
      <small>Vluchtenspecialist</small>
      <p>Lisa is expert in het combineren van de beste vluchten en zorgt dat u altijd de snelste en voordeligste route heeft.</p>
    </div>
  </div>

  <div class="team-box3">
    <div class="team-member">
      <img src="images/ahmed.png" alt="Team Member 3">
      <h3>Ahmed</h3>
      <small>Avonturenplanner</small>
      <p>Ahmed helpt avonturiers met unieke ervaringen zoals safari's, bergtochten en culturele expedities.</p>
    </div>
  </div>
 </div>
</section>

  <section class="testimonial-section">
    <h2>Meer dan een miljoen tevreden reizigers</h2>
    <p class="subheading">Wij helpen al jarenlang reizigers de wereld te verkennen</p>

    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="images/daan.jpg" alt="Daan">
          <h3>Daan</h3>
          <small>Haag</small>
          <p>Het is makkelijker om te kopen bij edestinos dan naar een bureau te gaan.</p>
        </div>
        <div class="swiper-slide">
          <img src="images/samira.jpeg" alt="Samira">
          <h3>Samira</h3>
          <small>Rotterdam</small>
          <p>Super makkelijk om vluchten te vergelijken en boeken!</p>
        </div>
        <div class="swiper-slide">
          <img src="images/robin.jpg" alt="Robin">
          <h3>Robin</h3>
          <small>Utrecht</small>
          <p>Geweldige service en altijd de beste prijzen!</p>
        </div>
        <div class="swiper-slide">
          <img src="images/Ariana.jpeg" alt="Lisa">
          <h3>Lisa</h3>
          <small>Amsterdam</small>
          <p>Een geweldige ervaring, ik boek hier zeker opnieuw.</p>
        </div>
      </div>

      <!-- Add Arrows -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>
    </div>
  </section>

 <section class="contact-section">
    <h2>Neem contact met ons op</h2>
    <p class="subheading">Heeft u vragen of wilt u meer informatie?</p>
    <p>Neem gerust contact met ons op via het onderstaande formulier of bel ons op +31 20 123 4567.</p>
    <form action="contact.php" method="post">
      <label for="name">Naam:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Bericht:</label>
      <textarea id="message" name="message" rows="4" required></textarea>

      <button type="submit">Verstuur</button>
    </form>
  </section>


<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
 <script src="js/script.js"></script>
</body>
</html>

