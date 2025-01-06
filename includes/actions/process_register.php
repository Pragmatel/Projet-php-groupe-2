<?php
require_once '../config.php'; // Assure-toi que le chemin est correct
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    // Vérification des champs vides
    if (empty($username) || empty($password)) {
        die('Veuillez remplir tous les champs.');
    }

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparation et exécution de la requête
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
    try {
        $stmt->execute([
            'username' => $username,
            'password' => $hashed_password,
        ]);
        header('Location: ../login.php'); // Redirige vers la page de connexion après inscription
        exit;
    } catch (PDOException $e) {
        // Gestion des erreurs SQL
        if ($e->getCode() === '23000') {
            die('Ce nom d\'utilisateur existe déjà. Veuillez en choisir un autre.');
        }
        die('Erreur lors de l\'inscription : ' . $e->getMessage());
    }
} else {
    die('Méthode non autorisée.');
}
?>
