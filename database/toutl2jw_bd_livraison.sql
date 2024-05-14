-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 12 juil. 2022 à 15:48
-- Version du serveur :  5.7.23-23
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `toutl2jw_bd_livraison`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `id` int(11) NOT NULL,
  `id_liv` int(11) NOT NULL,
  `duree` varchar(30) DEFAULT NULL,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `Tarif` varchar(11) DEFAULT NULL,
  `actif` varchar(11) NOT NULL DEFAULT 'encours'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `id_liv`, `duree`, `debut`, `fin`, `Tarif`, `actif`) VALUES
(1, 7, '1 mois', '2021-04-26', '2021-05-26', '10000', 'encours'),
(2, 1, '1 mois', '2022-07-12', '2022-08-11', '10000', 'encours');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloque` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non',
  `active` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'oui'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `identifiant`, `password`, `bloque`, `active`) VALUES
(1, 'admin', '33d39359320ecbb032ef96be39774c9694dad0c5', 'non', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `admincli`
--

CREATE TABLE `admincli` (
  `id` int(11) NOT NULL,
  `idfcli` int(11) NOT NULL,
  `idfcompteur` int(11) NOT NULL,
  `idfsession` int(11) NOT NULL,
  `domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `adminliv`
--

CREATE TABLE `adminliv` (
  `id` int(11) NOT NULL,
  `idfLiv` int(11) NOT NULL,
  `idfcompteur` int(11) NOT NULL,
  `idfsession` int(11) NOT NULL,
  `domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `IDCLI` int(11) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `societe` varchar(60) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `identifiant` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Abonne` varchar(5) NOT NULL DEFAULT 'non',
  `Active` varchar(5) NOT NULL DEFAULT 'oui',
  `bloque` varchar(11) NOT NULL DEFAULT 'non',
  `IDCOM` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`IDCLI`, `nom`, `prenom`, `societe`, `tel`, `adresse`, `mail`, `identifiant`, `password`, `Abonne`, `Active`, `bloque`, `IDCOM`) VALUES
