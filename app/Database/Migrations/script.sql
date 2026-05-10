DROP DATABASE IF EXISTS `Regime`;

CREATE DATABASE IF NOT EXISTS `Regime`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE `Regime`;

-- =========================
-- TABLE USERS
-- =========================
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `gender` ENUM('male', 'female') NOT NULL,
    `taille` DECIMAL(5,2) DEFAULT NULL,
    `poids` DECIMAL(5,2) DEFAULT NULL,
    `solde` DECIMAL(10,2) DEFAULT 0.00,
    `gold` INT DEFAULT 0,
    `date_inscription` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`)
);

-- =========================
-- TABLE OBJECTIFS
-- =========================
CREATE TABLE IF NOT EXISTS `objectifs` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `objectif` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,

    PRIMARY KEY (`id`)
);

-- =========================
-- TABLE UTILISATEURS_OBJECTIFS
-- =========================
CREATE TABLE IF NOT EXISTS `utilisateurs_objectifs` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `objectif_id` INT NOT NULL,
    `date_choix` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users`(`id`)
        ON DELETE CASCADE,

    FOREIGN KEY (`objectif_id`)
        REFERENCES `objectifs`(`id`)
        ON DELETE CASCADE
);

-- =========================
-- TABLE REGIMES
-- =========================
CREATE TABLE IF NOT EXISTS `regimes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nom_regime` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `prix` DECIMAL(10,2) DEFAULT NULL,
    `duree` INT DEFAULT NULL,
    `variation_poids` DECIMAL(5,2) DEFAULT NULL,
    `pourcentage_viande` DECIMAL(5,2) DEFAULT NULL,
    `pourcentage_poisson` DECIMAL(5,2) DEFAULT NULL,
    `pourcentage_volaille` DECIMAL(5,2) DEFAULT NULL,

    PRIMARY KEY (`id`)
);

-- =========================
-- TABLE ACTIVITES SPORTIVES
-- =========================
CREATE TABLE IF NOT EXISTS `activites_sportives` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nom_activite` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `calories_brulees` DECIMAL(10,2) DEFAULT NULL,
    `niveau_difficulte`
        ENUM('facile', 'moyen', 'difficile') NOT NULL,

    PRIMARY KEY (`id`)
);

-- =========================
-- TABLE REGIME_ACTIVITE
-- =========================
CREATE TABLE IF NOT EXISTS `regime_activite` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `regime_id` INT NOT NULL,
    `activite_id` INT NOT NULL,

    PRIMARY KEY (`id`),

    FOREIGN KEY (`regime_id`)
        REFERENCES `regimes`(`id`)
        ON DELETE CASCADE,

    FOREIGN KEY (`activite_id`)
        REFERENCES `activites_sportives`(`id`)
        ON DELETE CASCADE
);

-- =========================
-- TABLE UTILISATEURS_REGIMES
-- =========================
CREATE TABLE IF NOT EXISTS `utilisateurs_regimes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `regime_activite_id` INT NOT NULL,
    `date_debut` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `date_fin` TIMESTAMP NULL DEFAULT NULL,

    PRIMARY KEY (`id`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users`(`id`)
        ON DELETE CASCADE,

    FOREIGN KEY (`regime_activite_id`)
        REFERENCES `regime_activite`(`id`)
        ON DELETE CASCADE
);

-- =========================
-- TABLE ACHATS REGIMES
-- =========================
CREATE TABLE IF NOT EXISTS `achats_regimes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `regime_id` INT NOT NULL,
    `prix_paye` DECIMAL(10,2) NOT NULL,
    `date_achat` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users`(`id`)
        ON DELETE CASCADE,

    FOREIGN KEY (`regime_id`)
        REFERENCES `regimes`(`id`)
        ON DELETE CASCADE
);

-- =========================
-- TABLE CODES PORTEFEUILLE
-- =========================
CREATE TABLE IF NOT EXISTS `codes_portefeuille` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `montant` DECIMAL(10,2) NOT NULL,
    `utilise` BOOLEAN DEFAULT FALSE,
    `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`)
);

-- =========================
-- TABLE TRANSACTIONS
-- =========================
CREATE TABLE IF NOT EXISTS `transactions` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `type_transaction`
        ENUM('achat', 'recharge') NOT NULL,
    `montant` DECIMAL(10,2) NOT NULL,
    `date_transaction` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users`(`id`)
        ON DELETE CASCADE
);

-- =========================
-- TABLE ABONNEMENTS
-- =========================
CREATE TABLE IF NOT EXISTS `abonnements` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `date_activation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `prix` DECIMAL(10,2) DEFAULT NULL,

    PRIMARY KEY (`id`),

    FOREIGN KEY (`user_id`)
        REFERENCES `users`(`id`)
        ON DELETE CASCADE
);

-- =========================
-- TABLE ADMINS
-- =========================
CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`id`)
);

-- =========================
-- TABLE PARAMETRES
-- =========================
CREATE TABLE IF NOT EXISTS `parametres` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `cle` VARCHAR(255) NOT NULL UNIQUE,
    `valeur` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`id`)
);


INSERT INTO objectifs (objectif, description) VALUES
('Perdre du poids', 'Objectif pour reduire le poids de facon progressive et durable.'),
('Gagner du poid', 'Objectif pour augmenter le poids avec un plan adapte.'),
('Atteindre l IMC ideal', 'Objectif pour stabiliser l IMC dans la plage optimale.');