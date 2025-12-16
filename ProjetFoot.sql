-- Table Joueur
CREATE TABLE Joueur (
    id_joueur VARCHAR(50) PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    num_license VARCHAR(50) NOT NULL,
    date_naissance DATE,
    taille VARCHAR(50),
    poids DECIMAL(15,2),
    statut VARCHAR(50),
    poste_prefere VARCHAR(50)
);

-- Table Match_
CREATE TABLE Match_ (
    id_match VARCHAR(50) PRIMARY KEY,
    date_ DATE NOT NULL,
    heure TIME,
    adversaire VARCHAR(50),
    lieu VARCHAR(50),
    resultat VARCHAR(50)
);

-- Table Commentaire
CREATE TABLE Commentaire (
    id_commentaire VARCHAR(50) PRIMARY KEY,
    commentaire VARCHAR(255),
    date_ DATE,
    id_joueur VARCHAR(50),
    FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur)
);

-- Table Participer
CREATE TABLE Participer (
    id_participant VARCHAR(50) PRIMARY KEY,
    id_joueur VARCHAR(50),
    id_match VARCHAR(50),
    poste VARCHAR(50),
    evaluation VARCHAR(50),
    titulaire_remplacant VARCHAR(50),
    FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur),
    FOREIGN KEY (id_match) REFERENCES Match_(id_match)
);

