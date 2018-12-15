-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 15 Décembre 2018 à 23:36
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `poll`
--

-- --------------------------------------------------------

--
-- Structure de la table `cardpolls`
--

CREATE TABLE IF NOT EXISTS `cardpolls` (
  `idCardPoll` int(11) NOT NULL AUTO_INCREMENT,
  `users_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idCardPoll`),
  KEY `fk_cardPolls_users1_idx` (`users_idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `idOption` int(11) NOT NULL AUTO_INCREMENT,
  `OptionName` varchar(255) DEFAULT NULL,
  `polls_idPoll` int(11) NOT NULL,
  `users_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idOption`),
  KEY `fk_options_polls1_idx` (`polls_idPoll`),
  KEY `fk_options_users1_idx` (`users_idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `idPoll` int(11) NOT NULL AUTO_INCREMENT,
  `PollName` varchar(255) DEFAULT NULL,
  `users_idUser` int(11) NOT NULL,
  PRIMARY KEY (`idPoll`),
  UNIQUE KEY `PollName_UNIQUE` (`PollName`),
  KEY `fk_polls_users_idx` (`users_idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `idVote` int(11) NOT NULL AUTO_INCREMENT,
  `users_idUser` int(11) NOT NULL,
  `options_idOption` int(11) NOT NULL,
  `cardPolls_idCardPoll` int(11) NOT NULL,
  `polls_idPoll` int(11) NOT NULL,
  PRIMARY KEY (`idVote`),
  KEY `fk_votes_users1_idx` (`users_idUser`),
  KEY `fk_votes_options1_idx` (`options_idOption`),
  KEY `fk_votes_cardPolls1_idx` (`cardPolls_idCardPoll`),
  KEY `fk_votes_polls1_idx` (`polls_idPoll`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cardpolls`
--
ALTER TABLE `cardpolls`
  ADD CONSTRAINT `fk_cardPolls_users1` FOREIGN KEY (`users_idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `fk_options_polls1` FOREIGN KEY (`polls_idPoll`) REFERENCES `polls` (`idPoll`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_options_users1` FOREIGN KEY (`users_idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `fk_polls_users` FOREIGN KEY (`users_idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_votes_cardPolls1` FOREIGN KEY (`cardPolls_idCardPoll`) REFERENCES `cardpolls` (`idCardPoll`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_votes_options1` FOREIGN KEY (`options_idOption`) REFERENCES `options` (`idOption`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_votes_polls1` FOREIGN KEY (`polls_idPoll`) REFERENCES `polls` (`idPoll`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_votes_users1` FOREIGN KEY (`users_idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
