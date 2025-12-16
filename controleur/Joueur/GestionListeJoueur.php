<?php

require_once __DIR__ . '/../../modele/Joueur.php';
require_once __DIR__ . '/../../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequetesJoueur.php';
require_once __DIR__ . '/../../bd/pdo.php';  // Assure-toi d'inclure pdo.php ici
require_once __DIR__ . '/../../connexion/verificationConnexion.php'; 

// Utiliser $pdo au lieu de $linkpdo
$dao = new DaoJoueur($pdo);  // Ici, on passe $pdo qui est défini dans pdo.php
$joueurs = $dao->findAll(); 

?>
