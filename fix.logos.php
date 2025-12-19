<?php

require_once 'bd/pdo.php';

$prefixe_correct = 'Assets/clubs/';
$extension = '.png';

$sql = "UPDATE Match_
        SET logo_adversaire = CONCAT(:prefixe, logo_adversaire, :extension)
        WHERE logo_adversaire IS NOT NULL
        AND logo_adversaire NOT LIKE :prefixe_like";

try {
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':prefixe', $prefixe_correct);
    $stmt->bindValue(':extension', $extension);
    $stmt->bindValue(':prefixe_like', $prefixe_correct . '%'); 
    
    $stmt->execute();
    
    $lignes_modifiees = $stmt->rowCount();
    
    echo "<h1>✅ Correction des Logos Terminée !</h1>";
    echo "<p>$lignes_modifiees lignes de logos existants ont été corrigées pour avoir le chemin complet.</p>";
    echo "<p>Vérifiez maintenant votre page d'accueil (index.php).</p>";

} catch (PDOException $e) {
    echo "<h2>❌ Erreur de mise à jour :</h2>";
    echo "<p>Message : " . $e->getMessage() . "</p>";
}
?>
