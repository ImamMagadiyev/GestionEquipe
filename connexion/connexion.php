<?php
    session_start();

    $Utilisateur = 'admin';
    $MDP = 'admin';

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === $Utilisateur && $password === $MDP) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $username;
            header('Location: ../index.php');
            exit;
        } else {
            $error = 'Identifiant ou mot de passe incorrect';
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Mon Équipe</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body id="login-page">
    
    <div class="login-wrapper">
        <div class="login-brand">
            <img src="../Assets/logo.png" alt="Logo" class="logo">
            <h2 class="brand-name">Mon Équipe</h2>
            <p class="brand-tagline">Gestion d'équipe professionnelle</p>
        </div>

        <div class="container">
            <div class="login-header">
                <h1>Connexion</h1>
                <p>Accédez à votre espace de gestion</p>
            </div>
            
            <?php if ($error): ?>
                <div class="error">
                    <span class="error-icon">⚠️</span>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="post" class="login-form">
                <div class="form-group">
                    <label for="username">
                        <span class="label-icon">👤</span>
                        Identifiant
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        placeholder="Entrez votre identifiant"
                        autocomplete="username"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <span class="label-icon">🔒</span>
                        Mot de passe
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Entrez votre mot de passe"
                        autocomplete="current-password"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Se connecter →">
                </div>
            </form>
            
            <div class="login-footer">
                <p>© 2025 Mon Équipe - Tous droits réservés</p>
            </div>
        </div>
    </div>

</body>
</html>
