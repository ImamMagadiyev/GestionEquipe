<?php
require_once 'Dao.php';
require_once __DIR__ . '/../Commentaire.php';
require_once __DIR__ . '/requetes/RequetesCommentaire.php';

class DaoCommentaire implements Dao {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $req = new RequetesCommentaire('selectAll');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    public function findByJoueur(string $id_joueur): array {
        $req = new RequetesCommentaire('selectByJoueur');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':id', $id_joueur);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    public function create(object $obj): bool {
        $req = new RequetesCommentaire('insert');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresObjet($stmt, $obj);
        return $stmt->execute();
    }

    public function update(object $obj): bool {
        $req = new RequetesCommentaire('update');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresObjet($stmt, $obj);
        return $stmt->execute();
    }

    public function delete(object $obj): bool {
        $req = new RequetesCommentaire('delete');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresId($stmt, $obj->getIdCommentaire());
        return $stmt->execute();
    }

    private function creerInstance(array $row): Commentaire {
        return new Commentaire(
            $row['id_commentaire'],
            $row['commentaire'],
            $row['date_'] ?? null,
            $row['id_joueur']
        );
    }
}
?>
