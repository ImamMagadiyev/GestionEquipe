<?php
require_once __DIR__ . '/../bd/pdo.php';
require_once __DIR__ . '/../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../modele/dao/DaoParticiper.php';
require_once __DIR__ . '/../connexion/verificationConnexion.php';

$daoMatch = new DaoMatch($pdo);
$daoJoueur = new DaoJoueur($pdo);
$daoParticiper = new DaoParticiper($pdo);

// Statistiques globales
$stats = $daoMatch->getGlobalStats(); 

// Récupérer tous les joueurs
$joueurs = $daoJoueur->findAll();

// Statistiques par joueur
$statsJoueurs = [];
foreach ($joueurs as $joueur) {
    $statsJoueurs[$joueur->getIdJoueur()] = [
        'joueur' => $joueur,
        'stats' => $daoParticiper->getStatistiquesJoueur($joueur->getIdJoueur())
    ];
}

require __DIR__ . '/../vue/statistiques.php';
exit;
