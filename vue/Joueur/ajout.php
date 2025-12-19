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
        <label>Nom :</label> 
        <input type="text" name="nom" required><br>
        <label>Prénom :</label> 
        <input type="text" name="prenom" required><br>
        <label>Numéro de license :</label> 
        <input type="text" name="num_license" required><br>
        <label>Date de naissance :</label>
        <input type="date" name="date_naissance"><br>
        <label>Taille :</label> 
        <input type="text" step="0.01" name="taille"><br>
        <label>Poids :</label> 
        <input type="number" step="0.01" name="poids"><br>
        <label>Statut :</label> 
        <input type="text" name="statut"><br>
        <label>Poste préféré :</label> 
        <input type="text" name="poste_prefere"><br>

        <input type="submit" value="Ajouter">
    </form>
    <input onclick="window.location.href'liste.php'" type="submit" value="Retour" class="btn-ajouter">
</body>
</html>
