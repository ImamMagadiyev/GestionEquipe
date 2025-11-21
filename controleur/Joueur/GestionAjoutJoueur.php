<?php

require_once __DIR__ . '/../../modele/Joueur.php';
require_once __DIR__ . '/../../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequetesJoueur.php';
require_once __DIR__ . '/../../bd/pdo.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $joueur = new Joueur(
        uniqid(),
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['num_license'],
        $_POST['date_naissance'] ?? null,
        $_POST['taille'] ?? null,
        isset($_POST['poids']) ? (float)$_POST['poids'] : null,
        $_POST['statut'] ?? null,
        $_POST['poste_prefere'] ?? null
    );

    $dao = new DaoJoueur($linkpdo);
    $dao->create($joueur);

    header("Location: liste.php");
    exit;
}
