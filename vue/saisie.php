<?php
require_once __DIR__ . '/../bd/pdo.php';
require_once __DIR__ . '/../modele/dao/DaoParticiper.php';
require_once __DIR__ . '/../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../connexion/verificationConnexion.php';
require_once '../menu.php';

// Récupération de l'ID du match
$id_match = $_GET['id'] ?? null;
if (!$id_match) {
    echo "Aucun match sélectionné. <a href='Match/choisir_match.php'>Choisir un match</a>";
    exit;
}

// Instanciation des DAO
$daoMatch = new DaoMatch($linkpdo);
$daoJoueur = new DaoJoueur($linkpdo);
$daoParticiper = new DaoParticiper($linkpdo);

// Récupération du match et des joueurs actifs
$match = $daoMatch->findById($id_match);
if (!$match) {
    echo "Match introuvable. <a href='Match/choisir_match.php'>Choisir un match</a>";
    exit;
}

$joueursActifs = $daoJoueur->findActifs();
$error = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $joueursValides = 0;

    foreach ($_POST['joueur'] as $id_joueur => $data) {
        if (!empty($data['titulaire_remplacant'])) {
            $joueursValides++;
        }

        $existing = $daoParticiper->findByJoueurEtMatch($id_joueur, $id_match);

        $p = new Participer(
            $existing ? $existing->getIdParticipant() : uniqid(),
            $id_joueur,
            $id_match,
            $data['poste'] ?? null,
            $data['evaluation'] ?? null,
            $data['titulaire_remplacant'] ?? null
        );

        if ($existing) {
            $daoParticiper->update($p);
        } else {
            $daoParticiper->create($p);
        }
    }

    if ($joueursValides < 7) { // Exemple : minimum 7 joueurs
        $error = "Vous devez sélectionner au moins 7 joueurs.";
    } else {
        header("Location: ../Match/liste.php");
        exit;
    }
}

// Récupération des participations existantes pour pré-remplir le formulaire
$participants = $daoParticiper->findAllByMatch($id_match);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Feuille de match</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Préparer le match contre <?= htmlspecialchars($match->getAdversaire()) ?></h1>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <table>
            <thead>
                <tr>
                    <th>Joueur</th>
                    <th>Poste</th>
                    <th>Titulaire/Remplaçant</th>
                    <th>Évaluation</th>
                    <th>Taille</th>
                    <th>Poids</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($joueursActifs as $j):
                    $p = $daoParticiper->findByJoueurEtMatch($j->getIdJoueur(), $id_match);
                ?>
                <tr>
                    <td><?= htmlspecialchars($j->getNom() . ' ' . $j->getPrenom()) ?></td>
                    <td><input type="text" name="joueur[<?= $j->getIdJoueur() ?>][poste]" value="<?= $p ? htmlspecialchars($p->getPoste()) : '' ?>"></td>
                    <td>
                        <select name="joueur[<?= $j->getIdJoueur() ?>][titulaire_remplacant]">
                            <option value="">--</option>
                            <option value="titulaire" <?= $p && $p->getTitulaireRemplacant() === 'titulaire' ? 'selected' : '' ?>>Titulaire</option>
                            <option value="remplacant" <?= $p && $p->getTitulaireRemplacant() === 'remplacant' ? 'selected' : '' ?>>Remplaçant</option>
                        </select>
                    </td>
                    <td><input type="text" name="joueur[<?= $j->getIdJoueur() ?>][evaluation]" value="<?= $p ? htmlspecialchars($p->getEvaluation()) : '' ?>"></td>
                    <td><?= htmlspecialchars($j->getTaille()) ?></td>
                    <td><?= htmlspecialchars($j->getPoids()) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="submit" value="Valider la feuille de match">
    </form>

    <a href="../Match/liste.php">Retour à la liste des matchs</a>
</body>
</html>
