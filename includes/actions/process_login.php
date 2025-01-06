<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../watchlist.php');
    } else {
        echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
} else {
    die('Requête invalide.');
}
?>
