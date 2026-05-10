USE `Regime`;
-- Mot de passe admin: Admin@1234

<<<<<<< Updated upstream
INSERT INTO `admins` (`nom`, `email`, `password`) VALUES 
('admin', 'admin@test.com', '$2y$10$bR4P2LWGL2Nt.N7XR8JLnuIYqjoiw0Fsr5mtJ54G/l1pzmVCZHO1S');
=======
INSERT INTO `admins` (`NOM`, `email`, `passWorrd`) VALUES 
('admin', 'admin@test.com', '$2y$10$Vx2nQm4xJ1l9xKqK6X2pW.TpW7w8Yt9o9j9v1lY5o3Gq3v9Gd1p2S');


-- Exemple d'insertion d'activites sportives
-- =========================
INSERT INTO activites_sportives (nom_activite, description, calories_brulees, niveau_difficulte) VALUES
('Cardio', 'Entrainement cardio modere pour ameliorer l endurance.', 300, 'moyen'),
('Jogging', 'Course legere en exterieur, rythme regulier.', 250, 'facile'),
('Muscu', 'Renforcement musculaire avec exercices de base.', 450, 'difficile'),
('Yoga', 'Seance de souplesse et relaxation.', 180, 'facile'),
('HIIT', 'Intervalles intensifs courts pour bruler un max.', 500, 'difficile'),
('Cycling', 'Velo stationnaire ou exterieur, effort continu.', 320, 'moyen'),
('Marche rapide', 'Marche soutenue pour activer la depense calorique.', 200, 'facile');


-- =========================
-- INSERTION DONNEES CODES PORTEFEUILLE
-- =========================

INSERT INTO `codes_portefeuille` (`code`, `montant`, `utilise`, `date_creation`) VALUES
-- Codes de 10€
('VITALFIT10A1', 10.00, FALSE, NOW()),
('VITALFIT10B2', 10.00, FALSE, NOW()),
('VITALFIT10C3', 10.00, TRUE, DATE_SUB(NOW(), INTERVAL 5 DAY)),
('VITALFIT10D4', 10.00, FALSE, NOW()),
('VITALFIT10E5', 10.00, TRUE, DATE_SUB(NOW(), INTERVAL 3 DAY)),

-- Codes de 25€
('VITALFIT25A1', 25.00, FALSE, NOW()),
('VITALFIT25B2', 25.00, FALSE, NOW()),
('VITALFIT25C3', 25.00, TRUE, DATE_SUB(NOW(), INTERVAL 7 DAY)),
('VITALFIT25D4', 25.00, FALSE, NOW()),
('VITALFIT25E5', 25.00, FALSE, NOW()),

-- Codes de 50€
('VITALFIT50A1', 50.00, FALSE, NOW()),
('VITALFIT50B2', 50.00, TRUE, DATE_SUB(NOW(), INTERVAL 2 DAY)),
('VITALFIT50C3', 50.00, FALSE, NOW()),
('VITALFIT50D4', 50.00, FALSE, NOW()),
('VITALFIT50E5', 50.00, TRUE, DATE_SUB(NOW(), INTERVAL 10 DAY)),

-- Codes de 100€
('VITALFIT100A1', 100.00, FALSE, NOW()),
('VITALFIT100B2', 100.00, FALSE, NOW()),
('VITALFIT100C3', 100.00, TRUE, DATE_SUB(NOW(), INTERVAL 8 DAY)),
('VITALFIT100D4', 100.00, FALSE, NOW()),
('VITALFIT100E5', 100.00, FALSE, NOW()),

-- Codes premium de 200€
('VITALPREMIUM200A', 200.00, FALSE, NOW()),
('VITALPREMIUM200B', 200.00, TRUE, DATE_SUB(NOW(), INTERVAL 15 DAY)),
('VITALPREMIUM200C', 200.00, FALSE, NOW()),

-- Codes spéciaux (montants divers)
('VITALSPRINGSTART', 15.00, FALSE, NOW()),
('VITALMONTHLYPASS', 75.00, FALSE, NOW()),
('VITALYEARLYBONUS', 300.00, FALSE, NOW()),
('VITALPROMO2024', 35.00, TRUE, DATE_SUB(NOW(), INTERVAL 20 DAY)),
('VITALREFEERAL50', 50.00, FALSE, NOW());
>>>>>>> Stashed changes
