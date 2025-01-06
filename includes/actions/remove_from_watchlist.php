<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['movie_id'])) {
    $movie_id = htmlspecialchars($_POST['movie_id']);

    $stmt = $pdo->prepare('DELETE FROM watchlist WHERE user_id = :user_id AND movie_id = :movie_id');
    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
        'movie_id' => $movie_id
    ]);

    echo 'Film supprimé de votre Watchlist.';
} else {
    die('Données invalides.');
}
?>
