USE `Regime`;
-- Mot de passe admin: Admin@1234

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


INSERT INTO regimes (nom_regime, description, prix, duree, variation_poids, pourcentage_viande, pourcentage_poisson, pourcentage_volaille) VALUES
('Keto', 'Regime pauvre en glucides, riche en lipides.', 49.99, 30, -5.00, 60, 20, 20),
('Mass Gain', 'Regime hypercalorique pour prise de masse.', 59.99, 45, 8.00, 40, 10, 50),
('Detox', 'Regime leger pour purifier l organisme.', 39.99, 14, -3.00, 10, 40, 50),
('Equilibre', 'Regime equilibre pour maintien du poids.', 44.99, 30, 0.00, 35, 35, 30),
('Low Carb', 'Regime modere en glucides pour secher.', 52.99, 30, -4.00, 50, 20, 30),
('High Protein', 'Regime riche en proteines pour sport.', 54.99, 30, 3.00, 45, 15, 40);