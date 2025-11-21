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
    </head>
    <body>
        <h1>Connexion</h1>
        <?php if ($error): ?>
            <p style="color:red"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

            <form method="post">
                Identifiant : <input type="text" name="username" required><br>
                Mot de passe : <input type="password" name="password" required><br>
                <input type="submit" value="Se connecter">
            </form>
    </body>
</html>