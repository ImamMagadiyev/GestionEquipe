<?php
require_once __DIR__ . '/../../controleur/Joueur/GestionAjoutJoueur.php';
include '../../menu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un joueur</title>
    <link rel="stylesheet" href="../../style.css">

</head>
<body>
    <h1>Ajouter un joueur</h1>
    <form method="post" class="formulaire">
        Nom : <input type="text" name="nom" required><br>
        Prénom : <input type="text" name="prenom" required><br>
        Numéro de license : <input type="text" name="num_license" required><br>
        Date de naissance : <input type="date" name="date_naissance"><br>
        Taille : <input type="text" step="0.01" name="taille"><br>
        Poids : <input type="number" step="0.01" name="poids"><br>
        Statut : <input type="text" name="statut"><br>
        Poste préféré : <input type="text" name="poste_prefere"><br>
        <input type="submit" value="Ajouter">
    </form>
    <a href="liste.php">Retour à la liste</a>
</body>
</html>
