<?php

require_once __DIR__ . '/../../modele/Match_.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequeteMatch.php';
require_once __DIR__ . '/../../bd/pdo.php'; 

$dao = new DaoMatch($linkpdo);

$id = $_GET['id'] ?? '';

$match = $dao->findById($id);
if ($match) {
    $dao->delete($match);
}

header("Location: liste.php");
exit;
?>
