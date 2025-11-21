<?php
require_once 'Requetes.php';
require_once __DIR__ . '/../../Participer.php';


class RequeteParticiper implements Requetes {
    private string $sql;

    public function __construct(string $type){
        switch($type){
            case 'selectByMatch':
                $this->sql = "SELECT * FROM Participer WHERE id_match=:id_match";
                break;
            case 'insert':
                $this->sql = "INSERT INTO Participer (id_participant, id_joueur, id_match, poste, evaluation, titulaire_remplacant)
                              VALUES (:id, :id_joueur, :id_match, :poste, :evaluation, :titulaire_remplacant)";
                break;
            case 'update':
                $this->sql = "UPDATE Participer SET poste=:poste, evaluation=:evaluation, titulaire_remplacant=:titulaire_remplacant
                              WHERE id_participant=:id";
                break;
            case 'delete':
                $this->sql = "DELETE FROM Participer WHERE id_participant=:id";
                break;
            default:
                throw new Exception("Type de requête inconnu");
        }
    }

    public function requete(): string {
        return $this->sql;
    }

    // méthode obligatoire pour les requêtes par ID
    public function parametresId(PDOStatement $stmt, mixed ...$ids): void {
        if (count($ids) === 1) {
            $stmt->bindValue(':id', $ids[0]);
        }
    }

    // méthode obligatoire pour les requêtes basées sur un objet
    public function parametresObjet(PDOStatement $stmt, object $data): void {
        if (!$data instanceof Participer) throw new Exception("Objet attendu : Participer");
        $stmt->bindValue(':id', $data->getIdParticipant());
        $stmt->bindValue(':id_joueur', $data->getIdJoueur());
        $stmt->bindValue(':id_match', $data->getIdMatch());
        $stmt->bindValue(':poste', $data->getPoste());
        $stmt->bindValue(':evaluation', $data->getEvaluation());
        $stmt->bindValue(':titulaire_remplacant', $data->getTitulaireRemplacant());
    }
}
?>
