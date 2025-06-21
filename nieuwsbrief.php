<?php

include 'includes/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM nieuwsbrief WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                header('Location: index.php?signup=exists');
                exit;
            }

            $insert = $pdo->prepare("INSERT INTO nieuwsbrief (email) VALUES (?)");
            $insert->execute([$email]);

            header('Location: index.php?signup=success');
            exit;
        } catch (PDOException $e) {
            echo "Fout bij inschrijven: " . $e->getMessage();
        }
    } else {
        echo "Ongeldig e-mailadres.";
    }
}
?>