(1, 'TEST', 'TEST', 'TEST', '780000000', 'TEST', 'TEST@GMAIL.COM', 'Test', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui', 'non', NULL),
(2, 'FALL ', 'KHALIFA ABABACAR', 'CLIENT', '774844284', 'DAKAR PARCELLE ', 'KHALIFADEVELOPPEUR96@GMAIL.COM', 'Khalifa12', '636e2162098b57507ae47edb40ccf7f150735ae3', 'non', 'oui', 'non', '5'),
(3, 'SOW ', 'DJIBY ', 'CLIENT', '773237124', 'GUEULE TAPEE ', 'DSOW00831@GMAIL.COM', 'Djiby', '1a6c08e291bacbb1340352813f448e275f3bcc7d', 'non', 'oui', 'non', '5'),
(4, 'GAYE', 'ABY', 'CLIENTE', '786038281', 'KEUR MASSAR CITE GENDARMERIE ', 'ABYGAYE49@GMAIL.COM', 'Aby', '168e42f7909666b01f3db1e55f305f835e1d6c29', 'non', 'oui', 'non', '5'),
(5, 'GUEYE', 'SERIGNE AHMADOU', 'CLIENT', '777165873', 'DIAMGUEUNE', 'AHMAT7TIGEN@GMAIL.COM', 'Ahmadou', '2130e7a6c02470de2d814103d239a5c8474154ca', 'non', 'oui', 'non', '5'),
(6, 'AMADOU', 'DIENG', 'DIDACTIKOS', '784524474', 'CASTOR, , KHAR YALLA', 'ELMOOHDIENG1998@GMAIL.COM', 'elmooh98', '22f5a50a5f451a7c13b2d763cd70152fc229363a', 'non', 'oui', 'non', NULL),
(7, 'DIAHAM', 'HAMIDOU PAUL', 'KHADIJA ET SES DéLICES', '774951022', 'DAKAR NORD FOIRE', 'DIAHAMHAMIDOU99@GMAIL.COM', 'Hamidou', '86441e2a73c6aaf2fc23158af8a657231a89a7f6', 'non', 'oui', 'non', '5'),
(8, 'BA', 'ABDOU', 'ZIZA VISION', '771319695', 'PIRE/MBANE', 'ABDOUBA2018125@GMAIL.COM', '', '435e593533993abd26b9cd58da7ec593f72edeb8', 'non', 'oui', 'non', NULL),
(9, 'SAGNA', 'THEOPHILE EDOUARD', 'ECOD', '770362491', 'CITé SOPRIM', 'BILATEBOUNAPI@GMAIL.COM ', 'Edouard', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'non', 'non', NULL),
(10, 'DIOUF ', 'PAPE ABDOULAYE ', 'CLIENT', '764264935', 'THIES DIASAP ', 'DIOUFPAPEABDOULAYE94@GMAIL.COM', 'Abdoulaye', '0ff735d050130ee84b0789ebdc90f5f06c2a6e2c', 'non', 'oui', 'non', '5'),
(11, 'SARR', 'MOUHAMADOU MOUSTAPHA', '', '785203746', 'TIVAOUANE', 'MOUSTAPHASARR835@GMAIL.COM', 'moustaphasarr835', '9aa06d0120cc80349c69d10a581a598ebfe0e453', 'non', 'oui', 'non', NULL),
(12, 'DIOUF', 'AMINATA', 'COL BAYE SHOP', '770951139', 'PIKINE TALLY BOU BESS éTOITE', 'AMINATA7DIOUF@GMAIL.COM', 'colbayeshop', '11e69cd13dfdf07d48fc45e9079e7450cbb7386e', 'non', 'oui', 'non', '9'),
(13, 'FALL', 'KHALIFA ABABACAR', 'CLIENT', '774844284', 'TIV4767', 'KHALIFADEVELOPPEUR96@GMAIL.COM', 'khalifa12', '31d91f7fd59a55b256ae0301481df326b8b2d73c', 'non', 'oui', 'non', NULL),
(14, 'DIOUF', 'ABDOULAYE', 'CLIENT', '764264935', 'THIES DIASAP', 'DIOUFPAPEABDOULAYE94@GMAIL.COM', 'Abdoulaye', 'd38dd6843de68e22514ba13363b34e893be052a8', 'non', 'oui', 'non', NULL),
(15, 'MBAYE', 'SERIGNE MOR DIARRA', 'DSS', '774986210', 'DIOURBEL', 'BIGMORSTAR@GMAIL.COM ', 'big', '58fe6fce188b080e0080ad19d558549c37e9fc01', 'non', 'oui', 'non', NULL),
(16, 'DIOP', 'OUSMANE', 'SENEGALAIS', '772838760', 'GUEDIEWAYE', 'DIOPY0099@GMAIL.COM', '1589200200366', '51e55817aac55c6ca74a386cded3507f7d57828d', 'non', 'oui', 'non', '7'),
(17, 'SY', 'MAMADOU MBEMBA', 'SENEGALAIS', '770935012', 'MEDINA', 'WESTSY301@GMAIL.COM', '1392199601494', 'dd63f3996feae311aae4db8a712f38457a5ac8ef', 'non', 'oui', 'non', '7'),
(18, 'NDIAYE', 'BLONDIN', 'DGID', '776509936', 'OUEST FOIRE', 'BLONDI4@GMAIL.COM', 'Abdallah', 'd125fa0cb6f9081ca96661f00d4f59a3283459d7', 'non', 'oui', 'non', '5'),
(19, 'DIOP', 'AISSATOU', 'CACO SA', '776259225', 'OUEST FOIRE LOT D', 'AISSATOUJOIEDIOP@GMAIL.COM', 'Adiop90', '68b3b442cd845cd465221f4559e48e442109de60', 'non', 'oui', 'non', '5'),
(20, 'HGCCH', 'VJHVJH', 'JHVJH', '765432132', 'IUGIGIUGIU', '', 'Test', '1a06cf99bc0ba5037ca3c5b7f26aa7c40553e816', 'non', 'oui', 'non', NULL),
(21, 'DIOUF', 'ADAMA ', 'RESPONSABLE MORAL ', '774488107', 'PIKINE ', 'ADAMA_DIOUF82@HOTMAIL.COM', 'Adama ', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui', 'non', '9'),
(22, 'NDIAYE', 'MASAER', 'SOUKAYNA BOUTIQUE', '775457701', 'GUEDIAWAYE', 'MASAERNDIAYE@HOTMAIL.COM', 'Masaer', 'e311e0e9db643357e76afbfc5e3c5502e3ea1bf9', 'non', 'oui', 'non', '9'),
(23, 'NDIAYE', 'ABDOU NDOUR', 'CLIENT', '775993234', 'MBOUR', 'NDIAYEABDOUNDOUR@ICLOUD.COM', 'Abdou', '0a02fc9aad800a65f684c7079584545e004b2168', 'non', 'oui', 'non', '5'),
(24, 'KA', 'DIOUBAIROU ', 'SéNéGALAIS ', '771257730', 'PARCELLES UNITéS 21', 'KADIOUBEIROU540@GMAIL.COM', 'Diou', '0852755108c1b890c227bd2870765fcc3cca711a', 'non', 'oui', 'non', NULL),
(25, 'KANE', 'BASSIROU', '', '774692384', 'FANN', 'BASSEKAN023@GMAIL.COM', 'Kanebass', '30ec836b63a7065ca0562f20c518f7b266f330bb', 'non', 'oui', 'non', NULL),
(26, 'TALL', 'IBRAHIMA', '', '770570570', 'DAKAR, OUAKAM', 'PAIBOUTALL@GMAIL.COM', 'PainThonNen', 'aeba238cf87d970cb2cc122a6e2489d7268f23b7', 'non', 'oui', 'non', NULL),
(27, 'SECK', 'PAPA IBRAHIMA', '', '777612940', 'MERMOZ', 'PAPEIBRAHIMASECK14@GMAIL.COM', 'papeibrahimaseck14', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui', 'non', NULL),
(28, 'DO', 'LAMINE', 'SENTECH SPORT', '778012972', '', 'ACADEMY.DIGITALE@GMAIL.COM', 'Sentech', '668753ad085b96f8b94179d2dfbfc244f0c58de0', 'non', 'oui', 'non', NULL),
(29, 'GRICOURT', 'FABIEN ', '', '614378873', '2, RUE DES VENDANGES ', 'FABIENGRICOURT1@GMAIL.COM', 'fabiengricourt1@gmail.com', '17bc8b8989fd14910b5c68735f279d7c8e77b2f1', 'non', 'oui', 'non', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commerciaux`
--

CREATE TABLE `commerciaux` (
  `IDCOM` int(11) NOT NULL,
  `nom_com` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_com` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_com` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_com` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifiant` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bloque` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non',
  `active` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'oui'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commerciaux`
--

INSERT INTO `commerciaux` (`IDCOM`, `nom_com`, `prenom_com`, `tel_com`, `adresse_com`, `identifiant`, `password`, `bloque`, `active`) VALUES
(1, 'SAGNA', 'JEANNOT', '765727203', 'HLM GRAND YOFF', 'nauje', '70f52d9670868bd1ea003495ea41f83ad519283e', 'non', 'oui'),
(2, 'BOUASSE BU KOMBILE', 'CHARLES-HARIS', '785266937', 'SACRE COEUR3', 'charles', 'a8542d99edaefb17fd8919e9fc8fadadf4585c08', 'non', 'oui'),
(3, 'DIALLO', 'AMADOU BODO', '775836823', 'MEDINA', 'bobo', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui'),
(4, 'BADIANE', 'MOUHAMADOU MOUSTAPHA ', '774324390', 'THIES', 'badiane', '5ee7803a35ce21149c9dc328fbc789505f01e9e7', 'non', 'oui'),
(5, 'FALL', 'KHALIFA ABABACAR', '774844284', 'DAKAR', 'khalifa', 'ac4ccdcfb5ca7b41c2b4d2ba484a4a9af3f4f7e2', 'non', 'oui'),
(6, 'SECK', 'ABDOULAYE', '770718199', 'THIES', 'abdoulaye', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui'),
(7, 'SAMB', 'HAMATH', '773603118', 'DAKAR', 'hamath', '8ced5771091abbbfea2a2bec222e7185aaf2d5d7', 'non', 'oui'),
(8, 'SENE', 'MODOU', '776265922', 'DAKAR', 'modou', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui'),
(9, 'DIOUF', 'AMINATA', '770951139', 'PIKINE', 'aminata', '518372eaee1816c0b579e75c332b1cfe9db2aab1', 'non', 'oui'),
(10, 'DOUMBOUYA', 'MOUHAMADOU MOUSTAPHA', '771297917', 'CITé BIAGUI YOFF', 'doumbouya', '6329c01b4c0d83996f98ec5a96587974f1e4ff14', 'non', 'oui'),
(11, 'DIALLO', 'IBRAHIMA KHALIL', '775749712', 'CITE ASECNA YEUMBEUL', 'khalil', 'fb03fbbc5b92ae4b12bb2da5ac3d184ba59ea528', 'oui', 'oui'),
(12, 'DIALLO', 'IBRAHIMA KHALIL', '775749712', 'CITE ASSECNA YEUMBEUL', 'khalil', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui'),
(13, 'BADIANE', 'BIRANE', '775167166', 'GRAND YOFF', 'badiane1', '2df2664b438cfc8bc35f01f1860defa72a2cf525', 'non', 'oui'),
(14, 'GAYE', 'ASTOU MBACKE', '779063300', 'PIKINE', 'astou', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui'),
(15, 'SAGNA', 'TéOPHILE EDOUARD', '770362491', 'PA', 'bounapi', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui'),
(16, 'DIALLO', 'MAMADOU LAMINE', '773279928', 'DK', 'lamine', '1bb4cc12b7b6d1b2c685c166ac66a4a13de53514', 'non', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `compteur`
--

CREATE TABLE `compteur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `livreur` varchar(50) NOT NULL,
  `client` varchar(50) NOT NULL,
  `compte` varchar(50) NOT NULL,
  `zone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `idflogin` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `connecte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `typecontrat` varchar(50) NOT NULL,
  `typeclient` varchar(50) NOT NULL,
  `domaineclient` varchar(60) NOT NULL,
  `duree` varchar(60) NOT NULL,
  `encour` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Depense`
--

CREATE TABLE `Depense` (
  `id` int(11) NOT NULL,
  `id_liv` int(11) NOT NULL,
  `frais_commande` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `date_depense` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `espacemembre`
--

CREATE TABLE `espacemembre` (
  `id` int(11) NOT NULL,
  `numero1` varchar(25) NOT NULL,
  `numeroFixe` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `idfliv` int(11) NOT NULL,
  `numero2` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `IDCOLIS` int(11) NOT NULL,
  `IDCLI` int(11) DEFAULT NULL,
  `IDLIV` int(11) DEFAULT NULL,
  `typescolis` varchar(30) DEFAULT NULL,
  `poids` varchar(30) DEFAULT NULL,
  `volume` varchar(30) DEFAULT NULL,
  `adresseOrig` varchar(30) DEFAULT NULL,
  `adresseLivraison` varchar(25) DEFAULT NULL,
  `nbColis` int(11) DEFAULT NULL,
  `Statut` varchar(15) NOT NULL DEFAULT 'Non Livré',
  `Description` varchar(200) DEFAULT NULL,
  `TypeVehicule` varchar(30) DEFAULT NULL,
  `Annuler` varchar(3) NOT NULL DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`IDCOLIS`, `IDCLI`, `IDLIV`, `typescolis`, `poids`, `volume`, `adresseOrig`, `adresseLivraison`, `nbColis`, `Statut`, `Description`, `TypeVehicule`, `Annuler`) VALUES
(1, 5, NULL, 'LIVRES', 'SUPERIEUR à 10T', 'VOLUME 4', '', '', 10, 'Non Livré', 'MANUELS', 'CAMION POIDS LOURD (SEMI-REMOR', 'non'),
(2, 1, NULL, 'FRAGILE', 'ENTRE 5KG ET 10KG', 'VOLUME 1', '', '', 2, 'Non Livré', 'ALIMENTAIRE, PAIN', 'CAMIONNETTE', 'non'),
(4, 1, NULL, 'FRAGILE', 'ENTRE 5KG ET 10KG', 'VOLUME 2', 'HLM GRAND YOFF', 'ENTREE', 2, 'Non Livré', 'FAIRE ATTENTION', 'MOTO à 2 ROUES', 'non'),
(5, 1, NULL, 'FRAGILE', 'INFERIEUR à 1 KG', 'VOLUME 1', 'MéDINA RUE 7', 'OUAKAM', 3, 'Non Livré', 'VERRE', 'FOURGONNETTE', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

CREATE TABLE `livreur` (
  `IDLIV` int(11) NOT NULL,
  `nomliv` varchar(25) DEFAULT NULL,
  `prenomliv` varchar(30) DEFAULT NULL,
  `telliv` varchar(20) DEFAULT NULL,
  `cni` varchar(25) DEFAULT NULL,
  `typeVehicule` varchar(30) DEFAULT NULL,
  `imatVehicule` varchar(25) DEFAULT NULL,
  `capacite` varchar(25) DEFAULT NULL,
  `Numero_permis` varchar(15) DEFAULT NULL,
  `Numero_assurance_en_cours` varchar(15) DEFAULT NULL,
  `Date_validite` date DEFAULT NULL,
  `type_permis` varchar(30) DEFAULT NULL,
  `photo_permis` varchar(100) DEFAULT NULL,
  `identifiant` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `Abonne` varchar(11) NOT NULL DEFAULT 'non',
  `active` varchar(11) NOT NULL DEFAULT 'oui',
  `bloque` varchar(11) NOT NULL DEFAULT 'non',
  `IDCOM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livreur`
--

INSERT INTO `livreur` (`IDLIV`, `nomliv`, `prenomliv`, `telliv`, `cni`, `typeVehicule`, `imatVehicule`, `capacite`, `Numero_permis`, `Numero_assurance_en_cours`, `Date_validite`, `type_permis`, `photo_permis`, `identifiant`, `password`, `Abonne`, `active`, `bloque`, `IDCOM`) VALUES
(1, 'TESTLIVREUR', 'TESTLIVREUR', '780000000', 'CNI12345', 'FOURGONNETTE', 'CDE12DD11', '150KG', '12221134', '234321', '2022-09-22', 'GATéGORIE A', 'TESTLIVREURTESTLIVREUR780000000.', 'TestLivreur', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui', 'non', NULL),
(2, 'SAGNA', 'THEOPHILE  EDOUARD', '770362491', '1070197400447', 'MOTO', 'ZG 4975B', '50KG', '10341853', '', '2029-09-25', 'GATéGORIE A', 'SAGNATHEOPHILE  EDOUARD770362491.', 'edouard', 'a7abad6162a1a3b8bfe603467ff907c7ba2ee889', 'non', 'oui', 'non', 1),
(3, 'NDOYE', 'MAMADOU', '772096632', '1751198801458', 'MOTO', '', '2 PLACES', '10238475', '', '2029-07-01', 'GATéGORIE B', 'NdoyeMamadou772096632.jpg', 'Ndoye', '9a6a04a14f3103bca304d16f75777e60f850f67f', 'non', 'oui', 'non', 7),
(4, 'NDIAYE', 'ABDOU NDOUR', '775993234', '1671199600478', 'MOTO', '', '110KG', '', '', '0000-00-00', 'PAS DE PERMIS', 'NdiayeAbdou Ndour775993234.jpeg', 'Abdou', '81e87a5b84d19463c68c66f9a0eb9e4ade212579', 'non', 'oui', 'non', NULL),
(5, 'BADIANE', 'IBRAHIMA', '783754182', '1001199802994', 'MOTO', '', '50KG', '10474581', '', '2029-12-12', 'GATéGORIE A', 'BADIANEibrahima783754182.jpeg', 'thiakthiakinternational', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui', 'non', 1),
(6, 'LY', 'PAPE IBRAHIMA', '778079999', '1910200302073', 'MOTO', '', '50KG', '', '', '2027-12-27', 'PAS DE PERMIS', 'LYPAPE IBRAHIMA778079999.', 'tiaktiaknational', '53c629c5ca5ce3d9842ae5786b9a09bc98132799', 'non', 'oui', 'non', 1),
(7, 'LIVREUR', 'LIVREUR1', '770951139', '2610199900158', 'MOTO', '', '', '', '', '2021-03-28', 'PAS DE PERMIS', 'Livreurlivreur1770951139.', 'LIVREUR', '8631f8492bf14fa8950d4b527a3f7e4e4a0bfe6f', 'non', 'oui', 'non', 9),
(8, 'TAMBA', 'MOR', '785376178', '1648199600922', 'MOTO', '', '120', '', '', '2028-04-29', 'PAS DE PERMIS', 'TambaMor785376178.', 'Mor', 'af30287a06e45ceea0569c2112ac6c80255a2bcf', 'non', 'oui', 'non', 5),
(9, 'SAGNA', 'JEANNOT', '779461443', '1070197400447', 'MOTO', 'ZG 4975B', '50KG', '', '', '0000-00-00', 'GATéGORIE A', 'sagnajeannot779461443.', 'nauje', '70f52d9670868bd1ea003495ea41f83ad519283e', 'non', 'non', 'non', NULL),
(10, 'SAGNA', 'JEANNOT', '765727203', '1070197400447', 'MOTO', '', '50KG', '', '', '0000-00-00', 'GATéGORIE A', 'sagnajeannot765727203.', 'jsstaftaf', '70f52d9670868bd1ea003495ea41f83ad519283e', 'non', 'oui', 'non', 1);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(60) NOT NULL,
  `idforeign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `pseudo`, `password`, `email`, `idforeign`) VALUES
(1, 'sarr', 'sarr50', '', 0),
(2, 'sarr10', '594208001B37E1BFBE569529FAB576E9593BCF27EEC00927001CED331292066868780B52', '', 0),
(3, 'sarr', '910C74D634A6424D03BD4B6E7425E93C9111A9357E90C686D6D0386D6620B83B812FE07B', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `prix_commande`
--

CREATE TABLE `prix_commande` (
  `id_prix_comm` int(11) NOT NULL,
  `ID_COLIS` int(11) DEFAULT NULL,
  `prix_comm` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prix_commande`
--

INSERT INTO `prix_commande` (`id_prix_comm`, `ID_COLIS`, `prix_comm`) VALUES
(1, 1, '67000'),
(2, 2, '17000'),
(4, 3, '5000'),
(5, 5, '9000');

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `id` int(11) NOT NULL,
  `id_livreur` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_transf` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_abonn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reglement`
--

INSERT INTO `reglement` (`id`, `id_livreur`, `type`, `prix`, `tel_transf`, `id_abonn`) VALUES
(1, 1, 'credit', '400', 'tel_ecode', NULL),
(2, 6, 'credit', '400', 'tel_ecode', NULL),
(3, 7, 'credit', '400', 'tel_ecode', NULL),
(4, 10, 'credit', '400', 'tel_ecode', NULL),
(5, 9, 'credit', '400', 'tel_ecode', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reglement_inter`
--

CREATE TABLE `reglement_inter` (
  `id` int(11) NOT NULL,
  `id_livreur` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_transf` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `livreur` varchar(50) NOT NULL,
  `client` varchar(50) NOT NULL,
  `bloquer` varchar(50) NOT NULL,
  `fonctionnalite` varchar(50) NOT NULL,
  `allocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `pseudo`, `livreur`, `client`, `bloquer`, `fonctionnalite`, `allocation`) VALUES
(1, '', 'oui', 'non', 'non', 'null', 1),
(2, 'sarr10', 'oui', 'non', 'non', 'null', 1),
(3, 'sarr', 'oui', 'non', 'non', 'null', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tarification`
--

CREATE TABLE `tarification` (
  `id` int(11) NOT NULL,
  `origine` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_tarif` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tarification`
--

INSERT INTO `tarification` (`id`, `origine`, `destination`, `prix_tarif`) VALUES
(1, 'DAKAR', 'PIKINE', '3000'),
(2, 'DAKAR', 'GUEDIAWAYE', '4000'),
(3, 'DAKAR', 'RUFISQUE', '5000'),
(4, 'PIKINE', 'GUEDIAWAYE', '3000'),
(5, 'PIKINE', 'RUFISQUE', '4000'),
(6, 'GUEDIAWAYE', 'RUFISQUE', '4000'),
(7, 'DAKAR', 'DAKAR', '2000'),
(8, 'PIKINE', 'PIKINE', '2000'),
(9, 'GUEDIAWAYE', 'GUEDIAWAYE', '2000'),
(10, 'RUFISQUE', 'RUFISQUE', '2000');

-- --------------------------------------------------------

--
-- Structure de la table `Temps`
--

CREATE TABLE `Temps` (
  `ID_temps` int(11) NOT NULL,
  `IDCOLIS` int(11) NOT NULL,
  `IDLIV` int(11) NOT NULL,
  `temps_accept_liv` datetime DEFAULT NULL,
  `temps_colis_livre` datetime DEFAULT NULL,
  `btn_innactif` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `validation_com`
--

CREATE TABLE `validation_com` (
  `id` int(11) NOT NULL,
  `IDCOLIS` int(11) NOT NULL,
  `IDLIV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule_tarif`
--

CREATE TABLE `vehicule_tarif` (
  `id` int(11) NOT NULL,
  `vehicule` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicule_tarif`
--

INSERT INTO `vehicule_tarif` (`id`, `vehicule`, `prix`) VALUES
(1, 'moto à 3 roues', '5000'),
(2, 'fourgonnette', '7000'),
(3, 'grand fourgon', '9000'),
(4, 'camionnette', '15000'),
(5, 'petit camion', '15000'),
(6, 'camion poids lourd 5t', '35000'),
(7, 'camion poids lourd 10t', '45000'),
(8, 'camion poids lourd (semi-remorque)', '65000'),
(9, 'moto à 2 roues', '0'),
(10, 'velo', '0'),
(11, 'charette', '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admincli`
--
ALTER TABLE `admincli`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `adminliv`
--
ALTER TABLE `adminliv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`IDCLI`);

--
-- Index pour la table `commerciaux`
--
ALTER TABLE `commerciaux`
  ADD PRIMARY KEY (`IDCOM`);

--
-- Index pour la table `compteur`
--
ALTER TABLE `compteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Depense`
--
ALTER TABLE `Depense`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`IDCOLIS`);

--
-- Index pour la table `livreur`
--
ALTER TABLE `livreur`
  ADD PRIMARY KEY (`IDLIV`);

--
-- Index pour la table `prix_commande`
--
ALTER TABLE `prix_commande`
  ADD PRIMARY KEY (`id_prix_comm`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reglement_inter`
--
ALTER TABLE `reglement_inter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tarification`
--
ALTER TABLE `tarification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Temps`
--
ALTER TABLE `Temps`
  ADD PRIMARY KEY (`ID_temps`);

--
-- Index pour la table `validation_com`
--
ALTER TABLE `validation_com`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicule_tarif`
--
ALTER TABLE `vehicule_tarif`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `IDCLI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `commerciaux`
--
ALTER TABLE `commerciaux`
  MODIFY `IDCOM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `Depense`
--
ALTER TABLE `Depense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `IDCOLIS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `livreur`
--
ALTER TABLE `livreur`
  MODIFY `IDLIV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `prix_commande`
--
ALTER TABLE `prix_commande`
  MODIFY `id_prix_comm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reglement_inter`
--
ALTER TABLE `reglement_inter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tarification`
--
ALTER TABLE `tarification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Temps`
--
ALTER TABLE `Temps`
  MODIFY `ID_temps` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `validation_com`
--
ALTER TABLE `validation_com`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicule_tarif`
--
ALTER TABLE `vehicule_tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
