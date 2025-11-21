<?php
require_once __DIR__ . '/../bd/pdo.php';
require_once __DIR__ . '/../modele/dao/DaoParticiper.php';
require_once __DIR__ . '/../modele/dao/DaoJoueur.php';
require_once __DIR__ . '/../modele/dao/DaoMatch.php';
require_once __DIR__ . '/../connexion/verificationConnexion.php';

$id_match = $_GET['id'] ?? null;
if (!$id_match) die("ID de match manquant !");

$daoMatch = new DaoMatch($linkpdo);
$daoJoueur = new DaoJoueur($linkpdo);
$daoParticiper = new DaoParticiper($linkpdo);

$match = $daoMatch->findById($id_match);
if (!$match) die("Match introuvable !");

$joueursActifs = $daoJoueur->findActifs();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $joueursValides = 0;

    foreach($_POST['joueur'] as $id_joueur => $data){
        if(!empty($data['titulaire_remplacant'])){
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

        if($existing){
            $daoParticiper->update($p);
        } else {
            $daoParticiper->create($p);
        }
    }

    if($joueursValides < 7){ // minimum 7 joueurs
        $error = "Vous devez sélectionner au moins 7 joueurs.";
    } else {
        header("Location: ../Match/liste.php");
        exit;
    }
}
?>
