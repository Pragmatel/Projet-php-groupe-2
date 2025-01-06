<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['movie_id'])) {
    header('Location: ../search.php');
    exit;
}

$movie_id = $_GET['movie_id'];

// Récupérer les informations sur le film via l'API TMDb
$api_key = '4b114c901598b6d2f01bd198af8b89b1';
$api_url = 'https://api.themoviedb.org/3/movie/' . $movie_id . '?api_key=' . $api_key;
$response = file_get_contents($api_url);
$movie = json_decode($response, true);

// Vérifier si les informations du film sont récupérées
if (isset($movie['id'])) {
    $movie_title = $movie['title'];
    $movie_poster_path = $movie['poster_path']; // Chemin de l'image du film

    // Insérer le film dans la base de données
    $stmt = $pdo->prepare('INSERT INTO watchlist (user_id, movie_id, movie_title, movie_poster_path) VALUES (:user_id, :movie_id, :movie_title, :movie_poster_path)');
    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
        'movie_id' => $movie['id'],
        'movie_title' => $movie_title,
        'movie_poster_path' => $movie_poster_path
    ]);

    header('Location: ../watchlist.php');
    exit;
} else {
    echo "Erreur lors de la récupération des informations du film.";
}
?>
