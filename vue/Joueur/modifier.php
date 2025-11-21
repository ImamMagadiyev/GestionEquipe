<?php

require_once __DIR__ . '/../../controleur/Joueur/GestionModifierJoueur.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un joueur</title>
</head>
<body>
    <h1>Modifier un joueur</h1>
    <form method="post">
        Nom : <input type="text" name="nom" value="<?= htmlspecialchars($joueur->getNom()) ?>"><br>
        Prénom : <input type="text" name="prenom" value="<?= htmlspecialchars($joueur->getPrenom()) ?>"><br>
        Numéro de license : <input type="text" name="num_license" value="<?= htmlspecialchars($joueur->getNumLicense()) ?>"><br>
        Date de naissance : <input type="date" name="date_naissance" value="<?= htmlspecialchars($joueur->getDateNaissance()) ?>"><br>
        Taille : <input type="text" step="0.01" name="taille" value="<?= htmlspecialchars($joueur->getTaille()) ?>"><br>
        Poids : <input type="number" step="0.01" name="poids" value="<?= htmlspecialchars($joueur->getPoids()) ?>"><br>
        Statut : <input type="text" name="statut" value="<?= htmlspecialchars($joueur->getStatut()) ?>"><br>
        Poste préféré : <input type="text" name="poste_prefere" value="<?= htmlspecialchars($joueur->getPostePrefere()) ?>"><br>
        <input type="submit" value="Modifier">
    </form>
    <a href="liste.php">Retour à la liste</a>
</body>
</html>
