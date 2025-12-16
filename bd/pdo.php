<?php
// Configuration de la connexion PDO
$server = 'localhost';  // Serveur de la base de données
$login = 'root';  // Nom d'utilisateur
$mdp = '';  // Mot de passe (vide pour XAMPP en local)
$db = 'ProjetFoot';  // Nom de la base de données

try {
    // Créer une connexion PDO
    $pdo = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $login, $mdp);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Gérer les erreurs
} catch (PDOException $e) {
    // Si la connexion échoue, afficher une erreur
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
?>
