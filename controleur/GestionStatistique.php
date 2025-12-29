<?php
require_once __DIR__ . '/../bd/pdo.php';
require_once __DIR__ . '/../modele/dao/DaoMatch.php';
// Correction de l'orthographe "verification"
require_once __DIR__ . '/../connexion/verificationConnexion.php';

$daoMatch = new DaoMatch($pdo);

// Vérifie bien si tu as mis un 's' à la fin de la fonction dans ton DAO
$stats = $daoMatch->getGlobalStats(); 

require __DIR__ . '/../vue/statistiques.php';
exit;
