<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer les films de la watchlist de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM watchlist WHERE user_id = :user_id');
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$watchlist = $stmt->fetchAll();

// Suppression d'un film
if (isset($_GET['remove'])) {
    $movie_id = (int)$_GET['remove'];
    $stmt = $pdo->prepare('DELETE FROM watchlist WHERE user_id = :user_id AND movie_id = :movie_id');
    $stmt->execute(['user_id' => $_SESSION['user_id'], 'movie_id' => $movie_id]);
    header('Location: watchlist.php');
    exit;
}

// Marquer un film comme regardé
if (isset($_GET['watch'])) {
    $movie_id = (int)$_GET['watch'];
    $stmt = $pdo->prepare('UPDATE watchlist SET watched = 1 WHERE user_id = :user_id AND movie_id = :movie_id');
    $stmt->execute(['user_id' => $_SESSION['user_id'], 'movie_id' => $movie_id]);
    header('Location: watchlist.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Watchlist</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header>
        <h1>Ma Watchlist</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="actions/search.php">Rechercher un film</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Vos films</h2>
            <?php if (!empty($watchlist)): ?>
                <ul>
                    <?php foreach ($watchlist as $movie): ?>
                        <li>
                            <!-- Affichage de l'image et du titre du film -->
                            <img src="https://image.tmdb.org/t/p/w500<?= $movie['movie_poster_path']; ?>" alt="<?= htmlspecialchars($movie['movie_title']); ?>" width="100">
                            <?= htmlspecialchars($movie['movie_title']); ?>

                            <?php if ($movie['watched'] == 0): ?>
                                <!-- Lien pour marquer comme regardé -->
                                <a href="watchlist.php?watch=<?= $movie['movie_id']; ?>">Marquer comme regardé</a>
                            <?php else: ?>
                                <!-- Statut de film regardé -->
                                <span>(Déjà vu)</span>
                            <?php endif; ?>

                            <!-- Lien pour supprimer un film -->
                            <a href="watchlist.php?remove=<?= $movie['movie_id']; ?>">Supprimer</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Votre Watchlist est vide.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Gestion de Watchlist. Tous droits réservés.</p>
    </footer>
</body>
</html>
