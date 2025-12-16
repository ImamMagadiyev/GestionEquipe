<?php
require_once __DIR__ . '/../../controleur/Match/GestionAjoutMatch.php';
include '../../menu.php';

// Le chemin absolu est prouvé comme étant fonctionnel pour la fonction glob()
$repertoireAbsolu = __DIR__ . '/../../Assets/clubs/'; 
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
    <form method="post" class="formulaire">
        Date : <input type="date" name="date" required>
        Heure : <input type="time" name="heure"><br><br>
        Adversaire : <input type="text" name="adversaire">
        
        Logo : 
        <select name="logo_adversaire">
            <option value="">-- Choisir un logo --</option>
            
            <?php

            $cheminRelatifAffichage = 'Assets/clubs';
            // Utilisation du chemin absolu qui a donné SUCCÈS
            $fichiersLogos = glob($repertoireAbsolu . '*.png');

            foreach ($fichiersLogos as $cheminFichier) {
                $nomFichier = basename($cheminFichier);
                
                $valeurAEnregistrer = $cheminRelatifAffichage . $nomFichier;
                
                // Créer une étiquette lisible
                $label = str_replace(['_', '.png'], [' ', ''], $nomFichier);
                $label = ucwords($label);

                echo "<option value=\"$valeurAEnregistrer\">$label</option>";
            }
            ?>
        </select>
        <br>
        Lieu : <input type="text" name="lieu"><br>
        Résultat : <input type="text" name="resultat"><br>
        <input type="submit" value="Ajouter" class="btn-ajouter">
    </form>
    <a href="liste.php">Retour à la liste</a>
</body>
</html>