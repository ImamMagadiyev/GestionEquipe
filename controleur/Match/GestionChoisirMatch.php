<?php
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php'; // Vérifie la session
require_once __DIR__ . '/../../vue/Match/choisirMatchVue.php';

// DAO Match
$daoMatch = new DaoMatch($pdo);
$matches = $daoMatch->findFuturs();  // Affiche uniquement les matchs à venir


