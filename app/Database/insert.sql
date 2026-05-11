-- =============================
-- INSERT TEST CODES PORTEFEUILLE
-- =============================
-- 15 codes de recharge avec différents montants en Ariary
-- pour tester la fonctionnalité de recharge

USE `Regime`;

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

-- Vérifier les codes insérés
SELECT 
    `id`,
    `code`,
    `montant`,
    `utilise`,
    `date_creation`
FROM `codes_portefeuille`
WHERE `code` LIKE 'VITAL-%'
ORDER BY `montant` ASC;
