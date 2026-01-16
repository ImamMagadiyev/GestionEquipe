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
        "SELECT p.evaluation, p.poste, p.titulaire_remplacant, m.adversaire, m.date_ AS date_match, m.resultat, m.lieu
         FROM Participer p
         JOIN match_ m ON p.id_match = m.id_match
         WHERE p.id_joueur = :id_joueur
         ORDER BY m.date_ DESC"
    );
    $stmt->bindValue(':id_joueur', $id_joueur);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    /** Statistiques détaillées pour un joueur */
    public function getStatistiquesJoueur(string $id_joueur): array {
        $historique = $this->findHistoriqueByJoueur($id_joueur);
        
        if (empty($historique)) {
            return [
                'nb_titularisations' => 0,
                'nb_remplacements' => 0,
                'evaluation_moyenne' => 0,
                'matchs_consecutifs' => 0,
                'pourcentage_victoires' => 0,
                'poste_meilleur' => null
            ];
        }

        $nb_titularisations = 0;
        $nb_remplacements = 0;
        $total_evaluations = 0;
        $nb_evaluations = 0;
        $victoires = 0;
        $matchs_joues = 0;
        $postes = [];
        $matchs_consecutifs = 0;

        foreach ($historique as $match) {
            if ($match['titulaire_remplacant'] === 'titulaire') {
                $nb_titularisations++;
            } else {
                $nb_remplacements++;
            }

            if ($match['evaluation'] !== null) {
                $total_evaluations += intval($match['evaluation']);
                $nb_evaluations++;
            }

            if ($match['poste']) {
                if (!isset($postes[$match['poste']])) {
                    $postes[$match['poste']] = ['count' => 0, 'total_eval' => 0];
                }
                $postes[$match['poste']]['count']++;
                if ($match['evaluation']) {
                    $postes[$match['poste']]['total_eval'] += intval($match['evaluation']);
                }
            }

            if ($match['resultat'] && strpos($match['resultat'], '-') !== false) {
                $matchs_joues++;
                $parts = explode('-', $match['resultat']);
                $score_equipe = intval($parts[0]);
                $score_adversaire = intval($parts[1]);

                if ($match['lieu'] === 'Extérieur') {
                    $temp = $score_equipe;
                    $score_equipe = $score_adversaire;
                    $score_adversaire = $temp;
                }

                if ($score_equipe > $score_adversaire) {
                    $victoires++;
                }
            }
        }

        // Matchs consécutifs (les plus récents jusqu'à une non-participation)
        foreach ($historique as $match) {
            $matchs_consecutifs++;
        }

        $poste_meilleur = null;
        $meilleure_moyenne = 0;
        foreach ($postes as $poste => $data) {
            if ($data['total_eval'] > 0) {
                $moyenne = $data['total_eval'] / $data['count'];
                if ($moyenne > $meilleure_moyenne) {
                    $meilleure_moyenne = $moyenne;
                    $poste_meilleur = $poste;
                }
            }
        }

        return [
            'nb_titularisations' => $nb_titularisations,
            'nb_remplacements' => $nb_remplacements,
            'evaluation_moyenne' => $nb_evaluations > 0 ? round($total_evaluations / $nb_evaluations, 2) : 0,
            'matchs_consecutifs' => count($historique),
            'pourcentage_victoires' => $matchs_joues > 0 ? round(($victoires / $matchs_joues) * 100, 1) : 0,
            'poste_meilleur' => $poste_meilleur
        ];
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
