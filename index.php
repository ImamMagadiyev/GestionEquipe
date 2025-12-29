<?php
require 'connexion/verificationConnexion.php';
include 'menu.php';
include 'modele/Dao/DaoMatch.php';  
require_once 'bd/pdo.php';

$daoMatch = new DaoMatch($pdo);
$matchs = $daoMatch->findAll();  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Équipe - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head> 
<body>

<section class="hero-section">
    <div class="hero-content-box">
        <div class="hero-badge">⚽ Saison 2024-2025</div>
        <h1>Bienvenue au Club</h1>
        <p>Plus qu'une équipe, une passion.</p>
        <div class="hero-actions">
            <a href="vue/Match/choisir_match.php" class="btn-hero-primary">Préparer un match</a>
            <a href="vue/Joueur/liste.php" class="btn-hero-secondary">Voir l'effectif</a>
        </div>
    </div>   
</section>

<section class="prochains-matchs">
    <div class="section-header">
        <h2>⚡ Prochains matchs</h2>
        <a href="vue/Match/liste.php" class="link-voir-tout">Voir tous les matchs →</a>
    </div>
    
    <?php if(count($matchs) > 0): ?>
        <div class="match-list">
            <?php foreach($matchs as $match): ?>
                <div class="match-item">
                    <div class="match-status-ribbon <?= $match->getStatut() === 'à venir' ? 'status-upcoming' : 'status-done' ?>">
                        <?= htmlspecialchars($match->getStatut()) ?>
                    </div>
                    
                    <p class="match-date-heure">
                        📅 <?= date("d/m/Y", strtotime($match->getDate())); ?> 
                        • 
                        🕐 <?= $match->getHeure() ? substr($match->getHeure(), 0, 5) : 'Heure TBD' ?>
                    </p>
                    
                    <div class="match-teams">
                        <div class="team equipe-locale">
                            <img src="Assets/logo.png" alt="Logo Mon Équipe" class="team-logo">
                            <span class="team-name">Mon Équipe</span>
                        </div>
                        
                        <div class="vs-container">
                            <span class="vs-separator">VS</span>
                            <?php if($match->getResultat()): ?>
                            <span class="match-score"><?= htmlspecialchars($match->getResultat()) ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="team equipe-adversaire">
                            <?php if($match->getLogoAdversaire()): ?>
                            <img src="<?= htmlspecialchars($match->getLogoAdversaire()); ?>" alt="logo adversaire" class="team-logo">
                            <?php else: ?>
                            <div class="team-logo-placeholder">?</div>
                            <?php endif; ?>
                            <span class="team-name"><?= htmlspecialchars($match->getAdversaire()) ?: 'Adversaire TBD' ?></span>
                        </div>
                    </div>
                    
                    <p class="match-details">
                        <?php 
                        $lieu = $match->getLieu();
                        $lieuIcon = $lieu === 'Domicile' ? '🏠' : ($lieu === 'Extérieur' ? '✈️' : '📍');
                        ?>
                        <?= $lieuIcon ?> <?= htmlspecialchars($lieu) ?: 'Lieu à définir' ?>
                    </p>
                    
                    <div class="match-actions">
                        <a href="controleur/GestionSaisieMatch.php?id=<?= $match->getIdMatch() ?>" class="btn-prepare">
                            Préparer le match →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon">📅</div>
            <h3>Aucun match programmé</h3>
            <p>Commencez par créer votre premier match de la saison.</p>
            <a href="vue/Match/ajout.php" class="btn-ajouter">+ Créer un match</a>
        </div>
    <?php endif; ?>
</section>

<section class="quick-stats">
    <div class="quick-stats-container">
        <a href="vue/Joueur/liste.php" class="quick-stat-card">
            <span class="quick-stat-icon">👥</span>
            <span class="quick-stat-label">Effectif</span>
        </a>
        <a href="vue/Match/liste.php" class="quick-stat-card">
            <span class="quick-stat-icon">📅</span>
            <span class="quick-stat-label">Calendrier</span>
        </a>
        <a href="controleur/GestionStatistique.php" class="quick-stat-card">
            <span class="quick-stat-icon">📊</span>
            <span class="quick-stat-label">Statistiques</span>
        </a>
        <a href="vue/Match/choisir_match.php" class="quick-stat-card highlight">
            <span class="quick-stat-icon">⚽</span>
            <span class="quick-stat-label">Préparer</span>
        </a>
    </div>
</section>

</body>
</html>
