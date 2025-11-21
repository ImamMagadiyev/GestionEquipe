<?php
require_once __DIR__ . '/../../modele/Match_.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequeteMatch.php';
require_once __DIR__ . '/../../bd/pdo.php'; 

$id = $_GET['id'] ?? '';
$dao = new DaoMatch($linkpdo);
$match = $dao->findById($id);

if (!$match) {
    echo "Match introuvable";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $match->setDate($_POST['date'] ?? null);
    $match->setHeure($_POST['heure'] ?? null);
    $match->setAdversaire($_POST['adversaire'] ?? null);
    $match->setLieu($_POST['lieu'] ?? null);
    $match->setResultat($_POST['resultat'] ?? null);

    $dao->update($match);

    header("Location: liste.php");
    exit;
}
?>
