-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 08, 2021 at 12:43 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `robeth`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
                          `id` int(11) NOT NULL,
                          `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `pseudo`, `password`, `email`, `adresse`) VALUES
                                                                                           (1, 'Thomas', 'Robert', '', '1234567890', 'thomas.robert@email.com', 'Paris1'),
                                                                                           (2, 'Quentin', 'Robert', 'quidhuitre', '1212', 'thomas.robert@email.com', 'Rue du ranelaght Paris'),
                                                                                           (3, 'David', 'Robert', 'dav', '2424', 'thomas.robert@email.com', 'Paris2');

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
                           `id` int(11) NOT NULL,
                           `id_c_id` int(11) DEFAULT NULL,
                           `id_v_id` int(11) DEFAULT NULL,
                           `date_f` date NOT NULL,
                           `valeur` int(11) NOT NULL,
                           `etat_r` tinyint(1) NOT NULL,
                           `date_d` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`id`, `id_c_id`, `id_v_id`, `date_f`, `valeur`, `etat_r`, `date_d`) VALUES
                                                                                               (1, 1, 4, '2021-10-15', 4000, 1, '2020-01-01'),
                                                                                               (2, 2, 2, '2021-11-10', 5000, 1, '2020-01-01'),
                                                                                               (3, 3, 1, '2021-11-08', 4000, 0, '2020-01-30'),
                                                                                               (4, 2, 5, '2021-10-30', 4000, 1, '2020-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE `vehicule` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `etat` tinyint(1) NOT NULL,
                            `caracteres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`id`, `name`, `photo`, `etat`, `caracteres`) VALUES
                                                                         (1, 'Peugeot 508', '/Images/Voitures/508-noir-perla-nera.jpg', 0, '[{\"moteur\" : \"hdi\", \"nbPortes\" : 5, \"couleur\" : \"noire\", \"option\" : \"cuire\", \"carburant\" : \"diesel\", \"autre\" : null }]'),
                                                                         (2, 'Peugeot 3008', '/Images/Voitures/peugeot-3008-bmw-q3-115.jpg', 1, '[{\"moteur\" : \"hdi2\", \"nbPortes\" : 5, \"couleur\" : \"rouge\", \"option\" : \"GPS\", \"carburant\" : \"diesel\", \"autre\" : null }]'),
                                                                         (3, 'Peugeot 5008', '/Images/Voitures/peugeot-5008-2009styp-016b.jpg', 1, '[{\"moteur\" : \"4.6l\", \"nbPortes\" : 5, \"couleur\" : \"bleu magnétique\", \"option\" : \"roue de secours\", \"carburant\" : \"diesel\", \"autre\" : null }]'),
                                                                         (4, 'Peugeot 208', '/Images/Voitures/Peugeot_208_GT_Line.jpeg', 1, '[{\"moteur\" : \"hybrid\", \"nbPortes\" : 3, \"couleur\" : \"jaune moutarde\", \"option\" : \"cuire\", \"carburant\" : \"diesel\", \"autre\" : null }]'),
                                                                         (5, 'DS', '/Images/Voitures/S0-salon-de-geneve-2020-ds-presente-la-ds9-622618.jpg', 1, '[{\"moteur\" : \"electrique\", \"nbPortes\" : 5, \"couleur\" : \"gris\", \"option\" : \"chargeurs\", \"carburant\" : \"electrique\", \"autre\" : null }]');

-- --------------------------------------------------------

--
-- Table structure for table `vendeur`
--

CREATE TABLE `vendeur` (
                           `id` int(11) NOT NULL,
                           `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `identifiant` int(11) NOT NULL,
                           `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendeur`
--

INSERT INTO `vendeur` (`id`, `nom`, `identifiant`, `password`) VALUES
                                                                   (1, 'Eric', 2000, 'eric1234'),
                                                                   (2, 'Isa', 3, 'bambou');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `UNIQ_FE8664107D30207C` (`id_v_id`),
    ADD KEY `IDX_FE8664101AF787D1` (`id_c_id`);

--
-- Indexes for table `vehicule`
--
ALTER TABLE `vehicule`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendeur`
--
ALTER TABLE `vendeur`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicule`
--
ALTER TABLE `vehicule`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendeur`
--
ALTER TABLE `vendeur`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
    ADD CONSTRAINT `FK_FE8664101AF787D1` FOREIGN KEY (`id_c_id`) REFERENCES `client` (`id`),
    ADD CONSTRAINT `FK_FE8664107D30207C` FOREIGN KEY (`id_v_id`) REFERENCES `vehicule` (`id`);
