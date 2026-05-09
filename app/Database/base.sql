CREATE DATABASE IF NOT EXISTS `Forage`DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

use `Forage`;

CREATE TABLE IF NOT EXISTS `users`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `gender` ENUM('male', 'female') NOT NULL,
    `taille` DECIMAL(5,2) DEFAULT NULL,
    `poids` DECIMAL(5,2) DEFAULT NULL,
    `solde` DECIMAL(10,2) DEFAULT 0.00,
    `gold` INT(11) DEFAULT 0,
    `date_inscription` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `objectifs`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `objectif` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    PRIMARY KEY (`id`),
);
    
CREATE TABLE IF NOT EXISTS `utilisateurs_objectifs`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `objectif_id` INT(11) NOT NULL,
    `date_choix` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `regimes`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `Non_regime` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `prix` DECIMAL(10,2) DEFAULT NULL,
    `duree` INT(11) DEFAULT NULL,
    `variation_poids` DECIMAL(5,2) DEFAULT NULL,
    `pourcentage_viande` DECIMAL(5,2) DEFAULT NULL,
    `pourcentage_poisson` DECIMAL(5,2) DEFAULT NULL,
    `pourcentage_volaille` DECIMAL(5,2) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `activites_sportives`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nom_activite` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `calories_brulees` DECIMAL(10,2) DEFAULT NULL,
    `Niveau_difficulte` ENUM('facile', 'moyen', 'difficile') NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `regime_activite`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `regime_id` INT(11) NOT NULL,
    `activite_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `utilisateurs_regimes`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `regime_activies_id` INT(11) NOT NULL,
    `date_debut` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `date_fin` TIMESTAMP DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `achats_regimes`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `regime_id` INT(11) NOT NULL,
    `prix_paye` DECIMAL(10,2) NOT NULL,
    `date_achat` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `codes_portefeuille`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(50) NOT NULL,
    `montant` DECIMAL(10,2) NOT NULL,
    'utilise' BOOLEAN DEFAULT FALSE,
    `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `transactions`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `type_transaction` ENUM('achat', 'recharge') NOT NULL,
    `montant` DECIMAL(10,2) NOT NULL,
    `date_transaction` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `abonnements`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `date_activation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `prix` DECIMAL(10,2) DEFAULT NULL,
    PRIMARY KEY (`id`)
);
    
CREATE TABLE IF NOT EXISTS `admins`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `NOM` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `passWorrd` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `parametres`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `cle` VARCHAR(255) NOT NULL,
    `valeur` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);