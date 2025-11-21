<?php
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php';

$daoMatch = new DaoMatch($linkpdo);
$matches = $daoMatch->findAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir le match à préparer</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php require '../../menu.php'; ?>

    <main>
        <h1>Choisir le match à préparer</h1>

        <?php if(empty($matches)): ?>
            <p class="error">Aucun match disponible.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Adversaire</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matches as $match): ?>
                        <tr>
                            <td><?= htmlspecialchars($match->getAdversaire()) ?></td>
                            <td><?= htmlspecialchars($match->getDate()) ?></td>
                            <td>
                                <a class="action-btn edit-btn" href="/GestionEquipe/vue/saisie.php?id=<?= $match->getIdMatch() ?>">Préparer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
