-- =============================
USE `Regime`;
-- Mot de passe admin: Admin@1234

INSERT INTO `admins` (`NOM`, `email`, `password`) VALUES 
('admin', 'admin@test.com', '$2y$10$Vx2nQm4xJ1l9xKqK6X2pW.TpW7w8Yt9o9j9v1lY5o3Gq3v9Gd1p2S');

INSERT INTO `users` (`username`, `email`, `password`) VALUES 
('Test User', 'test@test.com', 'test1234');


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
(1, 77.5, 1.75, 25.3, DATE_SUB(NOW(), INTERVAL 40 DAY)),
(1, 76.8, 1.75, 25.1, DATE_SUB(NOW(), INTERVAL 30 DAY)),
(1, 76.0, 1.75, 24.8, DATE_SUB(NOW(), INTERVAL 20 DAY)),
(1, 75.2, 1.75, 24.6, DATE_SUB(NOW(), INTERVAL 10 DAY)),
(1, 74.5, 1.75, 24.3, NOW());


-- Supprimer les anciennes entrées pour repartir sur de nouvelles données
-- DELETE FROM user_metrics_history WHERE user_id = 1;
-- DELETE FROM user_metrics_history WHERE user_id = 2;



INSERT INTO `codes_portefeuille` 
(`code`, `montant`, `utilise`, `utilisateur_id`, `date_creation`, `date_utilisation`) 
VALUES

-- Codes de petite valeur (5 000 - 10 000 Ar)
('VITAL-5000-ARY1', 5000, FALSE, NULL, NOW(), NULL),
('VITAL-7500-ARY2', 7500, FALSE, NULL, NOW(), NULL),
('VITAL-1000-ARY3', 10000, FALSE, NULL, NOW(), NULL),

-- Codes de valeur moyenne (15 000 - 25 000 Ar)
('VITAL-15K-ARY4', 15000, FALSE, NULL, NOW(), NULL),
('VITAL-20K-ARY5', 20000, FALSE, NULL, NOW(), NULL),
('VITAL-25K-ARY6', 25000, FALSE, NULL, NOW(), NULL),

-- Codes de valeur élevée (30 000 - 50 000 Ar)
('VITAL-30K-ARY7', 30000, FALSE, NULL, NOW(), NULL),
('VITAL-40K-ARY8', 40000, FALSE, NULL, NOW(), NULL),
('VITAL-50K-ARY9', 50000, FALSE, NULL, NOW(), NULL),

-- Codes premium (75 000 - 150 000 Ar)
('VITAL-75K-ARY10', 75000, FALSE, NULL, NOW(), NULL),
('VITAL-100K-ARY11', 100000, FALSE, NULL, NOW(), NULL),
('VITAL-150K-ARY12', 150000, FALSE, NULL, NOW(), NULL),

-- Codes bonus spéciaux
('VITAL-BONUS-VIP1', 200000, FALSE, NULL, NOW(), NULL),
('VITAL-PROMO-2026', 50000, FALSE, NULL, NOW(), NULL),
('VITAL-WELCOME-NEW', 25000, FALSE, NULL, NOW(), NULL);

INSERT INTO parametres (cle, valeur) VALUES
('abonnement_gold_prix', '28000.00'),
('abonnement_platine_prix', '86000.99');

-- Association des régimes avec les activités
-- =========================
-- Pack Perte de Poids
INSERT INTO regime_activite (regime_id, activite_id) VALUES
(1, 1),  -- Plan Keto avec Cardio
(2, 2),  -- Plan Protéiné avec Jogging
(3, 2),  -- Plan Détox avec Jogging

-- Pack Gain de Muscle
(4, 3),  -- Plan Hypertrophie avec Muscu
(5, 3),  -- Plan Prise de Masse avec Muscu

-- Pack Équilibre
(6, 1),  -- Plan Équilibré avec Cardio
(7, 6),  -- Plan Méditerranéen avec Cycling

-- Pack Santé
(8, 6),  -- Plan Cœur Sain avec Cycling
(9, 4),  -- Plan Diabète avec Yoga

-- Pack Performance
(10, 1), -- Plan Endurance avec Cardio
(11, 5); -- Plan Crossfit avec HIIT
