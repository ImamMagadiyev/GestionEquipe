<?php
    require '../../bd/pdo.php';
    $stmt = $linkpdo->query("SELECT * FROM Joueurs");
    $joueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des joueurs</title>
        <style>
            table { border-collapse: collapse; width: 50%; }
            th, td { border: 1px solid black; padding: 5px; text-align: left; }
        </style>
    </head>
    <body>
        <h1> Liste des joueurs</h1>
        <table>
            <?php foreach($joueurs as $j): ?>
        <tr>
            <td><?= htmlspecialchars($j['nom']) ?></td>
            <td><?= htmlspecialchars($j['prenom']) ?></td>
            <td><?= htmlspecialchars($j['statut']) ?></td>
        </tr>
        <?php endforeach; ?></table>
    </body>
</html>
