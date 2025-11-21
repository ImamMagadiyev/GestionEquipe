<?php

require_once __DIR__ . '/../../modele/Match_.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequeteMatch.php';
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php'; 

$dao = new DaoMatch($linkpdo);
$matchs = $dao->findAll(); 
?>
