<?php
include '../../menu.php';
require_once __DIR__ . '/../../controleur/Match/GestionListeMatch.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des matchs</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

    <h1>Liste des matchs</h1>

    <div class="table-header">
        <a href="ajout.php" class="btn-ajouter">Ajouter un match</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Adversaire</th>
                <th>Lieu</th>
                <th>Résultat</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($matchs as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m->getDate()) ?></td>
                <td><?= htmlspecialchars($m->getHeure()) ?></td>
                <td><?= htmlspecialchars($m->getAdversaire()) ?></td>
                <td><?= htmlspecialchars($m->getLieu()) ?></td>
                <td><?= htmlspecialchars($m->getResultat()) ?></td>
                <td><?= htmlspecialchars($m->getStatut()) ?></td>
                <td>
                    <a href="modifier.php?id=<?= $m->getIdMatch() ?>" class="action-btn edit-btn">Modifier</a>
                    <a href="supprimer.php?id=<?= $m->getIdMatch() ?>" class="action-btn delete-btn" onclick="return confirm('Supprimer ce match ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
