<?php
include '../../menu.php';
require_once __DIR__ . '/../../controleur/Match/GestionListeMatch.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des matchs - Mon Équipe</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

<div class="page-container">
    <div class="page-header">
        <div>
            <h1>📅 Liste des matchs</h1>
            <p class="text-muted"><?= count($matchs) ?> match(s) programmé(s)</p>
        </div>
        <a href="ajout.php" class="btn-ajouter">+ Ajouter un match</a>
    </div>

    <div class="table-wrapper">
        <table class="table-match-2">
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
                <?php if (empty($matchs)): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted" style="padding: 3rem;">
                        Aucun match programmé. <a href="ajout.php">Ajouter un match</a>
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach($matchs as $m): ?>
                <tr>
                    <td>
                        <div class="date-display">
                            <span class="date-day"><?= date('d', strtotime($m->getDate())) ?></span>
                            <span class="date-month"><?= strftime('%b %Y', strtotime($m->getDate())) ?></span>
                        </div>
                    </td>
                    <td>
                        <code><?= $m->getHeure() ? substr($m->getHeure(), 0, 5) : '--:--' ?></code>
                    </td>
                    <td>
                        <div class="adversaire-info">
                            <?php if($m->getLogoAdversaire() && !empty($m->getLogoAdversaire())): ?>
                            <img src="../../<?= htmlspecialchars($m->getLogoAdversaire()) ?>" alt="Logo" class="mini-logo" style="max-width: 30px; height: auto;">
                            <?php endif; ?>
                            <strong><?= htmlspecialchars($m->getAdversaire()) ?: 'Non défini' ?></strong>
                        </div>
                    </td>
                    <td>
                        <?php 
                        $lieu = $m->getLieu();
                        $lieuIcon = $lieu === 'Domicile' ? '🏠' : ($lieu === 'Extérieur' ? '✈️' : '📍');
                        ?>
                        <span><?= $lieuIcon ?> <?= htmlspecialchars($lieu) ?: 'Non défini' ?></span>
                    </td>
                    <td>
                        <?php if($m->getResultat()): ?>
                        <span class="score-badge"><?= htmlspecialchars($m->getResultat()) ?></span>
                        <?php else: ?>
                        <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php 
                        $statut = $m->getStatut();
                        $statusClass = $statut === 'à venir' ? 'status-info' : 'status-success';
                        ?>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statut) ?></span>
                            <?php if($matchsPrepa[$m->getIdMatch()]): ?>
                            <span style="background: #22c55e; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">✅ Préparé</span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="modifier.php?id=<?= $m->getIdMatch() ?>" class="action-btn edit-btn">Modifier</a>
                            <a href="supprimer.php?id=<?= $m->getIdMatch() ?>" class="action-btn delete-btn">Supprimer</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
