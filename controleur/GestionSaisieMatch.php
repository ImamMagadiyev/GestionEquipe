<?php
require_once __DIR__ . '/../modele/dao/DaoParticiper.php';
require_once __DIR__ . '/../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../bd/pdo.php';
require_once __DIR__ . '/../connexion/verificationConnexion.php';

$id_match = $_GET['id'] ?? null;
if (!$id_match) die("ID de match manquant !");

$daoJoueur = new DaoJoueur($pdo);
$daoMatch = new DaoMatch($pdo);
$daoParticiper = new DaoParticiper($pdo);

$match = $daoMatch->findById($id_match);
if (!$match) die("Match introuvable !");

$joueursActifs = $daoJoueur->findActifs();

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $joueursValides = 0;
    $gardiens = 0;

    // Validation : compter les joueurs et gardiens sélectionnés
    foreach($_POST['joueur'] as $id_joueur => $data){
        if(!empty($data['titulaire_remplacant'])){
            $joueursValides++;
            $poste = trim($data['poste'] ?? '');
            if ($poste === 'gardien') {
                $gardiens++;
            }
        }
    }

    // Vérifier les conditions
    if($joueursValides !== 11){ 
        $error = "Vous devez sélectionner exactement 11 joueurs.";
    } elseif($gardiens !== 1) {
        $error = "Vous devez avoir exactement 1 gardien.";
    } else {
        // Tout est bon, enregistrer les données
        foreach($_POST['joueur'] as $id_joueur => $data){
            if(!empty($data['titulaire_remplacant'])){
                // Vérifier que le joueur existe en base
                $joueur = $daoJoueur->findById($id_joueur);
                if (!$joueur) {
                    $error = "Erreur : Un joueur n'existe plus en base de données. Veuillez rafraîchir la page et réessayer.";
                    break;
                }
                
                $evaluation = $data['evaluation'] ?? null;
                if ($evaluation === '' || $evaluation === null) $evaluation = null;
                else $evaluation = (int)$evaluation;

                $existing = $daoParticiper->findByJoueurEtMatch($id_joueur, $id_match);
                $p = new Participer(
                    $existing ? $existing->getIdParticipant() : uniqid(),
                    $id_joueur,
                    $id_match,
                    $data['poste'] ?? null,
                    $evaluation,
                    $data['titulaire_remplacant'] ?? null
                );

                if($existing){
                    $daoParticiper->update($p);
                } else {
                    $daoParticiper->create($p);
                }
            }
        }
        
        if (!$error) {
            $success = "Feuille de match validée et enregistrée avec succès !";
        }
        
        // Message de succès
        $success = "Feuille de match validée avec succès !";
    }
}

include __DIR__ . '/../vue/saisie.php';