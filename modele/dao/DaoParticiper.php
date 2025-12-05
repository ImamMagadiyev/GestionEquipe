<?php
require_once 'Dao.php';
require_once __DIR__ . '/../Participer.php';
require_once __DIR__ . '/requetes/RequeteParticiper.php';

class DaoParticiper implements Dao {

    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    /** Retourne tous les Participer */
    public function findAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM Participer ORDER BY id_match DESC");
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $this->creerInstance($row);
        }
        return $result;
    }

    /** Retourne la liste des joueurs d’un match */
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

    /** Retourne un Participer joueur + match */
    public function findByJoueurEtMatch(string $id_joueur, string $id_match): ?Participer {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM Participer WHERE id_joueur = :id_joueur AND id_match = :id_match LIMIT 1"
        );
        $stmt->bindValue(':id_joueur', $id_joueur);
        $stmt->bindValue(':id_match', $id_match);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->creerInstance($row) : null;
    }

    /** Trouver par ID Participer */
    public function findById(string $id): ?Participer {
        $req = new RequeteParticiper('selectById');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->creerInstance($row) : null;
    }

    /** Historique d’un joueur → utile pour statistiques */
    public function findHistoriqueByJoueur(string $id_joueur): array {
    $stmt = $this->pdo->prepare(
        "SELECT p.evaluation, m.adversaire, m.date_ AS date_match
         FROM Participer p
         JOIN match_ m ON p.id_match = m.id_match
         WHERE p.id_joueur = :id_joueur
         ORDER BY m.date_ DESC"
    );
    $stmt->bindValue(':id_joueur', $id_joueur);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    public function create(object $obj): bool {
        if (!$obj instanceof Participer)
            throw new Exception("Objet attendu : Participer");

        $req = new RequeteParticiper('insert');
        $stmt = $this->pdo->prepare($req->requete());
        $req->parametresObjet($stmt, $obj, 'insert');

        return $stmt->execute();
    }

    public function update(object $obj): bool {
    if (!$obj instanceof Participer)
        throw new Exception("Objet attendu : Participer");

    $req = new RequeteParticiper('update');
    $stmt = $this->pdo->prepare($req->requete());

 
    
    $req->parametresObjet($stmt, $obj, 'update');

    return $stmt->execute();
}


    public function delete(object $obj): bool {
        if (!$obj instanceof Participer)
            throw new Exception("Objet attendu : Participer");

        $req = new RequeteParticiper('delete');
        $stmt = $this->pdo->prepare($req->requete());
        $stmt->bindValue(':id', $obj->getIdParticipant());

        return $stmt->execute();
    }

    /** Convert SQL -> Objet */
    private function creerInstance(array $row): Participer {
        return new Participer(
            $row['id_participant'],
            $row['id_joueur'],
            $row['id_match'],
            $row['poste'] ?? null,
            $row['evaluation'] !== null ? intval($row['evaluation']) : null,
            $row['titulaire_remplacant'] ?? null
        );
    }
}
