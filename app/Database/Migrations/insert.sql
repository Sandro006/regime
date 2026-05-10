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


