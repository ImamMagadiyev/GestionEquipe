<?php
// Démarrer la session SI elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Supprimer toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header("Location: connexion.php");
exit;
?>
