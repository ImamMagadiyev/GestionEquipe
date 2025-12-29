<?php require 'connexion/verificationConnexion.php'; ?>

<nav class="navbar">
    <a href="/GestionEquipe/index.php" class="navbar-logo">
        <img src="/GestionEquipe/Assets/logo.png" alt="Logo équipe" />
        <span>Mon Équipe</span>
    </a>

    <input type="checkbox" id="menu-toggle" class="menu-toggle-input">
    <label for="menu-toggle" class="menu-icon">☰</label>

    <ul class="navbar-menu">
        <li><a href="/GestionEquipe/index.php">🏠 Accueil</a></li>
        <li><a href="/GestionEquipe/vue/Joueur/liste.php">👥 Joueurs</a></li>
        <li><a href="/GestionEquipe/vue/Match/liste.php">📅 Matchs</a></li>
        <li><a href="/GestionEquipe/vue/Match/choisir_match.php">⚽ Préparer</a></li>
        <li><a href="/GestionEquipe/controleur/GestionStatistique.php">📊 Stats</a></li>
        <li class="nav-separator"></li>
        <li><a href="/GestionEquipe/connexion/deconnexion.php" class="nav-logout">🚪 Déconnexion</a></li>
    </ul>
</nav>
