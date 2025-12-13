<?php
require_once 'Requetes.php';
require_once __DIR__ . '/../../Commentaire.php';

class RequetesCommentaire implements Requetes {
    private string $sql;

    public function __construct(string $type) {
        switch($type) {
            case 'selectAll': 
                $this->sql = "SELECT * FROM Commentaire ORDER BY date_ DESC";
                break;
            case 'selectByJoueur':
                $this->sql = "SELECT * FROM Commentaire WHERE id_joueur = :id ORDER BY date_ DESC";
                break;
            case 'insert':
                $this->sql = "INSERT INTO Commentaire (id_commentaire, commentaire, date_, id_joueur) 
                              VALUES (:id, :commentaire, :date_, :id_joueur)";
                break;
            case 'update':
                $this->sql = "UPDATE Commentaire SET commentaire=:commentaire, date_=:date_ 
                              WHERE id_commentaire=:id";
                break;
            case 'delete':
                $this->sql = "DELETE FROM Commentaire WHERE id_commentaire=:id";
                break;
            default:
                throw new Exception("Type de requête inconnu");
        }
    }

    public function requete(): string {
        return $this->sql;
    }

    public function parametresId(PDOStatement $stmt, mixed ...$ids): void {
        if (count($ids) === 1) $stmt->bindValue(':id', $ids[0]);
    }

    public function parametresObjet(PDOStatement $stmt, object $obj): void {
        if (!$obj instanceof Commentaire) throw new Exception("Objet attendu : Commentaire");
        $stmt->bindValue(':id', $obj->getIdCommentaire());
        $stmt->bindValue(':commentaire', $obj->getCommentaire());
        $stmt->bindValue(':date_', $obj->getDate());
        $stmt->bindValue(':id_joueur', $obj->getIdJoueur());
    }
}
?>
