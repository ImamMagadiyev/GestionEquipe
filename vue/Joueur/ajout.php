<?php
require_once __DIR__ . '/../../controleur/Joueur/GestionAjoutJoueur.php';
require_once '../../menu.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un joueur - Mon Équipe</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php require '../../menu.php'; ?>

<div class="page-container">
    <div class="page-header">
        <div>
            <h1>➕ Ajouter un joueur</h1>
            <p class="text-muted">Renseignez les informations du nouveau joueur</p>
        </div>
        <a href="liste.php" class="btn-retour">← Retour à la liste</a>
    </div>

    <form method="post" class="formulaire">
        <div class="form-section">
            <h3 class="form-section-title">📋 Informations personnelles</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" name="nom" id="nom" placeholder="Ex: Dupont" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Ex: Jean" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="num_license">Numéro de licence *</label>
                    <input type="text" name="num_license" id="num_license" placeholder="Ex: LIC-2024-001" required>
                </div>
                <div class="form-group">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" name="date_naissance" id="date_naissance">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">📊 Caractéristiques physiques</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="taille">Taille</label>
                    <input type="text" name="taille" id="taille" placeholder="Ex: 1m80">
                </div>
                <div class="form-group">
                    <label for="poids">Poids (kg)</label>
                    <input type="number" step="0.1" name="poids" id="poids" placeholder="Ex: 75">
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
                        <option value="actif">Actif</option>
                        <option value="blessé">Blessé</option>
                        <option value="suspendu">Suspendu</option>
                        <option value="inactif">Inactif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="poste_prefere">Poste préféré</label>
                    <select name="poste_prefere" id="poste_prefere">
                        <option value="">-- Sélectionner --</option>
                        <option value="gardien">Gardien</option>
                        <option value="defenseur">Défenseur</option>
                        <option value="milieu">Milieu</option>
                        <option value="attaquant">Attaquant</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="liste.php" class="btn-retour">Annuler</a>
            <input type="submit" value="✓ Ajouter le joueur">
        </div>
    </form>
</div>

</body>
</html>
