<?php
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../modele/dao/DaoParticiper.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php';

$daoMatch = new DaoMatch($pdo);
$daoParticiper = new DaoParticiper($pdo);
$matches = $daoMatch->findFuturs();  // Affiche uniquement les matchs à venir

// Vérifier quels matchs sont préparés
$matchsPrepa = [];
foreach($matches as $m) {
    $participations = $daoParticiper->findAllByMatch($m->getIdMatch());
    $matchsPrepa[$m->getIdMatch()] = count($participations) >= 11;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préparer un match - Mon Équipe</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php require '../../menu.php'; ?>

    <div class="page-container">
        <div class="page-header">
            <div>
                <h1>⚽ Préparer un match</h1>
                <p class="text-muted">Sélectionnez le match à préparer</p>
            </div>
        </div>

        <?php if(empty($matches)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📅</div>
                <h3>Aucun match disponible</h3>
                <p>Commencez par créer un match pour pouvoir le préparer.</p>
                <a href="ajout.php" class="btn-ajouter">+ Créer un match</a>
            </div>
        <?php else: ?>
            <div class="match-cards-grid">
                <?php foreach ($matches as $match): ?>
                    <div class="match-card-select">
                        <div class="match-card-header">
                            <span class="match-card-date">
                                <?= date('d/m/Y', strtotime($match->getDate())) ?>
                            </span>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <span class="status-badge <?= $match->getStatut() === 'à venir' ? 'status-info' : 'status-success' ?>">
                                    <?= htmlspecialchars($match->getStatut()) ?>
                                </span>
                                <?php if($matchsPrepa[$match->getIdMatch()]): ?>
                                <span style="background: #22c55e; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">✅ Préparé</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="match-card-body">
                            <?php if($match->getLogoAdversaire()): ?>
                            <img src="../../<?= htmlspecialchars($match->getLogoAdversaire()) ?>" alt="" class="match-card-logo">
                            <?php else: ?>
                            <div class="match-card-logo-placeholder">VS</div>
                            <?php endif; ?>
                            
                            <h3 class="match-card-adversaire"><?= htmlspecialchars($match->getAdversaire()) ?: 'Adversaire non défini' ?></h3>
                            
                            <p class="match-card-lieu">
                                <?php 
                                $lieu = $match->getLieu();
                                echo $lieu === 'Domicile' ? '🏠' : ($lieu === 'Extérieur' ? '✈️' : '📍');
                                echo ' ' . htmlspecialchars($lieu ?: 'Lieu non défini');
                                ?>
                            </p>
                        </div>
                        
                        <div class="match-card-footer">
                            <a href="/GestionEquipe/controleur/GestionSaisieMatch.php?id=<?= $match->getIdMatch() ?>" class="btn-prepare-full">
                                Préparer ce match →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
