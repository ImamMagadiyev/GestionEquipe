<?php
require '../../bd/pdo.php';
$id = $_GET['id'] ?? '';
$stmt = $linkpdo->prepare("DELETE FROM Joueur WHERE id_joueur=:id");
$stmt->execute(['id'=>$id]);
header("Location: liste.php");
exit;
