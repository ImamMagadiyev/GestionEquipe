<?php
require_once 'Dao.php';
require_once __DIR__ . '/../Participer.php';
require_once __DIR__ . '/requetes/RequeteParticiper.php';

class DaoParticiper implements Dao {
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $req = new RequeteParticiper('selectByMatch'); // si besoin créer selectAll
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    public function findAllByMatch(string $id_match): array {
        $req = new RequeteParticiper('selectByMatch');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':id_match', $id_match);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    public function findByJoueurEtMatch(string $id_joueur, string $id_match): ?Participer {
        $stmt = $this->pdo->prepare("SELECT * FROM Participer WHERE id_joueur=:id_joueur AND id_match=:id_match");
        $stmt->bindValue(':id_joueur', $id_joueur);
        $stmt->bindValue(':id_match', $id_match);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->creerInstance($row) : null;
    }

    public function findById(string $id): ?object {
        $req = new RequeteParticiper('selectById'); // à créer si nécessaire
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->creerInstance($row) : null;
    }

    public function create(object $obj): bool {
        if (!$obj instanceof Participer) throw new Exception("Objet attendu : Participer");
        $req = new RequeteParticiper('insert');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':id', $obj->getIdParticipant());
        $stmt->bindValue(':id_joueur', $obj->getIdJoueur());
        $stmt->bindValue(':id_match', $obj->getIdMatch());
        $stmt->bindValue(':poste', $obj->getPoste());
        $stmt->bindValue(':evaluation', $obj->getEvaluation());
        $stmt->bindValue(':titulaire_remplacant', $obj->getTitulaireRemplacant());
        return $stmt->execute();
    }

    public function update(object $obj): bool {
        if (!$obj instanceof Participer) throw new Exception("Objet attendu : Participer");
        $req = new RequeteParticiper('update');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':poste', $obj->getPoste());
        $stmt->bindValue(':evaluation', $obj->getEvaluation());
        $stmt->bindValue(':titulaire_remplacant', $obj->getTitulaireRemplacant());
        $stmt->bindValue(':id', $obj->getIdParticipant());
        return $stmt->execute();
    }

    public function delete(object $obj): bool {
        if (!$obj instanceof Participer) throw new Exception("Objet attendu : Participer");
        $req = new RequeteParticiper('delete');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':id', $obj->getIdParticipant());
        return $stmt->execute();
    }

    private function creerInstance(array $row): Participer {
        return new Participer(
            $row['id_participant'],
            $row['id_joueur'],
            $row['id_match'],
            $row['poste'] ?? null,
            $row['evaluation'] ?? null,
            $row['titulaire_remplacant'] ?? null
        );
    }
}
?>
