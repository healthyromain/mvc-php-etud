-- Active: 1728207141073@@127.0.0.1@3306
-- Ce fichier sert à initialiser la base de données
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- 1. Créer la base de données 'blog'
CREATE DATABASE IF NOT EXISTS blog CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- 2. Utiliser cette base
USE blog;

-- 3. Créer la table 'billets'
CREATE TABLE `billets` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 4. Insérer des données de test
INSERT INTO `billets` (`id`, `titre`, `contenu`, `date_creation`) VALUES
(1, 'Bienvenue sur le blog de l\'AVBN !', 'Je vous souhaite à toutes et à tous la bienvenue sur le blog qui parlera de... l\'Association de VolleyBall de Nuelly !', '2022-02-17 16:28:41'),
(2, 'L\'AVBN à la conquête du monde !', 'C\'est officiel, le club a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"Association de VolleyBall de Nuelly\". Pas dur, ceci dit entre nous...', '2022-02-17 16:28:42');

-- 5. Définir la clé primaire et l’auto-incrément
ALTER TABLE `billets`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `billets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  CREATE TABLE IF NOT EXISTS comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  post_id INT NOT NULL,
  author VARCHAR(255) NOT NULL,
  comment TEXT NOT NULL,
  comment_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_comments_billets FOREIGN KEY (post_id) REFERENCES billets(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Données de test (assure-toi que les billets 1 et 2 existent)
INSERT INTO comments (post_id, author, comment, comment_date) VALUES
(1, 'Alice', 'Super article !', '2022-02-17 16:30:00'),
(1, 'Bob', 'Très intéressant.', '2022-02-17 16:31:00'),
(2, 'Charlie', 'Bienvenue sur le blog !', '2022-02-17 16:32:00');