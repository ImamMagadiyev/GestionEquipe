<?php
include '../../menu.php';
require_once __DIR__ . '/../../controleur/Joueur/GestionListeJoueur.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des joueurs - Mon Équipe</title>
    <link rel="stylesheet" href="../../style.css"> 
</head>
<body>

<?php
$msg = '';
$type = 'success';

if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'ok') {
        $msg = '✓ Le joueur a été supprimé avec succès';
        $type = 'success';
    } else {
        $msg = '⚠ Impossible de supprimer un joueur ayant déjà participé à au moins un match';
        $type = 'error';
    }
}
?>

<?php if ($msg): ?>
<div class="flash-message <?= htmlspecialchars($type) ?>">
    <span><?= htmlspecialchars($msg) ?></span>
    <a href="liste.php" class="close-btn">&times;</a>
</div>
<?php endif; ?>

<div class="page-container">
    <div class="page-header">
        <div>
            <h1>👥 Liste des joueurs</h1>
            <p class="text-muted"><?= count($joueurs) ?> joueur(s) enregistré(s)</p>
        </div>
        <a href="ajout.php" class="btn-ajouter">+ Ajouter un joueur</a>
    </div>

    <div class="table-wrapper">
        <table class="table-match-2">
            <thead>
                <tr>
                    <th>Joueur</th>
                    <th>N° Licence</th>
                    <th>Date naissance</th>
                    <th>Taille</th>
                    <th>Poids</th>
                    <th>Statut</th>
                    <th>Poste</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($joueurs)): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted" style="padding: 3rem;">
                        Aucun joueur enregistré. <a href="ajout.php">Ajouter un joueur</a>
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach($joueurs as $j): ?>
                <tr>
                    <td>
                        <div class="player-info">
                            <span class="player-avatar"><?= strtoupper(substr($j->getPrenom(), 0, 1) . substr($j->getNom(), 0, 1)) ?></span>
                            <div>
                                <strong><?= htmlspecialchars($j->getNom()) ?></strong>
                                <span class="player-firstname"><?= htmlspecialchars($j->getPrenom()) ?></span>
                            </div>
                        </div>
                    </td>
                    <td><code><?= htmlspecialchars($j->getNumLicense()) ?></code></td>
                    <td><?= $j->getDateNaissance() ? date('d/m/Y', strtotime($j->getDateNaissance())) : '-' ?></td>
                    <td><?= htmlspecialchars($j->getTaille()) ?: '-' ?></td>
                    <td><?= $j->getPoids() ? htmlspecialchars($j->getPoids()) . ' kg' : '-' ?></td>
                    <td>
                        <?php 
                        $statut = $j->getStatut();
                        $statusClass = match($statut) {
                            'actif' => 'status-success',
                            'blessé' => 'status-warning',
                            'suspendu' => 'status-danger',
                            default => 'status-muted'
                        };
                        ?>
                        <span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statut) ?: 'Non défini' ?></span>
                    </td>
                    <td><?= htmlspecialchars($j->getPostePrefere()) ?: '-' ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="modifier.php?id=<?= $j->getIdJoueur() ?>" class="action-btn edit-btn">Modifier</a>
                            <a href="supprimer.php?id=<?= $j->getIdJoueur() ?>" class="action-btn delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ?')">Supprimer</a>
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
