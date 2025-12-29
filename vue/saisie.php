<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/GestionEquipe/menu.php'; 
$logoAdversaire = $match->getLogoAdversaire(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feuille de match - <?= htmlspecialchars($match->getAdversaire()) ?></title>
    <link rel="stylesheet" href="/GestionEquipe/style.css">
</head>
<body>

<div class="page-container">
    <!-- Header du match -->
    <div class="match-header-banner">
        <div class="match-header-content">
            <div class="match-header-team">
                <img src="/GestionEquipe/Assets/logo.png" alt="Mon Équipe" class="match-header-logo">
                <span class="match-header-name">Mon Équipe</span>
            </div>
            
            <div class="match-header-vs">
                <span class="vs-text">VS</span>
                <span class="match-header-date"><?= date("d/m/Y", strtotime($match->getDate())) ?></span>
            </div>
            
            <div class="match-header-team">
                <?php if($logoAdversaire): ?>
                <img src="/GestionEquipe/<?= htmlspecialchars($logoAdversaire) ?>" alt="<?= htmlspecialchars($match->getAdversaire()) ?>" class="match-header-logo">
                <?php else: ?>
                <div class="match-header-logo-placeholder">?</div>
                <?php endif; ?>
                <span class="match-header-name"><?= htmlspecialchars($match->getAdversaire()) ?></span>
            </div>
        </div>
    </div>

    <div class="page-header">
        <div>
            <h1>📋 Feuille de match</h1>
            <p class="text-muted">Sélectionnez les joueurs et leurs postes</p>
        </div>
        <a href="/GestionEquipe/vue/Match/choisir_match.php" class="btn-retour">← Retour</a>
    </div>

    <?php
    $error = $error ?? '';
    $success = $success ?? '';
    ?>
    
    <?php if($error): ?>
        <div class="flash-message error">
            <span>⚠️ <?= htmlspecialchars($error) ?></span>
        </div>
    <?php elseif($success): ?>
        <div class="flash-message success">
            <span>✓ <?= htmlspecialchars($success) ?></span>
        </div>
    <?php endif; ?>

    <div class="saisie-info">
        <div class="info-card">
            <span class="info-icon">ℹ️</span>
            <span>Vous devez sélectionner <strong>au moins 7 joueurs</strong> (titulaires ou remplaçants)</span>
        </div>
    </div>

    <form method="post">
        <div class="table-wrapper">
            <table class="table-match-2 table-saisie">
                <thead>
                    <tr>
                        <th>Joueur</th>
                        <th>Poste</th>
                        <th>Rôle</th>
                        <th>Commentaire</th>
                        <th>Caractéristiques</th>
                        <th>Historique récent</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($joueursActifs as $j):
                    $p = $daoParticiper->findByJoueurEtMatch($j->getIdJoueur(), $id_match);
                    $historique = $daoParticiper->findHistoriqueByJoueur($j->getIdJoueur());
                    $rowClass = '';
                    if ($p) {
                        $rowClass = $p->getTitulaireRemplacant() === 'titulaire' ? 'titulaire' : 
                                   ($p->getTitulaireRemplacant() === 'remplacant' ? 'remplacant' : '');
                    }
                ?>
                    <tr class="<?= $rowClass ?>">
                        <td>
                            <div class="player-info">
                                <span class="player-avatar"><?= strtoupper(substr($j->getPrenom(), 0, 1) . substr($j->getNom(), 0, 1)) ?></span>
                                <div>
                                    <strong><?= htmlspecialchars($j->getNom()) ?></strong>
                                    <span class="player-firstname"><?= htmlspecialchars($j->getPrenom()) ?></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <select name="joueur[<?= $j->getIdJoueur() ?>][poste]" class="select-poste">
                                <option value="">--</option>
                                <option value="gardien" <?= $p && $p->getPoste() === 'gardien' ? 'selected' : '' ?>>🧤 Gardien</option>
                                <option value="defenseur" <?= $p && $p->getPoste() === 'defenseur' ? 'selected' : '' ?>>🛡️ Défenseur</option>
                                <option value="milieu" <?= $p && $p->getPoste() === 'milieu' ? 'selected' : '' ?>>⚙️ Milieu</option>
                                <option value="attaquant" <?= $p && $p->getPoste() === 'attaquant' ? 'selected' : '' ?>>⚡ Attaquant</option>
                            </select>
                        </td>
                        <td>
                            <select name="joueur[<?= $j->getIdJoueur() ?>][titulaire_remplacant]" class="select-role">
                                <option value="">--</option>
                                <option value="titulaire" <?= $p && $p->getTitulaireRemplacant() === 'titulaire' ? 'selected' : '' ?>>✅ Titulaire</option>
                                <option value="remplacant" <?= $p && $p->getTitulaireRemplacant() === 'remplacant' ? 'selected' : '' ?>>🔄 Remplaçant</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="joueur[<?= $j->getIdJoueur() ?>][commentaire]" value="" placeholder="Note...">
                        </td>
                        <td class="caracteristiques">
                            <div class="carac-item">
                                <span class="carac-label">Taille</span>
                                <span class="carac-value"><?= htmlspecialchars($j->getTaille()) ?: '-' ?></span>
                            </div>
                            <div class="carac-item">
                                <span class="carac-label">Poids</span>
                                <span class="carac-value"><?= $j->getPoids() ? htmlspecialchars($j->getPoids()) . 'kg' : '-' ?></span>
                            </div>
                        </td>
                        <td>
                            <?php if(count($historique) > 0): ?>
                            <ul class="historique-list">
                            <?php foreach(array_slice($historique, 0, 3) as $h): ?>
                                <li>
                                    <span class="hist-adversaire"><?= htmlspecialchars($h['adversaire']) ?></span>
                                    <span class="hist-date"><?= date('d/m', strtotime($h['date_match'])) ?></span>
                                    <?php if(isset($h['resultat']) && $h['resultat'] !== ''): ?>
                                    <span class="hist-score"><?= htmlspecialchars($h['resultat']) ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                            <?php else: ?>
                            <span class="text-muted">Aucun historique</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="form-actions-sticky">
            <a href="/GestionEquipe/vue/Match/choisir_match.php" class="btn-retour">Annuler</a>
            <input type="submit" value="✓ Valider la feuille de match">
        </div>
    </form>
</div>

</body>
</html>
