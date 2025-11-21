<?php 
    include '../../menu.php';
    require '../../bd/pdo.php';
    require '../../connexion/verificationConnexion.php';
    
    $stmt = $linkpdo->query("SELECT * FROM Joueur");
    $joueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des joueurs</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>
        <h1>Liste des joueurs</h1>
        <a href="ajout.php">Ajouter un joueur</a>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Numéro license</th>
                <th>Date naissance</th>
                <th>Taille</th>
                <th>Poids</th>
                <th>Statut</th>
                <th>Poste préféré</th>
            </tr>
            <?php foreach($joueurs as $j): ?>
            <tr>
                <td><?= htmlspecialchars($j['nom']) ?></td>
                <td><?= htmlspecialchars($j['prenom']) ?></td>
                <td><?= htmlspecialchars($j['num_license']) ?></td>
                <td><?= htmlspecialchars($j['date_naissance']) ?></td>
                <td><?= htmlspecialchars($j['taille']) ?></td>
                <td><?= htmlspecialchars($j['poids']) ?></td>
                <td><?= htmlspecialchars($j['statut']) ?></td>
                <td><?= htmlspecialchars($j['poste_prefere']) ?></td>

                <td>
                    <a href="modifier.php?id=<?= $j['id_joueur'] ?>">Modifier</a> |
                    <a href="supprimer.php?id=<?= $j['id_joueur'] ?>" onclick="return confirm('Supprimer ce joueur ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
