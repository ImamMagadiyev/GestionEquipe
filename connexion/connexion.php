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
        <title>Connexion</title>
        <link rel="stylesheet" href="../style.css">

    </head>
    <body id="login-page">
        <img src="../Assets/logo.png" alt="Logo" class="logo">

        <div class="container">
            <h1>Connexion</h1>
            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="username">Identifiant :</label>
                    <input type="text" name="username" id="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Se connecter">
                </div>
            </form>
        </div>
    </body>
</html>