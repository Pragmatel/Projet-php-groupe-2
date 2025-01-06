<?php
require_once '../config.php';
session_start();

// Remplacez cette clé par votre propre clé API de TMDb
$api_key = '4b114c901598b6d2f01bd198af8b89b1';
$search_query = isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '';

// Effectuer la requête vers l'API TMDb
$api_url = 'https://api.themoviedb.org/3/search/movie?api_key=' . $api_key . '&query=' . urlencode($search_query);

$response = file_get_contents($api_url);
$movies = json_decode($response, true);

// Vérifier si des films ont été trouvés
$movies_found = isset($movies['results']) ? $movies['results'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Films</title>
    <link rel="stylesheet" href="../../assets/styles.css">
</head>
<body>
    <header>
        <h1>Recherche de Films</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="search.php">Rechercher un film</a></li>
                <li><a href="../watchlist.php">Ma Watchlist</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../logout.php">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="../login.php">Connexion</a></li>
                    <li><a href="../register.php">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <!-- Formulaire de recherche -->
            <form method="get" action="search.php">
                <input type="text" name="query" placeholder="Rechercher un film" value="<?= htmlspecialchars($search_query); ?>">
                <button type="submit">Rechercher</button>
            </form>

            <h2>Films trouvés</h2>
            <div class="movies-container">
                <?php if (!empty($movies_found)): ?>
                    <?php foreach ($movies_found as $movie): ?>
                        <div class="movie-item">
                            <a href="add_to_watchlist.php?movie_id=<?= $movie['id']; ?>">
                                <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>" alt="<?= $movie['title']; ?>">
                                <h3><?= htmlspecialchars($movie['title']); ?></h3>
                                <p>Sorti le <?= htmlspecialchars($movie['release_date']); ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun film trouvé.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Gestion de Watchlist. Tous droits réservés.</p>
    </footer>
</body>
</html>
