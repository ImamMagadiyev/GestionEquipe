<?php

require_once __DIR__ . '/../../modele/Joueur.php';
require_once __DIR__ . '/../../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequetesJoueur.php';
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php';

$dao = new DaoJoueur($linkpdo);

// Récupération de l'id
$id = $_GET['id'] ?? '';

$joueur = $dao->findById($id);
if (!$joueur) {
    echo "Joueur introuvable";
    exit;
}

// Si formulaire POST, on met à jour le joueur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $joueurModifie = new Joueur(
        $id,
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['num_license'],
        $_POST['date_naissance'] ?? null,
        $_POST['taille'] ?? null,
        isset($_POST['poids']) ? (float)$_POST['poids'] : null,
        $_POST['statut'] ?? null,
        $_POST['poste_prefere'] ?? null
    );

    $dao->update($joueurModifie);

    header("Location: liste.php");
    exit;
}
