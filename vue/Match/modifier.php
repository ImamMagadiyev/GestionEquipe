<?php
require_once __DIR__ . '/../../controleur/Match/GestionModifierMatch.php';
include '../../menu.php';

$repertoireAbsolu = __DIR__ . '/../../Assets/clubs/'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un match - Mon Équipe</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

<div class="page-container">
    <div class="page-header">
        <div>
            <h1>✏️ Modifier le match</h1>
            <p class="text-muted">vs <?= htmlspecialchars($match->getAdversaire()) ?> - <?= date('d/m/Y', strtotime($match->getDate())) ?></p>
        </div>
        <a href="liste.php" class="btn-retour">← Retour à la liste</a>
    </div>

    <form method="post" class="formulaire">
        <div class="form-section">
            <h3 class="form-section-title">📆 Date et heure</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date du match *</label>
                    <input type="date" name="date" id="date" value="<?= htmlspecialchars($match->getDate()) ?>" required>
                </div>
                <div class="form-group">
                    <label for="heure">Heure de coup d'envoi</label>
                    <input type="time" name="heure" id="heure" value="<?= htmlspecialchars($match->getHeure()) ?>">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">🆚 L'adversaire</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="adversaire">Nom de l'équipe adverse</label>
                    <input type="text" name="adversaire" id="adversaire" value="<?= htmlspecialchars($match->getAdversaire()) ?>">
                </div>
                <div class="form-group">
                    <label for="logo_adversaire">Logo de l'adversaire</label>
                    <select name="logo_adversaire" id="logo_adversaire">
                        <option value="">-- Choisir un logo --</option>
                        <?php
                        $cheminRelatifAffichage = 'Assets/clubs/';
                        $fichiersLogos = glob($repertoireAbsolu . '*.png');
                        $logoActuel = $match->getLogoAdversaire();

                        foreach ($fichiersLogos as $cheminFichier) {
                            $nomFichier = basename($cheminFichier);
                            $valeurAEnregistrer = $cheminRelatifAffichage . $nomFichier;
                            $label = str_replace(['_', '.png'], [' ', ''], $nomFichier);
                            $label = ucwords($label);
                            $selected = ($logoActuel === $valeurAEnregistrer) ? 'selected' : '';
                            echo "<option value=\"$valeurAEnregistrer\" $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">📍 Lieu et résultat</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="lieu">Lieu du match</label>
                    <select name="lieu" id="lieu">
                        <option value="">-- Sélectionner --</option>
                        <option value="Domicile" <?= $match->getLieu() === 'Domicile' ? 'selected' : '' ?>>🏠 Domicile</option>
                        <option value="Extérieur" <?= $match->getLieu() === 'Extérieur' ? 'selected' : '' ?>>✈️ Extérieur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="resultat">Résultat</label>
                    <input type="text" name="resultat" id="resultat" value="<?= htmlspecialchars($match->getResultat()) ?>" placeholder="Ex: 2-1">
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
