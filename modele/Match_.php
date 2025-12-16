<?php

class Match_ {

    private string $id_match;
    private string $date_;
    private ?string $heure;
    private ?string $adversaire;
    private ?string $logo_adversaire;
    private ?string $lieu;
    private ?string $resultat;
    private ?string $statut;

    public function __construct(string $id_match,string $date_,?string $heure = null,?string $adversaire = null, ?string $logo_adversaire = null, ?string $lieu = null,?string $resultat = null,){
        $this->id_match = $id_match;
        $this->date_ = $date_;
        $this->heure = $heure;
        $this->adversaire = $adversaire;
        $this->logo_adversaire = $logo_adversaire;
        $this->lieu = $lieu;
        $this->resultat = $resultat;
    }

    public function getIdMatch(): string { 
        return $this->id_match; 
    }
    public function getDate(): string { 
        return $this->date_; 
    }
    public function getHeure(): ?string {
        return $this->heure; 
    }
    public function getAdversaire(): ?string { 
        return $this->adversaire; 
    }
    public function getLogoAdversaire(): ?string {
        return $this->logo_adversaire;
    }
    public function getLieu(): ?string { 
        return $this->lieu; 
    }
    public function getResultat(): ?string { 
        return $this->resultat; 
    }
    public function getStatut(): string {
        $maintenant = new DateTime();
        $dateMatch = new DateTime($this->date_);

        if ($dateMatch > $maintenant) {
            return 'à venir';
        }

        return 'Terminé';
    }


    public function setDate(?string $date): void { 
        $this->date = $date; 
    }
    public function setHeure(?string $heure): void { 
        $this->heure = $heure; 
    }
    public function setAdversaire(?string $adversaire): void { 
        $this->adversaire = $adversaire; 
    }
    public function setLogoAdversaire(?string $logo_adversaire): void {
        $this->logo_adversaire = $logo_adversaire;
    }
    public function setLieu(?string $lieu): void { 
        $this->lieu = $lieu; 
    }
    public function setResultat(?string $resultat): void { 
        $this->resultat = $resultat; 
    }

}
?>
