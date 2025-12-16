<?php include $_SERVER['DOCUMENT_ROOT'] . '/GestionEquipe/menu.php'; ?>

<?php
// Definit les chemins pour afficher le logo
$repertoireLogos = '../Assets/clubs';
$logoAdversaire = $match->getLogoAdversaire() ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Feuille de match</title>
    <link rel="stylesheet" href="/GestionEquipe/style.css">
</head>
<body>

<main>
    <h1>Préparer le match contre <?= htmlspecialchars($match->getAdversaire()) ?></h1>

    <?php
    $error = $error ?? '';
    $success = $success ?? '';
    ?>
    
    <?php if($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php elseif($success): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <table class="table-match-2">
            <thead>
                <tr>
                    <th>Joueur</th>
                    <th>Poste</th>
                    <th>Titulaire/Remplaçant</th>
                    <th>Commentaire</th>
                    <th>Taille</th>
                    <th>Poids</th>
                    <th>Historique</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($joueursActifs as $j):
                $p = $daoParticiper->findByJoueurEtMatch($j->getIdJoueur(), $id_match);
                $historique = $daoParticiper->findHistoriqueByJoueur($j->getIdJoueur());
            ?>
                <tr class="<?= $p && $p->getTitulaireRemplacant() === 'titulaire' ? 'titulaire' : ($p && $p->getTitulaireRemplacant() === 'remplacant' ? 'remplacant' : '') ?>">
                    <td><?= htmlspecialchars($j->getNom().' '.$j->getPrenom()) ?></td>
                    <td>
                        <select name="joueur[<?= $j->getIdJoueur() ?>][poste]">
                            <option value="">--</option>
                            <option value="gardien" <?= $p && $p->getPoste() === 'gardien' ? 'selected' : '' ?>>Gardien</option>
                            <option value="defenseur" <?= $p && $p->getPoste() === 'defenseur' ? 'selected' : '' ?>>Défenseur</option>
                            <option value="milieu" <?= $p && $p->getPoste() === 'milieu' ? 'selected' : '' ?>>Milieu</option>
                            <option value="attaquant" <?= $p && $p->getPoste() === 'attaquant' ? 'selected' : '' ?>>Attaquant</option>
                        </select>
                    </td>
                    <td>
                        <select name="joueur[<?= $j->getIdJoueur() ?>][titulaire_remplacant]">
                            <option value="">--</option>
                            <option value="titulaire" <?= $p && $p->getTitulaireRemplacant() === 'titulaire' ? 'selected' : '' ?>>Titulaire</option>
                            <option value="remplacant" <?= $p && $p->getTitulaireRemplacant() === 'remplacant' ? 'selected' : '' ?>>Remplaçant</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="joueur[<?= $j->getIdJoueur() ?>][commentaire]" value="">
                    </td>
                    <td><?= htmlspecialchars($j->getTaille()) ?></td>
                    <td><?= htmlspecialchars($j->getPoids()) ?></td>
                    <td>
                        <ul>
                        <?php foreach($historique as $h): ?>
                            <li>
                                | Adversaire : <?= htmlspecialchars($h['adversaire']) ?> <br>
                                | Date : <?= $h['date_match'] ?> <br>
                                <?= isset($h['resultat']) && $h['resultat'] !== '' ? '| Score : '.$h['resultat'] : '' ?>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <input type="submit" value="Valider la feuille de match">
    </form>
</main>

</body>
</html>
