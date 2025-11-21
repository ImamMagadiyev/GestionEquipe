<?php
require_once __DIR__ . '/../../controleur/Match/GestionModifierMatch.php';
include '../../menu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un match</title>
        <link rel="stylesheet" href="../../style.css">

</head>
<body>
    <h1>Modifier un match</h1>
    <form method="post">
        Date : <input type="date" name="date" value="<?= htmlspecialchars($match->getDate()) ?>"><br>
        Heure : <input type="time" name="heure" value="<?= htmlspecialchars($match->getHeure()) ?>"><br>
        Adversaire : <input type="text" name="adversaire" value="<?= htmlspecialchars($match->getAdversaire()) ?>"><br>
        Lieu : <input type="text" name="lieu" value="<?= htmlspecialchars($match->getLieu()) ?>"><br>
        Résultat : <input type="text" name="resultat" value="<?= htmlspecialchars($match->getResultat()) ?>"><br>
        <input type="submit" value="Modifier" class="btn-edit">
    </form>
    <a href="liste.php">Retour à la liste</a>
</body>
</html>
