<?php
// Inclure les fichiers nécessaires
require 'connexion/verificationConnexion.php';
include 'menu.php';
include 'modele/Dao/DaoMatch.php';  // Inclure le DAO pour les matchs

// Connexion PDO (assure-toi que tu inclues le fichier de connexion PDO)
require_once 'bd/pdo.php';

// Créer un objet de DaoMatch en passant la connexion PDO
$daoMatch = new DaoMatch($pdo);

// Utiliser la méthode findAll() pour récupérer les matchs programmés (ceux à venir)
$matchs = $daoMatch->findAll();  // Cette méthode retourne les matchs dont la date est > NOW()

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="style.css">
</head> 
<body>

<section class="hero-section">
    <div class="hero-content-box">
        <h1>Bienvenue au Club</h1>
        <p>Plus q'une équipe, une passion.</p> 
    </div>   
</section>

<section class="prochains-matchs">
    <h2>Prochains matchs</h2>
    <?php if(count($matchs) > 0): ?>
        
        <div class="match-list"> <?php foreach($matchs as $match): ?>
                <div class="match-item">
                    <p class="match-date-heure"><?= date("d/m/Y", strtotime($match->getDate())); ?> à <?= $match->getHeure() ? substr($match->getHeure(), 0, 5) : 'heure non définie' ?></p>
                    
                    <div class="match-teams">
                        <div class="team equipe-locale">
                            <img src="Assets/logo.png" alt="Logo Mon Équipe" class="team-logo">
                            <span class="team-name">Mon Équipe</span>
                        </div>
                        
                        <span class="vs-separator">VS</span>
                        
                        <div class="team equipe-adversaire">
                            <img src="<?= htmlspecialchars($match->getLogoAdversaire()); ?>" alt="logo adversaire" class="team-logo">
                            <span class="team-name"><?= htmlspecialchars($match->getAdversaire()); ?></span>
                        </div>
                    </div>
                    
                    <p class="match-details">Lieu: <?= htmlspecialchars($match->getLieu()); ?></p>
                    
                    <div class="match-actions">
                        <a href="controleur/GestionSaisieMatch.php?id=<?= $match->getIdMatch() ?>" class="btn-prepare">
                            Préparer le match
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <p>Aucun match programmé pour le moment.</p>
    <?php endif; ?>
</section>
</body>
</html>
