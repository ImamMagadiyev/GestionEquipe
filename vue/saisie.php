<?php 
    include '../connexion/verificationConnexion.php';
    include '../menu.php';
    require_once '../controleur/GestionSaisieMatch.php'; 
    
?>

<?php 
require_once __DIR__ . '/../connexion/verificationConnexion.php';
require_once __DIR__ . '/../controleur/GestionSaisieMatch.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Feuille de match</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php if(!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <h1>Préparer le match contre <?= htmlspecialchars($match->getAdversaire()) ?></h1>

    <form method="post">
        <table class="table-match-2">
            <thead>
                <tr>
                    <th>Joueur</th>
                    <th>Poste</th>
                    <th>Titulaire/Remplaçant</th>
                    <th>Évaluation</th>
                    <th>Historique</th>
                    <th>Taille</th>
                    <th>Poids</th>
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
                <td><input type="number" min="0" max="10" name="joueur[<?= $j->getIdJoueur() ?>][evaluation]" value="<?= $p ? htmlspecialchars($p->getEvaluation()) : '' ?>"></td>
               <td>
    <ul>
    <?php foreach($historique as $h): ?>
        <li>
            Évaluation : <?= $h['evaluation'] !== null ? $h['evaluation'] : '--' ?>  <br>
            | Adversaire : <?= htmlspecialchars($h['adversaire']) ?>  <br>
            | Date : <?= $h['date_match'] ?>  
            <?= isset($h['resultat']) && $h['resultat'] !== '' ? '| Score : '.$h['resultat'] : '' ?>
        </li>
    <?php endforeach; ?>
    </ul>
</td>


                <td><?= htmlspecialchars($j->getTaille()) ?></td>
                <td><?= htmlspecialchars($j->getPoids()) ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <input type="submit" value="Valider la feuille de match">
    </form>

</body>
</html>
