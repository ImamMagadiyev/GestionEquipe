<?php
require 'bd/pdo.php'; // adapte le chemin si nécessaire

try {
    // Requête simple pour tester la connexion
    $stmt = $linkpdo->query("SELECT NOW() AS date_connexion");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Connexion réussie ! La base répond : " . $row['date_connexion'];
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
