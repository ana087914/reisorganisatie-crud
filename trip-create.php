<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    exit('Geen toegang.');
}

require 'includes/db.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    $data = [
        'categorie'           => $_POST['categorie']          ?? 'Last minute',
        'titel'               => $_POST['titel']              ?? '',
        'beschrijving'        => $_POST['beschrijving']       ?? '',
        'afbeelding'          => $_POST['afbeelding']         ?? 'placeholder.jpg',
        'locatie'             => $_POST['locatie']            ?? '',
        'vertrek_luchthaven'  => $_POST['vertrek_luchthaven'] ?? '',
        'datum_start'         => $_POST['datum_start']        ?? '',
        'datum_eind'          => $_POST['datum_eind']         ?? '',
        'nachten'             => (int)$_POST['nachten']       ?? 1,
        'beoordeling_score'   => (float)$_POST['score']       ?? 4.0,
        'beoordeling_text'    => $_POST['score_text']         ?? 'Goed',
        'beoordeling_aantal'  => (int)$_POST['score_cnt']     ?? 1,
        'afstand_stadcentrum' => $_POST['afstand']            ?? '0 km',
        'maaltijd'            => $_POST['maaltijd']           ?? 'Geen',
        'vlucht_inbegrepen'   => isset($_POST['vlucht'])      ? 1 : 0,
        'prijs'               => (float)$_POST['prijs'],
        'groot'               => 0                          
    ];

    $sql = "INSERT INTO aanbiedingen
            (categorie, titel, beschrijving, afbeelding, locatie,
             vertrek_luchthaven, datum_start, datum_eind, nachten,
             beoordeling_score, beoordeling_text, beoordeling_aantal,
             afstand_stadcentrum, maaltijd, vlucht_inbegrepen, prijs, groot)
            VALUES
            (:categorie, :titel, :beschrijving, :afbeelding, :locatie,
             :vertrek_luchthaven, :datum_start, :datum_eind, :nachten,
             :beoordeling_score, :beoordeling_text, :beoordeling_aantal,
             :afstand_stadcentrum, :maaltijd, :vlucht_inbegrepen, :prijs, :groot)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    header('Location: trip-list.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>
<div class="login-container" style="max-width:700px">
  <h2>Nieuwe reis</h2>
  <form method="post">

    <input  type="text" name="titel"              placeholder="Titel"          required>
    <textarea name="beschrijving"  rows="3"       placeholder="Beschrijving"   required></textarea>
    <input  type="text" name="categorie"          placeholder="Categorie">
    <input  type="text" name="locatie"            placeholder="Locatie (ex: Spanje / Malaga)">
    <input  type="text" name="vertrek_luchthaven" placeholder="Vertrek luchthaven">
    <input  type="date" name="datum_start"        placeholder="Van"            required>
    <input  type="date" name="datum_eind"         placeholder="Tot"            required>
    <input  type="number" name="nachten"          placeholder="Nachten" min="1" required>
    <input  type="number" step="0.1" name="score" placeholder="Score (4.5)">
    <input  type="text" name="score_text"         placeholder="Score tekst">
    <input  type="number" name="score_cnt"        placeholder="Aantal reviews">
    <input  type="text" name="afstand"            placeholder="Afstand stadcentrum (ex: 0.8 km)">
    <input  type="text" name="maaltijd"           placeholder="Maaltijd (Ontbijt)">
    <label><input type="checkbox" name="vlucht"> Vlucht inbegrepen</label>
    <input  type="number" name="prijs"            placeholder="Prijs €" step="0.01" required>
    <input  type="text" name="afbeelding"         placeholder="Afbeelding (rome.jpg)" required>

    <button type="submit">Opslaan</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
