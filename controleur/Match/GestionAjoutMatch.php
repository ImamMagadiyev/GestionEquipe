<?php
require_once __DIR__ . '/../../modele/Match_.php';
require_once __DIR__ . '/../../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../../modele/dao/requetes/RequeteMatch.php';
require_once __DIR__ . '/../../bd/pdo.php'; 

$success = '';
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dateMatch = new DateTime($_POST['date'] ?? 'now');
        $maintenant = new DateTime();
        $maintenant->setTime(0, 0, 0);
        $dateMatch->setTime(0, 0, 0);

        // Pour match passé, résultat obligatoire
        $estMatchPasse = $dateMatch < $maintenant;
        if ($estMatchPasse && empty($_POST['resultat'])) {
            $erreur = "Le résultat est obligatoire pour un match terminé !";
        } else {
            $match = new Match_(
                uniqid(),
                $_POST['date'] ?? null,
                $_POST['heure'] ?? null,
                $_POST['adversaire'] ?? null,
                $_POST['logo_adversaire'] ?? null,
                $_POST['lieu'] ?? null,
                $estMatchPasse ? ($_POST['resultat'] ?? null) : null
            );

            $dao = new DaoMatch($pdo);
            if ($dao->create($match)) {
                $success = "Match créé avec succès !";
            } else {
                $erreur = "Erreur lors de la création du match";
            }
        }
    } catch (Exception $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
}
?>
