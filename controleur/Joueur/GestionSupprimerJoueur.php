<?php
require_once __DIR__ . '/../../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../../bd/pdo.php';
require_once __DIR__ . '/../../connexion/verificationConnexion.php';

$dao = new DaoJoueur($pdo);
$id = $_GET['id'] ?? '';
$joueur = $dao->findById($id);

if ($joueur && $dao->peutSupprimer($joueur)) {
    $dao->delete($joueur);
    header("Location: ../../vue/Joueur/liste.php?msg=ok");
    exit;
} else {
    header("Location: ../../vue/Joueur/liste.php?msg=error");
    exit;
}
