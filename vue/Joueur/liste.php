<?php
include '../../menu.php';
require_once __DIR__ . '/../../controleur/Joueur/GestionListeJoueur.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

    <h1>Liste des joueurs</h1>

    <div class="table-header">
        <a href="ajout.php" class="btn-ajouter">Ajouter un joueur</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Numéro license</th>
                <th>Date naissance</th>
                <th>Taille</th>
                <th>Poids</th>
                <th>Statut</th>
                <th>Poste préféré</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($joueurs as $j): ?>
            <tr>
                <td><?= htmlspecialchars($j->getNom()) ?></td>
                <td><?= htmlspecialchars($j->getPrenom()) ?></td>
                <td><?= htmlspecialchars($j->getNumLicense()) ?></td>
                <td><?= htmlspecialchars($j->getDateNaissance()) ?></td>
                <td><?= htmlspecialchars($j->getTaille()) ?></td>
                <td><?= htmlspecialchars($j->getPoids()) ?></td>
                <td><?= htmlspecialchars($j->getStatut()) ?></td>
                <td><?= htmlspecialchars($j->getPostePrefere()) ?></td>
                <td>
                    <a href="modifier.php?id=<?= $j->getIdJoueur() ?>" class="action-btn edit-btn">Modifier</a>
                    <a href="supprimer.php?id=<?= $j->getIdJoueur() ?>" class="action-btn delete-btn" onclick="return confirm('Supprimer ce joueur ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
