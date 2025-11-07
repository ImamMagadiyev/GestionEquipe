-- Exemple rapide pour Joueurs
CREATE TABLE Joueurs (
    id_joueur VARCHAR(50) PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    num_license VARCHAR(50),
    date_naissance DATE,
    taille VARCHAR(50),
    poids DECIMAL(15,2),
    statut VARCHAR(50),
    poste_prefere VARCHAR(50)
);

-- Table Matchs
CREATE TABLE Matchs (
    id_match VARCHAR(50) PRIMARY KEY,
    date_ DATE,
    heure TIME,
    adversaire VARCHAR(50),
    lieu VARCHAR(50),
    resultat VARCHAR(50)
);

-- Table Commentaire
CREATE TABLE Commentaire (
    id_commentaire VARCHAR(50) PRIMARY KEY,
    commentaire VARCHAR(50),
    date_ VARCHAR(50),
    id_joueur VARCHAR(50),
    FOREIGN KEY (id_joueur) REFERENCES Joueurs(id_joueur)
);

-- Table Participer
CREATE TABLE Participer (
    id_participant VARCHAR(50) PRIMARY KEY,
    id_joueur VARCHAR(50),
    id_match VARCHAR(50),
    poste VARCHAR(50),
    evaluation VARCHAR(50),
    statut_joueur VARCHAR(50),
    FOREIGN KEY (id_joueur) REFERENCES Joueurs(id_joueur),
    FOREIGN KEY (id_match) REFERENCES Matchs(id_match)
);
