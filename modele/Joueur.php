<?php

class Joueur {
    private string $id_joueur;
    private string $nom;
    private string $prenom;
    private string $num_license;
    private ?string $date_naissance;
    private ?string $taille;
    private ?float $poids;
    private ?string $statut;
    private ?string $poste_prefere;

    public function __construct(
        string $id_joueur,
        string $nom,
        string $prenom,
        string $num_license,
        ?string $date_naissance = null,
        ?string $taille = null,
        ?float $poids = null,
        ?string $statut = null,
        ?string $poste_prefere = null
    ) {
        $this->id_joueur = $id_joueur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->num_license = $num_license;
        $this->date_naissance = $date_naissance;
        $this->taille = $taille;
        $this->poids = $poids;
        $this->statut = $statut;
        $this->poste_prefere = $poste_prefere;
    }

    public function getIdJoueur(): string { 
        return $this->id_joueur; 
    }
    public function getNom(): string { 
        return $this->nom; 
    }
    public function getPrenom(): string { 
        return $this->prenom; 
    }
    public function getNumLicense(): string { 
        return $this->num_license; 
    }
    public function getDateNaissance(): ?string { 
        return $this->date_naissance; 
    }
    public function getTaille(): ?string { 
        return $this->taille; 
    }
    public function getPoids(): ?float { 
        return $this->poids; 
    }
    public function getStatut(): ?string { 
        return $this->statut; 
    }
    public function getPostePrefere(): ?string { 
        return $this->poste_prefere; 
    }
    public function setNom(string $nom): void {
    $this->nom = $nom;
}

public function setPrenom(string $prenom): void {
    $this->prenom = $prenom;
}

public function setNumLicense(string $num_license): void {
    $this->num_license = $num_license;
}

public function setDateNaissance(?string $date_naissance): void {
    $this->date_naissance = $date_naissance;
}

public function setTaille(?string $taille): void {
    $this->taille = $taille;
}

public function setPoids(?float $poids): void {
    $this->poids = $poids;
}

public function setStatut(?string $statut): void {
    $this->statut = $statut;
}

public function setPostePrefere(?string $poste_prefere): void {
    $this->poste_prefere = $poste_prefere;
}

    
}
?>