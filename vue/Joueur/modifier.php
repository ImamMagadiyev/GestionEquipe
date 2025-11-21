<?php   
    require '../../bd/pdo.php';
    $id = $_GET['id']  ?? '';
    $stmt = $linkpdo -> prepare("SELECT * FROM Joueur WHERE id_joueur=:id");
    $stmt -> execute(['id' => $id]);
   $joueur = $stmt -> fetch(PDO::FETCH_ASSOC);
    if (!$joueur){
        echo "Joueur introuvable";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stmt = $linkpdo -> prepare ("UPDATE Joueur 
        SET nom=:nom, prenom=:prenom, num_license=:num_license, date_naissance=:date_naissance, taille=:taille, poids=:poids, statut=:statut, poste_prefere=:poste_prefere
        WHERE id_joueur=:id");
        $stmt -> execute([
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'num_license' => $_POST['num_license'],
            'date_naissance' => $_POST['date_naissance'],
            'taille' => $_POST['taille'],
            'poids' => $_POST['poids'],
            'statut' => $_POST['statut'],
            'poste_prefere' => $_POST['poste_prefere'],
            'id' => $id
        ]);
        header("Location: liste.php");
        exit;
    }
    ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Modifier un joueur</title>
    </head>
    <body>
        <form method="post">
            Nom : <input type="text" name="nom" value="<?= htmlspecialchars($joueur['nom'])?>"><br>
            Prénom : <input type="text" name="prenom" value="<?= htmlspecialchars($joueur['prenom'])?>"><br>
            Numéro de license : <input type="text" name="num_license" value="<?= htmlspecialchars($joueur['num_license'])?>"><br>
            Date de naissance : <input type="date" name="date_naissance" value="<?= htmlspecialchars($joueur['date_naissance'])?>"><br>
            Taille : <input type="text" step="0.01" name="taille" value="<?= htmlspecialchars($joueur['taille'])?>"><br>
            Poids : <input type="number" step="0.01" name="poids" value="<?= htmlspecialchars($joueur['poids'])?>"><br>
            Statut : <input type="texte" name="statut" value="<?= htmlspecialchars($joueur['statut'])?>"><br>
            Poste préféré : <input type="texte" name="poste_prefere" value="<?= htmlspecialchars($joueur['poste_prefere'])?>"><br>
            <input type="submit" value="ajouter">
        </form>
        <a href="liste.php">Retour à la liste</a>
    </body>
</html>
