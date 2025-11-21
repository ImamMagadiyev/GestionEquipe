<?php 
    require '../../bd/pdo.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stmt = $linkpdo -> prepare("INSERT INTO Joueur (id_joueur, nom, prenom, num_license, date_naissance, taille, poids, statut, poste_prefere)
        VALUES (:id, :nom, :prenom, :num_license, :date_naissance, :taille, :poids, :statut, :poste_prefere) ");
        $stmt -> execute([
            'id' => uniqid(),
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'num_license' => $_POST['num_license'],
            'date_naissance' => $_POST['date_naissance'],
            'taille' => $_POST['taille'],
            'poids' => $_POST['poids'],
            'statut' => $_POST['statut'],
            'poste_prefere' => $_POST['poste_prefere']
        ]);
        header("Location: liste.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajouter un joueur</title>
    </head>
    <body>
        <h1>Ajouter un joueur</h1>
        <form method="post">
            Nom : <input type="text" name="nom" required><br>
            Prénom : <input type="text" name="prenom" required><br>
            Numéro de license : <input type="text" name="num_license" required><br>
            Date de naissance : <input type="date" name="date_naissance"><br>
            Taille : <input type="text" step="0.01" name="taille"><br>
            Poids : <input type="number" step="0.01" name="poids"><br>
            Statut : <input type="texte" name="statut"><br>
            Poste préféré : <input type="texte" name="poste_prefere"><br>
            <input type="submit" value="ajouter">
        </form>
        <a href="liste.php">Retour à la liste</a>
    </body>
</html>
