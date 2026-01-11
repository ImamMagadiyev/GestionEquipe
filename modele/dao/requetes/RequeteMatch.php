<?php
require_once 'Requetes.php';
require_once __DIR__ . '/../../Match_.php';

class RequeteMatch implements Requetes {
    private string $sql;

    public function __construct(string $type){
        switch($type){
            case 'selectAll':
                // Récupérer TOUS les matchs (passés et futurs)
                $this->sql = "SELECT * FROM Match_ ORDER BY date_ DESC, heure DESC";
                break;
            case 'selectFuturs':
                // Récupérer uniquement les matchs futurs pour la page d'accueil
                $this->sql = "SELECT * FROM Match_ WHERE date_ > NOW() ORDER BY date_ ASC, heure";
                break;
            case 'selectById':
                $this->sql = "SELECT * FROM Match_ WHERE id_match=:id";
                break;
            case 'insert':
                $this->sql = "INSERT INTO Match_ (id_match, date_, heure, adversaire, logo_adversaire, lieu, resultat)
                              VALUES (:id, :date_, :heure, :adversaire, :logo_adversaire, :lieu, :resultat)";
                break;
            case 'update':
                $this->sql = "UPDATE Match_ SET date_=:date_, heure=:heure, adversaire=:adversaire, logo_adversaire=:logo_adversaire, lieu=:lieu, resultat=:resultat
                              WHERE id_match=:id";
                break;
            case 'delete':
                $this->sql = "DELETE FROM Match_ WHERE id_match=:id";
                break;
            default:
                throw new Exception("Type de requête inconnu");
        }
    }

    public function requete(): string {
        return $this->sql;
    }

    public function parametresId(PDOStatement $stmt, mixed ...$ids): void {
        if(count($ids) === 1){
            $stmt->bindValue(':id', $ids[0]);
        }
    }

    public function parametresObjet(PDOStatement $stmt, object $data): void {

        if(!($data instanceof Match_)) {
            throw new Exception("Objet attendu : Match_");
        }
        $match = $data;

        $stmt->bindValue(':id', $data->getIdMatch());
        $stmt->bindValue(':date_', $data->getDate());
        $stmt->bindValue(':heure', $data->getHeure());
        $stmt->bindValue(':adversaire', $data->getAdversaire());
        $stmt->bindValue(':logo_adversaire', $data->getLogoAdversaire()); 
        $stmt->bindValue(':lieu', $data->getLieu());
        $stmt->bindValue(':resultat', $data->getResultat());
    }
}
?>