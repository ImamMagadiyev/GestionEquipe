# ⚽ GestionEquipe – Système de Gestion de Club de Football

> **Projet académique réalisé en équipe de deux développeurs dans le cadre du BUT Informatique.**

L'application **GestionEquipe** est une solution complète développée en PHP permettant aux entraîneurs de piloter leur effectif, de préparer les feuilles de match dynamiquement et de suivre les performances via des statistiques détaillées.

---

## 👥 Équipe de Développement
Ce projet a été conçu et réalisé par :
* **Imam Magadiyev**
* **Adrien Basset**

---

## 🚀 Fonctionnalités Clés

### 🏃 Gestion des Joueurs
* **CRUD complet** : Ajout, modification, suppression et liste des joueurs.
* **Suivi physique** : Taille, poids et caractéristiques sportives.
* **Évaluations** : Historique des commentaires et notes de l'entraîneur.

### 📅 Gestion des Matchs & Préparation
* **Planification** : Gestion des adversaires, lieux et résultats.
* **Feuille de match interactive** : Sélection des titulaires et remplaçants par poste.
* **Validation métier** : Vérification du nombre minimum de joueurs avant validation.

### 📊 Statistiques & Performances
* **Tableau de bord** : Ratio victoires, défaites et matchs nuls.
* **Fiches individuelles** : Moyenne des évaluations et pourcentage de matchs gagnés par joueur.

### 🔐 Sécurité & Design
* **Authentification** : Accès restreint via sessions PHP (Login/Password).
* **Interface Moderne** : Design sombre (Dark Mode) élégant et responsive.

---

## 🛠️ Stack Technique

| Technologie | Usage |
| :--- | :--- |
| **PHP 8+** | Logique métier et moteur de l'application |
| **MySQL** | Base de données relationnelle (PDO) |
| **Architecture MVC** | Séparation Modèle-Vue-Contrôleur |
| **CSS3 Custom** | Design System personnalisé et adaptatif |

---

## 📂 Architecture du Projet

Le projet respecte une structure de dossiers organisée pour la maintenabilité :

```text
GestionEquipe/
├── index.php             # Page d'accueil et point d'entrée
├── ProjetFoot.sql        # Schéma complet de la base de données
├── /modele               # Classes métiers et accès aux données (DAO)
├── /controleur           # Logique de traitement (Joueurs, Matchs, Stats)
├── /vue                  # Templates HTML et rendu utilisateur
├── /connexion            # Authentification et gestion des sessions
├── /bd                   # Configuration de la connexion PDO
└── /Assets               # Ressources (Logos et images)
