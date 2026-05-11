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

-- Utilisateur 1 : Progression sur 3 mois (perte de poids)
INSERT INTO user_metrics_history (user_id, poids, taille, bmi, created_at) VALUES
(1, 82.5, 1.75, 26.9, DATE_SUB(NOW(), INTERVAL 90 DAY)),
(1, 81.2, 1.75, 26.5, DATE_SUB(NOW(), INTERVAL 80 DAY)),
(1, 80.0, 1.75, 26.1, DATE_SUB(NOW(), INTERVAL 70 DAY)),
(1, 79.1, 1.75, 25.8, DATE_SUB(NOW(), INTERVAL 60 DAY)),
(1, 78.3, 1.75, 25.6, DATE_SUB(NOW(), INTERVAL 50 DAY)),
(1, 77.5, 1.75, 25.3, DATE_SUB(NOW(), INTERVAL 40 DAY)),
(1, 76.8, 1.75, 25.1, DATE_SUB(NOW(), INTERVAL 30 DAY)),
(1, 76.0, 1.75, 24.8, DATE_SUB(NOW(), INTERVAL 20 DAY)),
(1, 75.2, 1.75, 24.6, DATE_SUB(NOW(), INTERVAL 10 DAY)),
(1, 74.5, 1.75, 24.3, NOW());


-- Utilisateur 2 : Homme, progression sur 3 mois (prise de muscle)
INSERT INTO user_metrics_history (user_id, poids, taille, bmi, created_at) VALUES
(2, 68.0, 1.70, 23.5, DATE_SUB(NOW(), INTERVAL 90 DAY)),
(2, 68.5, 1.70, 23.7, DATE_SUB(NOW(), INTERVAL 80 DAY)),
(2, 69.2, 1.70, 23.9, DATE_SUB(NOW(), INTERVAL 70 DAY)),
(2, 69.8, 1.70, 24.2, DATE_SUB(NOW(), INTERVAL 60 DAY)),
(2, 70.5, 1.70, 24.4, DATE_SUB(NOW(), INTERVAL 50 DAY)),
(2, 71.0, 1.70, 24.6, DATE_SUB(NOW(), INTERVAL 40 DAY)),
(2, 71.8, 1.70, 24.8, DATE_SUB(NOW(), INTERVAL 30 DAY)),
(2, 72.3, 1.70, 25.0, DATE_SUB(NOW(), INTERVAL 20 DAY)),
(2, 73.0, 1.70, 25.3, DATE_SUB(NOW(), INTERVAL 10 DAY)),
(2, 73.5, 1.70, 25.4, NOW());


-- Utilisateur 2 avec croissance (si c'est un adolescent)
INSERT INTO user_metrics_history (user_id, poids, taille, bmi, created_at) VALUES
(3, 58.0, 1.62, 22.1, DATE_SUB(NOW(), INTERVAL 180 DAY)),
(3, 60.5, 1.64, 22.5, DATE_SUB(NOW(), INTERVAL 150 DAY)),
(3, 63.0, 1.66, 22.9, DATE_SUB(NOW(), INTERVAL 120 DAY)),
(3, 65.5, 1.68, 23.3, DATE_SUB(NOW(), INTERVAL 90 DAY)),
(3, 68.0, 1.70, 23.5, DATE_SUB(NOW(), INTERVAL 60 DAY)),
(3, 71.0, 1.72, 24.0, DATE_SUB(NOW(), INTERVAL 30 DAY)),
(3, 73.5, 1.74, 24.3, NOW());

-- Supprimer les anciennes entrées pour repartir sur de nouvelles données
-- DELETE FROM user_metrics_history WHERE user_id = 1;
-- DELETE FROM user_metrics_history WHERE user_id = 2;