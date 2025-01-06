<?php
require_once 'config.php';
session_start();

// Vérification de la connexion pour navigation dynamique
$is_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header>
        <h1>Connexion</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="actions/search.php">Rechercher un film</a></li>
                <li><a href="watchlist.php">Ma Watchlist</a></li>
                <li><a href="register.php">S'inscrire</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Se connecter</h2>
            <form action="actions/process_login.php" method="POST">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Connexion</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Gestion de Watchlist. Tous droits réservés.</p>
    </footer>
</body>
</html>
