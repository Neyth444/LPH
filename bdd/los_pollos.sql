-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 02 avr. 2025 à 00:21
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `los_pollos`
--

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `items` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `nom`, `description`, `prix`, `items`) VALUES
(1, 'Menu Classique', 'Un classique indémodable pour les amoureux du poulet frit.', 12.90, '[\"Poulet frit classique\",\"Frites maison\",\"Sauce barbecue\",\"Walter White Juice\"]'),
(2, 'Menu Épicé', 'Une version relevée pour les amateurs de sensations fortes.', 14.90, '[\"Poulet frit épicé\",\"Frites épicées maison\",\"Sauce piquante maison\",\"Jesse Juice\"]'),
(3, 'Menu Famille', 'Idéal pour partager un bon moment en famille.', 24.90, '[\"Bucket familial de poulet frit\",\"Grande portion de frites\",\"Assortiment de sauces\",\"4 boissons au choix\",\"Dessert familial\"]'),
(4, 'Menu Spécial Gus', 'Le menu signature de Gustavo, raffiné et exclusif.', 19.90, '[\"Poulet gourmet signature Gus\",\"Pommes de terre au four\",\"Sauce spéciale Gustavo\",\"Gustavo Juice\"]'),
(5, 'Menu Spécial Vegan', 'Une alternative gourmande et respectueuse des animaux.', 14.90, '[\"Burger steak de soja\",\"Frites maison\",\"Sauce pommes frites\",\"Skyler Juice\"]');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_reservation` date NOT NULL,
  `service` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `nom`, `email`, `date_reservation`, `service`, `date_created`) VALUES
(1, 'a', 'a@b.com', '2025-11-12', '10h-14h', '2025-04-01 21:24:15'),
(2, 'j\'en peux plus', 'rendezmoimonsommeil@gmail.com', '2025-04-17', '14h-20h', '2025-04-02 00:20:33');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
