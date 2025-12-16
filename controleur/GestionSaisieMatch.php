<?php
require_once __DIR__ . '/../modele/dao/DaoParticiper.php';
require_once __DIR__ . '/../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../bd/pdo.php';
require_once __DIR__ . '/../connexion/verificationConnexion.php';

// Récupérer l'ID du match
$id_match = $_GET['id'] ?? null;
if (!$id_match) die("ID de match manquant !");

// Instanciation des DAO
$daoJoueur = new DaoJoueur($pdo);
$daoMatch = new DaoMatch($pdo);
$daoParticiper = new DaoParticiper($pdo);

// Récupérer le match
$match = $daoMatch->findById($id_match);
if (!$match) die("Match introuvable !");

// Joueurs actifs
$joueursActifs = $daoJoueur->findActifs();

// Gestion du formulaire
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $joueursValides = 0;

    foreach($_POST['joueur'] as $id_joueur => $data){
        if(!empty($data['titulaire_remplacant'])){
            $joueursValides++;
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

    if($joueursValides < 7){ 
        $error = "Vous devez sélectionner au moins 7 joueurs.";
    } else {
        header("Location: /GestionEquipe/vue/Joueur/liste.php");
        exit;
    }
}

// Appel de la vue après avoir tout préparé
include __DIR__ . '/../vue//saisie.php';
