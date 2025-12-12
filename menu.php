<?php require 'connexion/verificationConnexion.php'; ?>

<nav class="navbar">

    <div class="navbar-logo">
        <img src="/GestionEquipe/assets/logo.png" alt="Logo équipe" />
        <span>Mon Équipe</span>
    </div>

    <!-- Menu toggle -->
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">&#9776;</label>

    <ul class="navbar-menu">
        <li><a href="/GestionEquipe/index.php">Accueil</a></li>
        <li><a href="/GestionEquipe/vue/Joueur/liste.php">Liste des joueurs</a></li>
        <li><a href="/GestionEquipe/vue/Match/liste.php">Liste des matchs</a></li>
        <li><a href="/GestionEquipe/vue/Match/choisir_match.php">Préparer un match</a></li>
        <li><a href="/GestionEquipe/vue/statistiques.php">Statistiques</a></li>
        <li><a href="/GestionEquipe/connexion/deconnexion.php">Déconnexion</a></li>
    </ul>

</nav>
