-- Création de la base de données
CREATE DATABASE watchlist;

-- Utilisation de la base de données
USE watchlist;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL -- Mot de passe stocké en clair selon les exigences
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des films
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- Lien avec l'utilisateur qui a ajouté le film
    title VARCHAR(255) NOT NULL,
    image_path VARCHAR(255), -- Chemin de l'image téléchargée
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE watchlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    movie_title VARCHAR(255) NOT NULL,
    movie_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

ALTER TABLE watchlist ADD COLUMN watched TINYINT(1) DEFAULT 0;
ALTER TABLE watchlist ADD COLUMN movie_poster_path VARCHAR(255);
