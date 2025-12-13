<?php

require_once __DIR__ . '/../../modele/Joueur.php';
require_once __DIR__ . '/../../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequetesJoueur.php';
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php'; 

$dao = new DaoJoueur($linkpdo);
$joueurs = $dao->findAll(); 

?>
