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


-- Données de test pour la table regimes (Prix en Ariary)
-- =========================
INSERT INTO regimes (nom_regime, description, prix, duree, variation_poids, pourcentage_viande, pourcentage_poisson, pourcentage_volaille) VALUES

-- Pack Perte de Poids
('Plan Keto', 'High-fat, adequate-protein, low-carbohydrate diet designed to burn fats rather than carbohydrates.', 235000, 12, -3.2, 25, 35, 40),

('Plan Protéiné', 'Régime riche en protéines pour la perte de poids avec effort musculaire minimal.', 188000, 8, -2.5, 40, 30, 30),

('Plan Détox', 'Régime de nettoyage complet avec fruits, légumes et jus frais pour éliminer les toxines.', 141000, 7, -1.8, 10, 15, 20),

-- Pack Gain de Muscle
('Plan Hypertrophie', 'Régime spécialisé pour la construction musculaire avec apport calorique élevé.', 282000, 12, 4.5, 45, 25, 30),

('Plan Prise de Masse', 'Régime haute calorie pour augmenter le volume musculaire progressivement.', 258000, 10, 5.2, 40, 30, 30),

-- Pack Équilibre
('Plan Équilibré', 'Régime équilibré pour maintenir un poids stable avec une nutrition optimale.', 211000, 8, 0.0, 30, 30, 40),

('Plan Méditerranéen', 'Régime inspiré des pays méditerranéens riche en fruits, légumes et oméga-3.', 235000, 12, -1.5, 20, 45, 35),

-- Pack Santé
('Plan Cœur Sain', 'Régime pour la santé cardiovasculaire avec sélection d\'aliments bénéfiques.', 211000, 12, -0.8, 25, 40, 35),

('Plan Diabète', 'Régime spécialisé pour contrôler le taux de glycémie et maintenir une santé optimale.', 282000, 12, -2.0, 30, 35, 35),

-- Pack Performance
('Plan Endurance', 'Régime optimisé pour les coureurs et athlètes d\'endurance', 258000, 10, -1.2, 25, 30, 45),

('Plan Crossfit', 'Régime haute performance pour les athlètes intensifs et sports extrêmes.', 305000, 12, 1.5, 45, 25, 30);