<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'watchlist';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, 'errors.log');
    die('Erreur de connexion à la base de données.');
}

// Clé API pour The Movie Database (TMDB)
define('TMDB_API_KEY', '4b114c901598b6d2f01bd198af8b89b1');
define('TMDB_BASE_URL', 'https://api.themoviedb.org/3/');

if (!defined('TMDB_API_KEY') || !defined('TMDB_BASE_URL')) {
    die('Configuration API manquante.');
}
?>
