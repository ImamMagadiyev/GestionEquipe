<?php
require_once 'Requetes.php';
require_once __DIR__ . '/../../Participer.php';

class RequeteParticiper implements Requetes {

    private string $sql;

    public function __construct(string $type) {

        switch ($type) {
            
            case 'selectByMatch':
                $this->sql = "SELECT * FROM Participer WHERE id_match = :id_match";
                break;

            case 'selectById':
                $this->sql = "SELECT * FROM Participer WHERE id_participant = :id";
                break;

            case 'insert':
                $this->sql =
                    "INSERT INTO Participer 
                    (id_participant, id_joueur, id_match, poste, evaluation, titulaire_remplacant)
                    VALUES (:id, :id_joueur, :id_match, :poste, :evaluation, :titulaire_remplacant)";
                break;

            case 'update':
                $this->sql =
                    "UPDATE Participer
                     SET poste = :poste,
                         evaluation = :evaluation,
                         titulaire_remplacant = :titulaire_remplacant
                     WHERE id_participant = :id";
                break;

            case 'delete':
                $this->sql = "DELETE FROM Participer WHERE id_participant = :id";
                break;

            default:
                throw new Exception("Type de requête Participer inconnu : " . $type);
        }
    }

    public function requete(): string {
        return $this->sql;
    }

    public function parametresId(PDOStatement $stmt, mixed ...$ids): void {
        $stmt->bindValue(':id', $ids[0]);
    }

   public function parametresObjet(PDOStatement $stmt, object $data, string $type = 'insert'): void {
    if (!$data instanceof Participer) throw new Exception("Objet attendu : Participer");

    if ($type === 'insert') {
        $stmt->bindValue(':id', $data->getIdParticipant());
        $stmt->bindValue(':id_joueur', $data->getIdJoueur());
        $stmt->bindValue(':id_match', $data->getIdMatch());
    }

    $stmt->bindValue(':poste', $data->getPoste() ?: null, PDO::PARAM_STR);

    if ($data->getEvaluation() === null) {
        $stmt->bindValue(':evaluation', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':evaluation', $data->getEvaluation(), PDO::PARAM_INT);
    }

    $stmt->bindValue(':titulaire_remplacant', $data->getTitulaireRemplacant() ?: null, PDO::PARAM_STR);

    if ($type === 'update') {
        $stmt->bindValue(':id', $data->getIdParticipant());
    }
}


}
