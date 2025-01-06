<?php
require_once 'config.php';
session_start();

// Vérification de la connexion pour navigation dynamique
$is_logged_in = isset($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: watchlist.php');
        exit;
    } else {
        $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Watchlist</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur votre Watchlist</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="actions/search.php">Rechercher un film</a></li>
                <li><a href="watchlist.php">Ma Watchlist</a></li>
                <?php if ($is_logged_in): ?>
                    <!-- Si l'utilisateur est connecté, afficher le bouton de déconnexion -->
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php else: ?>
                    <!-- Si l'utilisateur n'est pas connecté, afficher les boutons de connexion et d'inscription -->
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="register.php">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Gérez vos films préférés facilement !</h2>
            <p>Recherchez des films, ajoutez-les à votre Watchlist et accédez-y à tout moment.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Gestion de Watchlist. Tous droits réservés.</p>
    </footer>
</body>
</html>
