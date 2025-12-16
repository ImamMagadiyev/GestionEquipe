<?php
require_once 'Dao.php';
require_once __DIR__ . '/../Match_.php';
require_once __DIR__ . '/requetes/RequeteMatch.php';

class DaoMatch implements Dao {
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $req = new RequeteMatch('selectAll');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    public function findById(string $id): ?Match_ {
        $req = new RequeteMatch('selectById');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresId($stmt, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->creerInstance($row) : null;
    }

    public function create(object $obj): bool {

        if (!($obj instanceof Match_)) {
            return false;
        }

        $req = new RequeteMatch('insert');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresObjet($stmt, $obj);
        return $stmt->execute();
    }

    public function update(object $obj): bool {

        if (!($obj instanceof Match_)) {
            return false;
        }

        $req = new RequeteMatch('update');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresObjet($stmt, $obj);
        return $stmt->execute();
    }

    // ... (Avant la méthode delete) ...
    public function delete(object $obj): bool {
        $stmt_participer = $this->pdo->prepare(
            "DELETE FROM Participer WHERE id_match = :id_match"
        );
        $stmt_participer->bindValue(':id_match', $obj->getIdMatch());
        $stmt_participer->execute(); 

        // 2. Suppression du Match (Parent)
        $req = new RequeteMatch('delete');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresId($stmt, $obj->getIdMatch()); 
        return $stmt->execute();
    }

    private function creerInstance(array $row): Match_ {
        return new Match_(
            $row['id_match'],
            $row['date_'],
            $row['heure'] ?? null,
            $row['adversaire'] ?? null,
            $row['logo_adversaire'] ?? null,
            $row['lieu'] ?? null,
            $row['resultat'] ?? null
        );
    }
}
?>
