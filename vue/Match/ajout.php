<?php
require_once __DIR__ . '/../../controleur/Match/GestionAjoutMatch.php';
include '../../menu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un match</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <h1>Ajouter un match</h1>
    <form method="post">
        Date : <input type="date" name="date" required><br>
        Heure : <input type="time" name="heure"><br>
        Adversaire : <input type="text" name="adversaire"><br>
        Lieu : <input type="text" name="lieu"><br>
        Résultat : <input type="text" name="resultat"><br>
        <input type="submit" value="Ajouter" class="btn-ajouter">
    </form>
    <a href="liste.php">Retour à la liste</a>
</body>
</html>
