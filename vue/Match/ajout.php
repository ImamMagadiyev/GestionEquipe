<?php
require_once __DIR__ . '/../../controleur/Match/GestionAjoutMatch.php';
include '../../menu.php';

$repertoireAbsolu = __DIR__ . '/../../Assets/clubs/'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un match - Mon Équipe</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

<div class="page-container">
    <div class="page-header">
        <div>
            <h1>📅 Ajouter un match</h1>
            <p class="text-muted">Programmez une nouvelle rencontre</p>
        </div>
        <a href="liste.php" class="btn-retour">← Retour à la liste</a>
    </div>

    <form method="post" class="formulaire">
        <div class="form-section">
            <h3 class="form-section-title">📆 Date et heure</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date du match *</label>
                    <input type="date" name="date" id="date" required>
                </div>
                <div class="form-group">
                    <label for="heure">Heure de coup d'envoi</label>
                    <input type="time" name="heure" id="heure">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">🆚 L'adversaire</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="adversaire">Nom de l'équipe adverse</label>
                    <input type="text" name="adversaire" id="adversaire" placeholder="Ex: FC Barcelona">
                </div>
                <div class="form-group">
                    <label for="logo_adversaire">Logo de l'adversaire</label>
                    <select name="logo_adversaire" id="logo_adversaire">
                        <option value="">-- Choisir un logo --</option>
                        <?php
                        $cheminRelatifAffichage = 'Assets/clubs/';
                        $fichiersLogos = glob($repertoireAbsolu . '*.png');

                        foreach ($fichiersLogos as $cheminFichier) {
                            $nomFichier = basename($cheminFichier);
                            $valeurAEnregistrer = $cheminRelatifAffichage . $nomFichier;
                            $label = str_replace(['_', '.png'], [' ', ''], $nomFichier);
                            $label = ucwords($label);
                            echo "<option value=\"$valeurAEnregistrer\">$label</option>";
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
                        <option value="Domicile">🏠 Domicile</option>
                        <option value="Extérieur">✈️ Extérieur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="resultat">Résultat (si connu)</label>
                    <input type="text" name="resultat" id="resultat" placeholder="Ex: 2-1">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="liste.php" class="btn-retour">Annuler</a>
            <input type="submit" value="✓ Créer le match">
        </div>
    </form>
</div>

</body>
</html>
