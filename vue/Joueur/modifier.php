<?php
require_once __DIR__ . '/../../controleur/Joueur/GestionModifierJoueur.php';
require_once '../../menu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un joueur - Mon Équipe</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php require '../../menu.php'; ?>

<div class="page-container">
    <div class="page-header">
        <div>
            <h1>✏️ Modifier le joueur</h1>
            <p class="text-muted"><?= htmlspecialchars($joueur->getPrenom() . ' ' . $joueur->getNom()) ?></p>
        </div>
        <a href="liste.php" class="btn-retour">← Retour à la liste</a>
    </div>

    <form method="post" class="formulaire">
        <div class="form-section">
            <h3 class="form-section-title">📋 Informations personnelles</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($joueur->getNom()) ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($joueur->getPrenom()) ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="num_license">Numéro de licence *</label>
                    <input type="text" name="num_license" id="num_license" value="<?= htmlspecialchars($joueur->getNumLicense()) ?>" required>
                </div>
                <div class="form-group">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" name="date_naissance" id="date_naissance" value="<?= htmlspecialchars($joueur->getDateNaissance()) ?>">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">📊 Caractéristiques physiques</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="taille">Taille</label>
                    <input type="text" name="taille" id="taille" value="<?= htmlspecialchars($joueur->getTaille()) ?>" placeholder="Ex: 1m80">
                </div>
                <div class="form-group">
                    <label for="poids">Poids (kg)</label>
                    <input type="number" step="0.1" name="poids" id="poids" value="<?= htmlspecialchars($joueur->getPoids()) ?>">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">⚽ Informations sportives</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select name="statut" id="statut">
                        <option value="">-- Sélectionner --</option>
                        <option value="actif" <?= $joueur->getStatut() === 'actif' ? 'selected' : '' ?>>Actif</option>
                        <option value="blessé" <?= $joueur->getStatut() === 'blessé' ? 'selected' : '' ?>>Blessé</option>
                        <option value="suspendu" <?= $joueur->getStatut() === 'suspendu' ? 'selected' : '' ?>>Suspendu</option>
                        <option value="inactif" <?= $joueur->getStatut() === 'inactif' ? 'selected' : '' ?>>Inactif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="poste_prefere">Poste préféré</label>
                    <select name="poste_prefere" id="poste_prefere">
                        <option value="">-- Sélectionner --</option>
                        <option value="gardien" <?= $joueur->getPostePrefere() === 'gardien' ? 'selected' : '' ?>>Gardien</option>
                        <option value="defenseur" <?= $joueur->getPostePrefere() === 'defenseur' ? 'selected' : '' ?>>Défenseur</option>
                        <option value="milieu" <?= $joueur->getPostePrefere() === 'milieu' ? 'selected' : '' ?>>Milieu</option>
                        <option value="attaquant" <?= $joueur->getPostePrefere() === 'attaquant' ? 'selected' : '' ?>>Attaquant</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="liste.php" class="btn-retour">Annuler</a>
            <input type="submit" value="✓ Enregistrer les modifications">
        </div>
    </form>
</div>

</body>
</html>
