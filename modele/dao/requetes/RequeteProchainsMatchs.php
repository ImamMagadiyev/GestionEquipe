<?php
// Inclure la classe RequeteMatch
require_once 'modele/Match_.php';

// Créer un objet RequeteMatch pour récupérer tous les matchs
$requeteMatch = new RequeteMatch('selectAll');

// Obtenez la requête SQL à exécuter
$sql = $requeteMatch->requete();

// Préparer la requête
$stmt = $pdo->prepare($sql);

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$matchs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher les matchs
foreach ($matchs as $match) {
    echo "Match: " . $match['equipe1'] . " vs " . $match['equipe2'] . " - Date: " . $match['date_match'] . "<br>";
}
?>
