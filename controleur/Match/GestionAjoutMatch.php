<?php
require_once __DIR__ . '/../../modele/Match_.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequeteMatch.php';
require_once __DIR__ . '/../../bd/pdo.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $match = new Match_(
        uniqid(),
        $_POST['date'] ?? null,
        $_POST['heure'] ?? null,
        $_POST['adversaire'] ?? null,
        $_POST['lieu'] ?? null,
        $_POST['resultat'] ?? null
    );

    $dao = new DaoMatch($linkpdo);
    $dao->create($match);

    header("Location: liste.php");
    exit;
}
?>
