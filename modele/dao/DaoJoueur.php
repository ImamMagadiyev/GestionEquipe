<?php
require_once 'Dao.php';
require_once __DIR__ . '/../Joueur.php';
require_once __DIR__ . '/requetes/RequetesJoueur.php';

class DaoJoueur implements Dao {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $req = new RequetesJoueur('selectAll');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    public function findById(string $id): ?Joueur {
        $req = new RequetesJoueur('selectById');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresId($stmt, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->creerInstance($row) : null;
    }

    public function findActifs(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM Joueur WHERE statut='actif' ORDER BY nom, prenom");
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    public function create(object $obj): bool {
        $req = new RequetesJoueur('insert');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresObjet($stmt, $obj);
        return $stmt->execute();
    }

    public function update(object $obj): bool {
        $req = new RequetesJoueur('update');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresObjet($stmt, $obj);
        return $stmt->execute();
    }

    public function delete(object $obj): bool {
        $req = new RequetesJoueur('delete');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresId($stmt, $obj->getIdJoueur());
        return $stmt->execute();
    }

    private function creerInstance(array $row): Joueur {
        return new Joueur(
            $row['id_joueur'],
            $row['nom'],
            $row['prenom'],
            $row['num_license'],
            $row['date_naissance'] ?? null,
            $row['taille'] ?? null,
            isset($row['poids']) ? (float)$row['poids'] : null,
            $row['statut'] ?? null,
            $row['poste_prefere'] ?? null
        );
    }
}
?>
