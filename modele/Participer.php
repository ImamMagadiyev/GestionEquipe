<?php
class Participer {
    private string $id_participant;
    private string $id_joueur;
    private string $id_match;
    private ?string $poste;
    private ?string $evaluation;
    private ?string $titulaire_remplacant;

    public function __construct(
        string $id_participant,
        string $id_joueur,
        string $id_match,
        ?string $poste = null,
        ?string $evaluation = null,
        ?string $titulaire_remplacant = null
    ) {
        $this->id_participant = $id_participant;
        $this->id_joueur = $id_joueur;
        $this->id_match = $id_match;
        $this->poste = $poste;
        $this->evaluation = $evaluation;
        $this->titulaire_remplacant = $titulaire_remplacant;
    }

    public function getIdParticipant(): string { 
        return $this->id_participant; 
    }
    public function getIdJoueur(): string { 
        return $this->id_joueur; 
    }
    public function getIdMatch(): string { 
        return $this->id_match; 
    }
    public function getPoste(): ?string { 
        return $this->poste; 
    }
    public function getEvaluation(): ?string { 
        return $this->evaluation; 
    }
    public function getTitulaireRemplacant(): ?string { 
        return $this->titulaire_remplacant; 
    }

    public function setPoste(?string $poste): void { 
    $this->poste = $poste; 
}

public function setEvaluation(?string $evaluation): void { 
    $this->evaluation = $evaluation; 
}

public function setTitulaireRemplacant(?string $tr): void { 
    $this->titulaire_remplacant = $tr; 
}

public function setIdParticipant(string $id): void {
    $this->id_participant = $id;
}

public function setIdJoueur(string $id_joueur): void {
    $this->id_joueur = $id_joueur;
}

public function setIdMatch(string $id_match): void {
    $this->id_match = $id_match;
}

}
?>
