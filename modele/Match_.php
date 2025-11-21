<?php

class Match_ {

    private string $id_match;
    private string $date_;
    private ?string $heure;
    private ?string $adversaire;
    private ?string $lieu;
    private ?string $resultat;

    public function __construct(string $id_match,string $date_,?string $heure = null,?string $adversaire = null,?string $lieu = null,?string $resultat = null){
        $this->id_match = $id_match;
        $this->date_ = $date_;
        $this->heure = $heure;
        $this->adversaire = $adversaire;
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
    public function getLieu(): ?string { 
        return $this->lieu; 
    }
    public function getResultat(): ?string { 
        return $this->resultat; 
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
    public function setLieu(?string $lieu): void { 
        $this->lieu = $lieu; 
    }
    public function setResultat(?string $resultat): void { 
        $this->resultat = $resultat; 
    }

}
?>
