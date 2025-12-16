<?php

require_once __DIR__ . '/../../modele/Match_.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequeteMatch.php';
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php'; 


// Utiliser $pdo au lieu de $linkpdo
$dao = new DaoMatch($pdo);  // Utilisation correcte de $pdo qui est défini dans pdo.php
$matchs = $dao->findAll();  // Récupérer les matchs
?>
