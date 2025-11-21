<?php require 'Connexion/verificationConnexion.php'; ?>

<nav class="navbar">

    <div class="navbar-logo">
        <img src="/Projet_D-veloppement_Web/assets/logo.png" alt="Logo équipe" />
        <span>Mon Équipe</span>
    </div>

    <!-- Menu toggle -->
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">&#9776;</label>

    <ul class="navbar-menu">
        <li><a href="/Projet_D-veloppement_Web/vue/Joueur/liste.php">Liste des joueurs</a></li>
        <li><a href="/Projet_D-veloppement_Web/vue/Match/liste.php">Liste des matchs</a></li>
        <li><a href="/Projet_D-veloppement_Web/vue/Participation/liste.php">Préparer un match</a></li>
        <li><a href="/Projet_D-veloppement_Web/vue/statistiques.php">Statistiques</a></li>
        <li><a href="/Projet_D-veloppement_Web/Connexion/deconnexion.php">Déconnexion</a></li>
    </ul>

</nav>
