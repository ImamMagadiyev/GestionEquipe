<?php 
$total = $stats['total'] ?? 0;
$victoires = $stats['victoires'] ?? 0;
$nuls = $stats['nuls'] ?? 0;
$defaites = $stats['defaites'] ?? 0;

$pourcentage = ($total > 0) ? round(($victoires / $total) * 100, 1) : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Mon Équipe</title>
    <link rel="stylesheet" href="/GestionEquipe/style.css">
</head>
<body class="stats-page">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/GestionEquipe/menu.php'; ?>

    <main class="container-stat">
        <div class="stats-header">
            <h1 class="main-title">📊 Statistiques de la Saison</h1>
            <p class="stats-subtitle">Vue d'ensemble des performances de l'équipe</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card card-blue">
                <div class="stat-icon">📅</div>
                <div class="stat-data">
                    <span class="stat-number"><?= $total ?></span>
                    <span class="stat-label">Matchs Joués</span>
                </div>
            </div>

            <div class="stat-card card-green">
                <div class="stat-icon">🏆</div>
                <div class="stat-data">
                    <span class="stat-number"><?= $victoires ?></span>
                    <span class="stat-label">Victoires</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🤝</div>
                <div class="stat-data">
                    <span class="stat-number"><?= $nuls ?></span>
                    <span class="stat-label">Matchs Nuls</span>
                </div>
            </div>

            <div class="stat-card card-red">
                <div class="stat-icon">📉</div>
                <div class="stat-data">
                    <span class="stat-number"><?= $defaites ?></span>
                    <span class="stat-label">Défaites</span>
                </div>
            </div>

            <div class="stat-card card-gold highlight-card">
                <div class="stat-icon">📈</div>
                <div class="stat-data">
                    <span class="stat-number"><?= $pourcentage ?>%</span>
                    <span class="stat-label">Taux de Victoire</span>
                </div>
                <div class="stat-bar">
                    <div class="stat-bar-fill" style="width: <?= $pourcentage ?>%"></div>
                </div>
            </div>
        </div>

        <?php if ($total > 0): ?>
        <div class="stats-summary">
            <div class="summary-card">
                <h3>Résumé de la saison</h3>
                <div class="summary-content">
                    <div class="summary-item">
                        <span class="summary-label">Points gagnés</span>
                        <span class="summary-value"><?= ($victoires * 3) + $nuls ?></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Moyenne pts/match</span>
                        <span class="summary-value"><?= $total > 0 ? round((($victoires * 3) + $nuls) / $total, 2) : 0 ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLEAU DES STATISTIQUES PAR JOUEUR -->
        <section class="joueurs-stats-section">
            <div class="section-header">
                <h2>📋 Statistiques par Joueur</h2>
                <p class="section-subtitle">Détail des performances individuelles</p>
            </div>

            <?php if (!empty($statsJoueurs)): ?>
            <div class="table-wrapper">
                <table class="table-stats">
                    <thead>
                        <tr>
                            <th>👤 Joueur</th>
                            <th>🔴 Statut</th>
                            <th>⚽ Poste Meilleur</th>
                            <th>🏆 Titularisations</th>
                            <th>🔄 Remplacements</th>
                            <th>⭐ Éval. Moyenne</th>
                            <th>📊 Matchs Consécutifs</th>
                            <th>🎯 % Victoires</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($statsJoueurs as $idJoueur => $data): ?>
                            <?php 
                                $joueur = $data['joueur'];
                                $stats_joueur = $data['stats'];
                            ?>
                            <tr class="stat-row <?= $joueur->getStatut() === 'actif' ? 'actif' : 'inactif' ?>">
                                <td class="joueur-cell">
                                    <strong><?= htmlspecialchars($joueur->getPrenom() . ' ' . $joueur->getNom()) ?></strong>
                                </td>
                                <td class="statut-cell">
                                    <span class="badge-statut <?= strtolower($joueur->getStatut()) ?>">
                                        <?= htmlspecialchars($joueur->getStatut()) ?>
                                    </span>
                                </td>
                                <td class="poste-cell">
                                    <?= $stats_joueur['poste_meilleur'] ? htmlspecialchars($stats_joueur['poste_meilleur']) : '—' ?>
                                </td>
                                <td class="number-cell">
                                    <?= $stats_joueur['nb_titularisations'] ?>
                                </td>
                                <td class="number-cell">
                                    <?= $stats_joueur['nb_remplacements'] ?>
                                </td>
                                <td class="evaluation-cell">
                                    <span class="eval-badge">
                                        <?= $stats_joueur['evaluation_moyenne'] > 0 ? number_format($stats_joueur['evaluation_moyenne'], 2) : '—' ?>
                                    </span>
                                </td>
                                <td class="number-cell">
                                    <?= $stats_joueur['matchs_consecutifs'] ?>
                                </td>
                                <td class="percentage-cell">
                                    <div class="percentage-bar">
                                        <div class="percentage-fill" style="width: <?= $stats_joueur['pourcentage_victoires'] ?>%"></div>
                                        <span class="percentage-text"><?= $stats_joueur['pourcentage_victoires'] ?>%</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="empty-message">Aucun joueur enregistré.</p>
            <?php endif; ?>
        </section>
        <?php endif; ?>

    </main>
</body>
</html>
