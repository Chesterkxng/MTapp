-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 mars 2023 à 18:11
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mtdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `aeronef`
--

CREATE TABLE `aeronef` (
  `AERONEF_ID` int(11) NOT NULL,
  `IMMATRICULATION` varchar(10) DEFAULT NULL,
  `S_N` varchar(30) DEFAULT NULL,
  `FH` decimal(6,2) DEFAULT NULL,
  `LDGS` int(11) DEFAULT NULL,
  `RH_ENG_FH` decimal(7,2) DEFAULT NULL,
  `LH_ENG_FH` decimal(7,2) DEFAULT NULL,
  `COMMISSIONING_DATE` varchar(10) DEFAULT NULL,
  `DECOMMISSIONING_DATE` varchar(10) DEFAULT NULL,
  `AVAILABILITY_STATUS` tinyint(1) DEFAULT NULL,
  `REMOVAL_STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `breakdown`
--

CREATE TABLE `breakdown` (
  `BREAKDOWN_ID` int(11) NOT NULL,
  `AERONEF_ID` int(11) NOT NULL,
  `PERSONAL_ID` int(11) NOT NULL,
  `NAME` varchar(70) DEFAULT NULL,
  `BSM_NUMBER` int(11) DEFAULT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `ACTION` text DEFAULT NULL,
  `FINDING_DATE` date DEFAULT NULL,
  `REPAIR_END_DATE` date DEFAULT NULL,
  `REPAIRING_STATUS` int(11) DEFAULT NULL,
  `REMOVAL_STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `defueling`
--

CREATE TABLE `defueling` (
  `DEFUELING_ID` int(11) NOT NULL,
  `AERONEF_ID` int(11) NOT NULL,
  `PERSONAL_ID` int(11) NOT NULL,
  `QUANTITY` decimal(6,2) DEFAULT NULL,
  `DEFUELING_DATE` date DEFAULT NULL,
  `REASON` varchar(100) DEFAULT NULL,
  `REMOVAL_STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `LOGIN_ID` int(11) NOT NULL,
  `USERNAME` varchar(25) DEFAULT NULL,
  `PASSWORD` text DEFAULT NULL,
  `SECURITY_QUESTION` varchar(100) DEFAULT NULL,
  `SECURITY_ANSWER` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `MISSION_ID` int(11) NOT NULL,
  `PERSONAL_ID` int(11) NOT NULL,
  `TYPE_ID` int(11) NOT NULL,
  `AERONEF_ID` int(11) NOT NULL,
  `DESTINATION` varchar(50) DEFAULT NULL,
  `DEPARTURE_DATE` date DEFAULT NULL,
  `RETURN_DATE` date DEFAULT NULL,
  `PASSENGERS_NUMBER` int(11) DEFAULT NULL,
  `BENEFICIARY` varchar(100) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `REMOVAL_STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `ORDER_ID` int(11) NOT NULL,
  `AERONEF_ID` int(11) NOT NULL,
  `PART_NUMBER` varchar(40) DEFAULT NULL,
  `NAME` varchar(70) DEFAULT NULL,
  `SUPPLIER` varchar(100) DEFAULT NULL,
  `PRICE` float(8,2) DEFAULT NULL,
  `QUANTITY` decimal(6,2) DEFAULT NULL,
  `ORDER_DATE` date DEFAULT NULL,
  `DELIVERY_STATUS` tinyint(1) DEFAULT NULL,
  `DELIVERY_DATE` date DEFAULT NULL,
  `REMOVAL_STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal`
--

CREATE TABLE `personal` (
  `PERSONAL_ID` int(11) NOT NULL,
  `LOGIN_ID` int(11) DEFAULT NULL,
  `GRADE` varchar(50) DEFAULT NULL,
  `FIRST_NAME` varchar(70) DEFAULT NULL,
  `SURNAME` varchar(20) DEFAULT NULL,
  `FUNCTION` varchar(30) DEFAULT NULL,
  `REMOVAL_STATUS` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `refueling`
--

CREATE TABLE `refueling` (
  `REFUELING_ID` int(11) NOT NULL,
  `AERONEF_ID` int(11) NOT NULL,
  `PERSONAL_ID` int(11) NOT NULL,
  `QUANTITY` decimal(6,2) DEFAULT NULL,
  `REFUELING_DATE` date DEFAULT NULL,
  `REMOVAL_STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`TYPE_ID`, `TYPE`) VALUES
(1, 'Transport VIP'),
(2, 'Transport de Troupes'),
(3, 'Evacuation Sanitaire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aeronef`
--
ALTER TABLE `aeronef`
  ADD PRIMARY KEY (`AERONEF_ID`);

--
-- Index pour la table `breakdown`
--
ALTER TABLE `breakdown`
  ADD PRIMARY KEY (`BREAKDOWN_ID`),
  ADD KEY `FK_AERONEF_BREAKDOWN` (`AERONEF_ID`),
  ADD KEY `FK_BREAKDOWN_PERSONAL` (`PERSONAL_ID`);

--
-- Index pour la table `defueling`
--
ALTER TABLE `defueling`
  ADD PRIMARY KEY (`DEFUELING_ID`),
  ADD KEY `FK_AERONEF_DEFUELING` (`AERONEF_ID`),
  ADD KEY `FK_PERSONAL_DEFUELING` (`PERSONAL_ID`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`LOGIN_ID`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`MISSION_ID`),
  ADD KEY `FK_AERONEF_MISSION` (`AERONEF_ID`),
  ADD KEY `FK_MISSION_PERSONAL` (`PERSONAL_ID`),
  ADD KEY `FK_MISSION_TYPE` (`TYPE_ID`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORDER_ID`),
  ADD KEY `FK_AERONEF_ORDER` (`AERONEF_ID`);

--
-- Index pour la table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`PERSONAL_ID`),
  ADD KEY `FK_LOGIN_PERSONAL` (`LOGIN_ID`);

--
-- Index pour la table `refueling`
--
ALTER TABLE `refueling`
  ADD PRIMARY KEY (`REFUELING_ID`),
  ADD KEY `FK_AERONEF_REFUELING` (`AERONEF_ID`),
  ADD KEY `FK_PERSONAL_REFUELING` (`PERSONAL_ID`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `aeronef`
--
ALTER TABLE `aeronef`
  MODIFY `AERONEF_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `breakdown`
--
ALTER TABLE `breakdown`
  MODIFY `BREAKDOWN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `defueling`
--
ALTER TABLE `defueling`
  MODIFY `DEFUELING_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `LOGIN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `MISSION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal`
--
ALTER TABLE `personal`
  MODIFY `PERSONAL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `refueling`
--
ALTER TABLE `refueling`
  MODIFY `REFUELING_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `breakdown`
--
ALTER TABLE `breakdown`
  ADD CONSTRAINT `FK_AERONEF_BREAKDOWN` FOREIGN KEY (`AERONEF_ID`) REFERENCES `aeronef` (`AERONEF_ID`),
  ADD CONSTRAINT `FK_BREAKDOWN_PERSONAL` FOREIGN KEY (`PERSONAL_ID`) REFERENCES `personal` (`PERSONAL_ID`);

--
-- Contraintes pour la table `defueling`
--
ALTER TABLE `defueling`
  ADD CONSTRAINT `FK_AERONEF_DEFUELING` FOREIGN KEY (`AERONEF_ID`) REFERENCES `aeronef` (`AERONEF_ID`),
  ADD CONSTRAINT `FK_PERSONAL_DEFUELING` FOREIGN KEY (`PERSONAL_ID`) REFERENCES `personal` (`PERSONAL_ID`);

--
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `FK_AERONEF_MISSION` FOREIGN KEY (`AERONEF_ID`) REFERENCES `aeronef` (`AERONEF_ID`),
  ADD CONSTRAINT `FK_MISSION_PERSONAL` FOREIGN KEY (`PERSONAL_ID`) REFERENCES `personal` (`PERSONAL_ID`),
  ADD CONSTRAINT `FK_MISSION_TYPE` FOREIGN KEY (`TYPE_ID`) REFERENCES `type` (`TYPE_ID`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_AERONEF_ORDER` FOREIGN KEY (`AERONEF_ID`) REFERENCES `aeronef` (`AERONEF_ID`);

--
-- Contraintes pour la table `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `FK_LOGIN_PERSONAL` FOREIGN KEY (`LOGIN_ID`) REFERENCES `login` (`LOGIN_ID`);

--
-- Contraintes pour la table `refueling`
--
ALTER TABLE `refueling`
  ADD CONSTRAINT `FK_AERONEF_REFUELING` FOREIGN KEY (`AERONEF_ID`) REFERENCES `aeronef` (`AERONEF_ID`),
  ADD CONSTRAINT `FK_PERSONAL_REFUELING` FOREIGN KEY (`PERSONAL_ID`) REFERENCES `personal` (`PERSONAL_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
