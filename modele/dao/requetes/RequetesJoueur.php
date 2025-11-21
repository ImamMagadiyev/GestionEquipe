<?php

require_once 'Requetes.php';
require_once __DIR__ . '/../../Joueur.php';

class RequetesJoueur implements Requetes {

    private string $sql;

    public function __construct(string $type) {
        switch($type) {
            case 'selectAll':
                $this->sql = "SELECT * FROM Joueur ORDER BY nom, prenom";
                break;
            case 'selectById':
                $this->sql = "SELECT * FROM Joueur WHERE id_joueur = :id";
                break;
            case 'insert':
                $this->sql = "INSERT INTO Joueur (id_joueur, nom, prenom, num_license, date_naissance, taille, poids, statut, poste_prefere)
                              VALUES (:id, :nom, :prenom, :license, :date_naissance, :taille, :poids, :statut, :poste)";
                break;
            case 'update':
                $this->sql = "UPDATE Joueur SET nom=:nom, prenom=:prenom, num_license=:license, date_naissance=:date_naissance,
                              taille=:taille, poids=:poids, statut=:statut, poste_prefere=:poste WHERE id_joueur=:id";
                break;
            case 'delete':
                $this->sql = "DELETE FROM Joueur WHERE id_joueur=:id";
                break;
            default:
                throw new Exception("Type de requête inconnu");
        }
    }

    public function requete(): string {
        return $this->sql;
    }

    public function parametresId(PDOStatement $stmt, mixed ...$ids): void {
        if (count($ids) === 1) {
            $stmt->bindValue(':id', $ids[0]);
        }
    }

    public function parametresObjet(PDOStatement $stmt, object $data): void {
        if (!$data instanceof Joueur) throw new Exception("Objet attendu : Joueur");
        $stmt->bindValue(':id', $data->getIdJoueur());
        $stmt->bindValue(':nom', $data->getNom());
        $stmt->bindValue(':prenom', $data->getPrenom());
        $stmt->bindValue(':license', $data->getNumLicense());
        $stmt->bindValue(':date_naissance', $data->getDateNaissance());
        $stmt->bindValue(':taille', $data->getTaille());
        $stmt->bindValue(':poids', $data->getPoids());
        $stmt->bindValue(':statut', $data->getStatut());
        $stmt->bindValue(':poste', $data->getPostePrefere());
    }
}
