

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="actions/search.php">Rechercher un film</a></li>
                <li><a href="watchlist.php">Ma Watchlist</a></li>
                <li><a href="login.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Créer un compte</h2>
            <form action="actions/process_register.php" method="POST">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">S'inscrire</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Gestion de Watchlist. Tous droits réservés.</p>
    </footer>
</body>
</html>
