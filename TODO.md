# TODO — PROJET RÉGIME ALIMENTAIRE

**Équipe:** Sandro, Bidy, Elisa  
**Date de début:** 8 mai 2026  
**Statut général:** 📅 À commencer

---

## 📋 PHASE 0 — SETUP INITIAL (TOUT LE MONDE ENSEMBLE)

### ✅ Configuration du projet CodeIgniter4

- [ ] **0.1** — Cloner/créer le projet CodeIgniter4
  - **Responsable:** Sandro
  - **Comment:** `composer create-project codeigniter4/appstarter regime` ou utiliser le dossier existant
  - **Dépendance:** Aucune
  - **Validation:** `php spark serve` doit fonctionner

- [ ] **0.2** — Configurer la base de données dans `.env`
  - **Responsable:** Bidy
  - **Comment:** 
    - Copier `.env.example` en `.env`
    - Remplir les identifiants MySQL/PostgreSQL
    - Exemple: `database.default.hostname = localhost`
  - **Dépendance:** Base de données créée localement
  - **Validation:** Connexion à la BD fonctionnelle

- [ ] **0.3** — Créer le schéma de base de données
  - **Responsable:** Elisa
  - **Comment:** Exécuter le script SQL trouvé dans `Base.md`
  - **Tables à créer:**
    - utilisateurs
    - objectifs
    - utilisateurs_objectifs
    - regimes
    - activites_sportives
    - regime_activite
    - utilisateur_regimes
    - achats_regimes
    - codes_portefeuille
    - transactions
    - abonnements
    - admins
    - parametres
  - **Dépendance:** 0.2 complété
  - **Validation:** `SHOW TABLES;` affiche toutes les tables

- [ ] **0.4** — Configurer les routes de base
  - **Responsable:** Sandro
  - **Comment:** Dans `app/Config/Routes.php`:
    - Route `/` → Home controller
    - Route `/auth` → Auth controller
    - Route `/profile` → Profile controller
  - **Dépendance:** 0.1 complété
  - **Validation:** Routes dans `php spark routes`

---

## 🔐 PHASE 1 — AUTHENTIFICATION (BLOQUANTE)

> ⚠️ DÉPENDANCE: Phase 0 complétée

### ✅ Inscription & Connexion

- [x] **1.1** — Créer le modèle User
  - **Responsable:** Bidy
  - **Fichier:** `app/Models/UserModel.php`
  - **Comment:**
    ```php
    // Structure basique:
    - id (int, primary key, auto-increment)
    - nom (varchar)
    - email (varchar, unique)
    - motdepasse (varchar, hash avec password_hash())
    - genre (enum: 'M', 'F')
    - taille (decimal: en mètres, ex. 1.75)
    - poids (decimal: en kg)
    - solde (decimal: portefeuille, default 0)
    - gold (boolean: default false)
    - date_inscription (timestamp)
    ```
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable sans erreur

- [x] **1.2** — Créer le contrôleur Auth
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Auth.php`
  - **Méthodes:**
    - `register()` - Page inscription étape 1
    - `registerStep2()` - Page inscription étape 2
    - `saveRegister()` - Validation + sauvegarde (POST)
    - `login()` - Page connexion
    - `authenticate()` - Vérification identifiants (POST)
    - `logout()` - Déconnexion
  - **Comment:** Utiliser CodeIgniter's `session()` et `$request->getPost()`
  - **Dépendance:** 1.1 complété
  - **Validation:** Contrôleur chargeable sans erreur

- [x] **1.3a** — Créer vue inscription étape 1
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/auth/register_step1.php`
  - **Champs:**
    - Nom (text)
    - Email (email)
    - Mot de passe (password)
    - Genre (select: M/F)
  - **Comment:** Formulaire simple, validation HTML5 + Bootstrap 5
  - **Dépendance:** 1.2 complété
  - **Validation:** Formulaire affichable

- [x] **1.3b** — Créer vue inscription étape 2
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/auth/register_step2.php`
  - **Champs:**
    - Taille (input: décimal en mètres)
    - Poids (input: décimal en kg)
  - **Comment:** Formulaire simple + bouton "Terminer"
  - **Dépendance:** 1.2 complété
  - **Validation:** Formulaire affichable

- [ ] **1.4** — Créer vue connexion
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/auth/login.php`
  - **Champs:**
    - Email (email)
    - Mot de passe (password)
  - **Comment:** Formulaire simple + lien inscription
  - **Dépendance:** 1.2 complété
  - **Validation:** Formulaire affichable

- [x] **1.5** — Implémenter validation inscription
  - **Responsable:** Sandro
  - **Comment:**
    - Vérifier email unique (SELECT COUNT(*) FROM utilisateurs WHERE email = ?)
    - Vérifier champs requis
    - Hash du mot de passe: `password_hash($mdp, PASSWORD_BCRYPT)`
  - **Dans:** `Auth.php` contrôleur
  - **Dépendance:** 1.1, 1.2, 1.3a, 1.3b complétés
  - **Validation:** Inscription fonctionnelle, utilisateur en BD

- [ ] **1.6** — Implémenter authentification connexion
  - **Responsable:** Bidy
  - **Comment:**
    - Vérifier email existe (SELECT * FROM utilisateurs WHERE email = ?)
    - Vérifier mot de passe: `password_verify($mdp_saisi, $mdp_hash)`
    - Créer session: `session()->set(['user_id' => $user->id])`
  - **Dans:** `Auth.php` contrôleur
  - **Dépendance:** 1.1, 1.2, 1.4 complétés
  - **Validation:** Connexion fonctionnelle, session créée

- [ ] **1.7** — Implémenter déconnexion
  - **Responsable:** Elisa
  - **Comment:** Détruire session: `session()->destroy()`
  - **Dans:** `Auth.php` contrôleur
  - **Dépendance:** 1.6 complété
  - **Validation:** Session détruite après logout

---

## 👤 PHASE 2 — PROFIL UTILISATEUR

> ⚠️ DÉPENDANCE: Phase 1 complétée

### ✅ Affichage & Modification Profil

- [ ] **2.1** — Créer contrôleur Profile
  - **Responsable:** Bidy
  - **Fichier:** `app/Controllers/Profile.php`
  - **Méthodes:**
    - `index()` - Afficher profil
    - `edit()` - Formulaire modification
    - `update()` - Sauvegarder modifications (POST)
  - **Comment:** Vérifier session utilisateur, charger depuis UserModel
  - **Dépendance:** 1.6 complété
  - **Validation:** Contrôleur chargeable

- [ ] **2.2** — Créer vue profil
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/profile/index.php`
  - **Affiche:**
    - Nom
    - Email
    - Genre
    - Taille
    - Poids
    - **IMC (calculé)**
    - Solde portefeuille
    - Statut Gold
  - **Comment:** Affichage simple + bouton "Modifier"
  - **Dépendance:** 2.1 complété
  - **Validation:** Vue affichable

- [ ] **2.3** — Créer vue modification profil
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/profile/edit.php`
  - **Champs éditables:**
    - Nom
    - Taille
    - Poids
  - **Comment:** Formulaire pré-rempli avec valeurs actuelles
  - **Dépendance:** 2.1 complété
  - **Validation:** Vue affichable avec pré-remplissage

- [ ] **2.4** — Implémenter calcul IMC
  - **Responsable:** Sandro
  - **Formule:** `IMC = poids / (taille * taille)`
  - **Comment:** 
    - Créer fonction `calculateIMC($poids, $taille)` dans UserModel
    - Appeler dans contrôleur avant affichage
    - Retourner: valeur + catégorie (Maigre/Normal/Surpoids)
  - **Dépendance:** 2.2 complété
  - **Validation:** IMC affiché correctement dans vue profil

- [ ] **2.5** — Implémenter modification profil
  - **Responsable:** Bidy
  - **Comment:**
    - Récupérer données POST
    - Valider (taille > 0, poids > 0)
    - UPDATE utilisateurs WHERE id = ?
    - Rediriger vers profil
  - **Dépendance:** 2.1, 2.3, 2.4 complétés
  - **Validation:** Modifications sauvegardées

---

## 🎯 PHASE 3 — OBJECTIFS (INDÉPENDANT)

> ⚠️ DÉPENDANCE: Phase 1 complétée

### ✅ Gestion des Objectifs

- [ ] **3.1** — Créer modèle Objectif
  - **Responsable:** Elisa
  - **Fichier:** `app/Models/ObjectifModel.php`
  - **Champs:**
    - id
    - nom (varchar): "Réduire poids", "Augmenter poids", "IMC idéal"
    - description (text)
  - **Comment:** Données pré-insérées en BD (3 objectifs)
  - **Dépendance:** 0.3 complété
  - **Validation:** 3 objectifs en BD

- [ ] **3.2** — Créer modèle UtilisateurObjectif
  - **Responsable:** Elisa
  - **Fichier:** `app/Models/UtilisateurObjectifModel.php`
  - **Champs:**
    - id
    - utilisateur_id (FK)
    - objectif_id (FK)
    - date_choix (timestamp)
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **3.3** — Créer contrôleur Objectif
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Objectif.php`
  - **Méthodes:**
    - `list()` - Lister objectifs
    - `save()` - Sauvegarder choix utilisateur (POST)
  - **Dépendance:** 3.1, 3.2 complétés
  - **Validation:** Contrôleur chargeable

- [ ] **3.4** — Créer vue liste objectifs
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/objectif/list.php`
  - **Affiche:** Liste radios/boutons avec description
  - **Comment:** Bootstrap cards avec sélection
  - **Dépendance:** 3.3 complété
  - **Validation:** Vue affichable

- [ ] **3.5** — Implémenter sauvegarde objectif
  - **Responsable:** Sandro
  - **Comment:**
    - Récupérer POST objectif_id
    - Insérer dans utilisateurs_objectifs
    - Rediriger vers dashboard
  - **Dépendance:** 3.2, 3.3, 3.4 complétés
  - **Validation:** Objectif sauvegardé

---

## 🍽️ PHASE 4 — RÉGIMES (DÉPEND DE PHASE 3)

> ⚠️ DÉPENDANCE: Phase 3 complétée (pour recommandations adaptées)

### ✅ Gestion des Régimes

- [ ] **4.1** — Créer modèle Regime
  - **Responsable:** Bidy
  - **Fichier:** `app/Models/RegimeModel.php`
  - **Champs:**
    - id
    - nom (varchar)
    - description (text)
    - prix (decimal)
    - duree (int: jours)
    - variation_poids (int: kg, peut être négatif)
    - pourcentage_viande (int: %)
    - pourcentage_poisson (int: %)
    - pourcentage_volaille (int: %)
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **4.2** — Insérer régimes d'exemple en BD
  - **Responsable:** Elisa
  - **Comment:** 
    - Insérer au minimum 5 régimes
    - Exemple: Keto (-5kg), Mass Gain (+8kg), etc.
  - **Script SQL** à exécuter
  - **Dépendance:** 4.1 complété
  - **Validation:** 5+ régimes en BD

- [ ] **4.3** — Créer contrôleur Regime
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Regime.php`
  - **Méthodes:**
    - `list()` - Lister tous régimes
    - `detail($id)` - Détails d'un régime
    - `recommended()` - Régimes recommandés selon objectif
  - **Dépendance:** 4.1 complété
  - **Validation:** Contrôleur chargeable

- [ ] **4.4** — Créer vue liste régimes
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/regime/list.php`
  - **Affiche:** Tableau ou cards avec:
    - Nom, Prix, Durée, Variation poids
  - **Comment:** Bootstrap table + structure responsive
  - **Dépendance:** 4.3 complété
  - **Validation:** Vue affichable

- [ ] **4.5** — Créer vue détails régime
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/regime/detail.php`
  - **Affiche:** Tous les champs + bouton "Acheter"
  - **Dépendance:** 4.3 complété
  - **Validation:** Vue affichable

- [ ] **4.6** — Implémenter recommandations par objectif
  - **Responsable:** Sandro
  - **Comment:**
    - Récupérer objectif utilisateur
    - Filtrer régimes selon objectif (si "Réduire" → variation_poids < 0)
    - Afficher régimes correspondants
  - **Dans:** `Regime.php` contrôleur
  - **Dépendance:** 4.3, 4.4, 3.5 complétés
  - **Validation:** Recommandations pertinentes

---

## 🏃 PHASE 5 — ACTIVITÉS SPORTIVES (PARALLÈLE AVEC PHASE 4)

> ⚠️ DÉPENDANCE: Phase 3 complétée

### ✅ Gestion des Activités

- [ ] **5.1** — Créer modèle ActiviteSportive
  - **Responsable:** Elisa
  - **Fichier:** `app/Models/ActiviteSportiveModel.php`
  - **Champs:**
    - id
    - nom (varchar)
    - description (text)
    - calories (int: par séance)
    - niveau (enum: 'Facile', 'Moyen', 'Difficile')
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **5.2** — Insérer activités d'exemple en BD
  - **Responsable:** Bidy
  - **Comment:** Insérer 5-8 activités (Cardio, Jogging, Muscu, Yoga, HIIT, etc.)
  - **Dépendance:** 5.1 complété
  - **Validation:** 5+ activités en BD

- [ ] **5.3** — Créer contrôleur Activite
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Activite.php`
  - **Méthodes:**
    - `list()` - Lister activités
    - `recommended()` - Activités recommandées selon objectif
  - **Dépendance:** 5.1 complété
  - **Validation:** Contrôleur chargeable

- [ ] **5.4** — Créer vue liste activités
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/activite/list.php`
  - **Affiche:** Tableau/cards avec: Nom, Niveau, Calories
  - **Dépendance:** 5.3 complété
  - **Validation:** Vue affichable

- [ ] **5.5** — Implémenter recommandations par objectif
  - **Responsable:** Elisa
  - **Comment:**
    - Si objectif "Réduire poids" → activités Cardio/HIIT
    - Si objectif "Augmenter poids" → activités Musculation
    - Si objectif "IMC idéal" → mélange équilibré
  - **Dans:** `Activite.php` contrôleur
  - **Dépendance:** 5.3, 5.4, 3.5 complétés
  - **Validation:** Recommandations pertinentes

---

## 💰 PHASE 6 — PORTEFEUILLE VIRTUEL (BLOQUANTE)

> ⚠️ DÉPENDANCE: Phase 1 complétée (pour l'utilisateur)

### ✅ Gestion du Portefeuille

- [ ] **6.1** — Créer modèle CodePortefeuille
  - **Responsable:** Sandro
  - **Fichier:** `app/Models/CodePortefeuilleModel.php`
  - **Champs:**
    - id
    - code (varchar, unique)
    - montant (decimal)
    - utilise (boolean: default false)
    - utilisateur_id (FK: nullable, pour tracer qui a utilisé)
    - date_creation (timestamp)
    - date_utilisation (timestamp: nullable)
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **6.2** — Créer modèle Transaction
  - **Responsable:** Sandro
  - **Fichier:** `app/Models/TransactionModel.php`
  - **Champs:**
    - id
    - utilisateur_id (FK)
    - type (enum: 'Recharge', 'Achat', 'Gold', 'Remboursement')
    - montant (decimal)
    - date_transaction (timestamp)
    - description (text: optional)
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **6.3** — Créer contrôleur Portefeuille
  - **Responsable:** Bidy
  - **Fichier:** `app/Controllers/Portefeuille.php`
  - **Méthodes:**
    - `index()` - Afficher solde + historique
    - `recharger()` - Formulaire saisie code
    - `validerCode()` - Vérlicher et ajouter (POST)
  - **Dépendance:** 6.1, 6.2 complétés
  - **Validation:** Contrôleur chargeable

- [ ] **6.4** — Créer vue portefeuille
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/portefeuille/index.php`
  - **Affiche:**
    - Solde actuel (gros)
    - Historique transactions (tableau)
    - Bouton "Recharger"
  - **Dépendance:** 6.3 complété
  - **Validation:** Vue affichable

- [ ] **6.5** — Créer vue recharge code
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/portefeuille/recharger.php`
  - **Formulaire:** Input pour saisir code
  - **Dépendance:** 6.3 complété
  - **Validation:** Vue affichable

- [ ] **6.6** — Implémenter validation code
  - **Responsable:** Bidy
  - **Comment:**
    - SELECT * FROM codes_portefeuille WHERE code = ? AND utilise = false
    - Si trouvé:
      - UPDATE utilisateurs SET solde = solde + montant WHERE id = ?
      - UPDATE codes_portefeuille SET utilise = true, utilisateur_id = ?, date_utilisation = NOW()
      - Insérer transaction
      - Message succès
    - Sinon: Message erreur "Code invalide ou déjà utilisé"
  - **Dépendance:** 6.1, 6.2, 6.3, 6.5 complétés
  - **Validation:** Code validable et portefeuille augmenté

---

## 🛒 PHASE 7 — ACHAT RÉGIMES (DÉPEND DE PHASES 4, 6)

> ⚠️ DÉPENDANCE: Phases 4 et 6 complétées

### ✅ Système d'Achat

- [ ] **7.1** — Créer modèle AchatRegime
  - **Responsable:** Sandro
  - **Fichier:** `app/Models/AchatRegimeModel.php`
  - **Champs:**
    - id
    - utilisateur_id (FK)
    - regime_id (FK)
    - prix_paye (decimal: prix au moment achat)
    - remise_appliquee (decimal: montant remise si Gold)
    - date_achat (timestamp)
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **7.2** — Créer modèle UtilisateurRegime
  - **Responsable:** Sandro
  - **Fichier:** `app/Models/UtilisateurRegimeModel.php`
  - **Champs:**
    - id
    - utilisateur_id (FK)
    - regime_id (FK)
    - date_debut (date)
    - date_fin (date)
    - statut (enum: 'Actif', 'Complété', 'Annulé')
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **7.3** — Créer contrôleur Achat
  - **Responsable:** Bidy
  - **Fichier:** `app/Controllers/Achat.php`
  - **Méthodes:**
    - `acheterRegime($regimeId)` - Traiter achat (POST)
    - `mesRegimes()` - Lister régimes actifs utilisateur
  - **Dépendance:** 7.1, 7.2 complétés
  - **Validation:** Contrôleur chargeable

- [ ] **7.4** — Créer vue mes régimes
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/achat/mes_regimes.php`
  - **Affiche:** Tableau des régimes achétés avec date début/fin
  - **Dépendance:** 7.3 complété
  - **Validation:** Vue affichable

- [ ] **7.5** — Implémenter achat régime
  - **Responsable:** Elisa
  - **Comment:**
    - Vérifier utilisateur connecté
    - Récupérer prix régime
    - Si Gold: appliquer -15% remise
    - Vérifier solde >= prix
    - Si insuffisant: "Solde insuffisant"
    - Si ok:
      - Déduire du solde: UPDATE utilisateurs SET solde = solde - prix
      - Insérer achat: INSERT INTO achats_regimes
      - Insérer régime actif: INSERT INTO utilisateur_regimes (date_debut = TODAY, date_fin = TODAY + duree)
      - Insérer transaction
      - Rediriger vers "Achat confirmé"
  - **Dépendance:** 7.1, 7.2, 7.3, 2.1 complétés
  - **Validation:** Achat fonctionnel, portefeuille décrementé

- [ ] **7.6** — Ajouter bouton "Acheter" au détail régime
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/regime/detail.php` (modificaton)
  - **Comment:** Bouton POST vers `Achat.acheterRegime($id)`
  - **Dépendance:** 4.5, 7.3 complétés
  - **Validation:** Bouton fonctionnel

---

## 👑 PHASE 8 — OPTION GOLD (DÉPEND DE PHASES 6)

> ⚠️ DÉPENDANCE: Phase 6 complétée

### ✅ Gestion Gold

- [ ] **8.1** — Créer modèle Abonnement
  - **Responsable:** Elisa
  - **Fichier:** `app/Models/AbonnementModel.php`
  - **Champs:**
    - id
    - utilisateur_id (FK)
    - date_activation (timestamp)
    - date_expiration (timestamp: optional, null = illimité)
    - prix (decimal)
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [ ] **8.2** — Créer contrôleur Gold
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Gold.php`
  - **Méthodes:**
    - `acheter()` - Afficher prix Gold
    - `confirmer()` - Traiter achat (POST)
  - **Dépendance:** 8.1 complété
  - **Validation:** Contrôleur chargeable

- [ ] **8.3** — Créer vue achat Gold
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/gold/acheter.php`
  - **Affiche:**
    - Bénéfices Gold (-15% régimes)
    - Prix Gold (paramétrisable)
    - Bouton "Acheter"
  - **Dépendance:** 8.2 complété
  - **Validation:** Vue affichable

- [ ] **8.4** — Implémenter achat Gold
  - **Responsable:** Sandro
  - **Comment:**
    - Récupérer prix Gold depuis paramètres
    - Vérifier solde utilisateur >= prix
    - Si ok:
      - UPDATE utilisateurs SET gold = true, solde = solde - prix
      - INSERT INTO abonnements
      - Insérer transaction type 'Gold'
    - Message succès: "Félicitations! Vous êtes maintenant Gold"
  - **Dépendance:** 8.1, 8.2, 8.3, 6.6 complétés (portefeuille setup)
  - **Validation:** Gold activé, solde décrementé

- [ ] **8.5** — Mettre à jour calcul prix achat (remise Gold)
  - **Responsable:** Elisa
  - **Fichier:** `app/Controllers/Achat.php` (modification)
  - **Comment:** Dans `acheterRegime()`, vérifier `$user->gold` et appliquer -15%
  - **Dépendance:** 7.5, 8.4 complétés
  - **Validation:** Prix réduit pour Gold

---

## 📊 PHASE 9 — DASHBOARD UTILISATEUR

> ⚠️ DÉPENDANCE: Phase 1 + Phases 3-8 complétées

### ✅ Tableau de Bord Utilisateur

- [ ] **9.1** — Créer contrôleur Dashboard
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Dashboard.php`
  - **Méthodes:**
    - `index()` - Afficher dashboard
  - **Données à récupérer:**
    - IMC actuel + catégorie
    - Objectif choisi
    - Poids actuel
    - Solde portefeuille
    - Régimes actifs (date fin)
    - Activités associées aux régimes actifs
    - Statut Gold
  - **Dépendance:** Phases 2, 3, 4, 5, 6, 7, 8 complétées
  - **Validation:** Contrôleur chargeable

- [ ] **9.2** — Créer vue dashboard
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/dashboard/index.php`
  - **Layout:**
    - Haut: Cards avec IMC, Objectif, Poids, Solde
    - Milieu: Régimes actifs (tableau)
    - Bas: Activités recommandées
    - Navigation: liens vers profil, régimes, portefeuille, etc.
  - **Comment:** Bootstrap grid + design moderne et responsif
  - **Dépendance:** 9.1 complété
  - **Validation:** Vue affichable avec toutes données

---

## 🔧 PHASE 10 — BACK OFFICE - AUTHENTIFICATION ADMIN

> ⚠️ DÉPENDANCE: Phase 0 complétée

### ✅ Login Admin

- [x] **10.1** — Créer modèle Admin
  - **Responsable:** Elisa
  - **Fichier:** `app/Models/AdminModel.php`
  - **Champs:**
    - id
    - nom (varchar)
    - email (varchar, unique)
    - motdepasse (varchar, hash)
  - **Dépendance:** 0.3 complété
  - **Validation:** Modèle chargeable

- [x] **10.2** — Insérer admin de test en BD
  - **Responsable:** Elisa
  - **Comment:** Insérer 1 admin avec mdp hashé
  - **Dépendance:** 10.1 complété
  - **Validation:** Admin présent en BD

- [ ] **10.3** — Créer contrôleur AdminAuth
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Admin/Auth.php`
  - **Méthodes:**
    - `login()` - Page login
    - `authenticate()` - Vérification (POST)
    - `logout()` - Déconnexion
  - **Sécurité:** Vérifier session admin dans chaque page admin
  - **Dépendance:** 10.1 complétés
  - **Validation:** Contrôleur chargeable

- [ ] **10.4** — Créer vue login admin
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/admin/auth/login.php`
  - **Formulaire:** Email + Mot de passe
  - **Comment:** Design simple mais professionnel
  - **Dépendance:** 10.3 complété
  - **Validation:** Vue affichable

- [ ] **10.5** — Implémenter authentification admin
  - **Responsable:** Bidy
  - **Comment:** Même logique que auth utilisateur mais avec AdminModel
  - **Session:** `session()->set(['admin_id' => $admin->id])`
  - **Dépendance:** 10.1, 10.3, 10.4 complétés
  - **Validation:** Login admin fonctionnel

---

## 📈 PHASE 11 — BACK OFFICE - DASHBOARD ADMIN

> ⚠️ DÉPENDANCE: Phase 10 complétée

### ✅ Dashboard Statistiques

- [ ] **11.1** — Créer contrôleur Dashboard Admin
  - **Responsable:** Bidy
  - **Fichier:** `app/Controllers/Admin/Dashboard.php`
  - **Méthodes:**
    - `index()` - Afficher dashboard
  - **Données:**
    - Nombre total utilisateurs
    - Revenu total (somme achats)
    - Nombre utilisateurs Gold
    - Régimes les plus vendus (TOP 3)
  - **Dépendance:** 10.5 complété
  - **Validation:** Contrôleur chargeable

- [ ] **11.2** — Créer vue dashboard admin
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/admin/dashboard/index.php`
  - **Contenu:**
    - 4 cards grands nombres (stats)
    - 1 tableau: Régimes populaires
    - Menu sidebar: CRUD sections
  - **Comment:** Design Admin propre
  - **Dépendance:** 11.1 complété
  - **Validation:** Vue affichable

---

## ⚙️ PHASE 12 — CRUD RÉGIMES ADMIN

> ⚠️ DÉPENDANCE: Phase 11 complétée

### ✅ Gestion Régimes

- [ ] **12.1** — Créer contrôleur Regime Admin
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Admin/Regime.php`
  - **Méthodes:**
    - `list()` - Lister régimes
    - `create()` - Formulaire création
    - `store()` - Sauvegarder (POST)
    - `edit($id)` - Formulaire modification
    - `update($id)` - Sauvegarder (POST)
    - `delete($id)` - Supprimer
  - **Dépendance:** 11.2 complété
  - **Validation:** Contrôleur chargeable

- [ ] **12.2** — Créer vue liste régimes admin
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/admin/regime/list.php`
  - **Affiche:** Tableau avec colonnes: Nom, Prix, Durée, Actions (Modifier/Supprimer)
  - **Dépendance:** 12.1 complété
  - **Validation:** Vue affichable

- [ ] **12.3** — Créer vue formulaire régime
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/admin/regime/form.php`
  - **Champs:**
    - Nom, Description, Prix, Durée
    - Variation poids, % Viande, % Poisson, % Volaille
  - **Utilisation:** Pour création ET modification
  - **Dépendance:** 12.1 complété
  - **Validation:** Vue affichable

- [ ] **12.4** — Implémenter CRUD régimes
  - **Responsable:** Sandro
  - **Comment:**
    - `create()`: Afficher formulaire vide
    - `store()`: Valider + INSERT
    - `edit()`: Afficher formulaire pré-rempli
    - `update()`: Valider + UPDATE
    - `delete()`: Confirmation + DELETE
  - **Validations:** Tous champs requis, prix > 0, % viande+poisson+volaille = 100
  - **Dépendance:** 12.1, 12.2, 12.3 complétés
  - **Validation:** CRUD fonctionnel

---

## 🏃 PHASE 13 — CRUD ACTIVITÉS ADMIN

> ⚠️ DÉPENDANCE: Phase 11 complétée (même pattern)

### ✅ Gestion Activités

- [ ] **13.1** — Créer contrôleur Activite Admin
  - **Responsable:** Elisa
  - **Fichier:** `app/Controllers/Admin/Activite.php`
  - **Méthodes:** list(), create(), store(), edit(), update(), delete()
  - **Dépendance:** 11.2 complété
  - **Validation:** Contrôleur chargeable

- [ ] **13.2** — Créer vue liste activités admin
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/admin/activite/list.php`
  - **Affiche:** Tableau: Nom, Calories, Niveau, Actions
  - **Dépendance:** 13.1 complété
  - **Validation:** Vue affichable

- [ ] **13.3** — Créer vue formulaire activité
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/admin/activite/form.php`
  - **Champs:** Nom, Description, Calories, Niveau (select)
  - **Dépendance:** 13.1 complété
  - **Validation:** Vue affichable

- [ ] **13.4** — Implémenter CRUD activités
  - **Responsable:** Elisa
  - **Validations:** Tous champs requis, calories > 0, niveau valide
  - **Dépendance:** 13.1, 13.2, 13.3 complétés
  - **Validation:** CRUD fonctionnel

---

## 🎟️ PHASE 14 — GESTION CODES PORTEFEUILLE ADMIN

> ⚠️ DÉPENDANCE: Phase 11 complétée

### ✅ Codes Recharge

- [ ] **14.1** — Créer contrôleur Code Admin
  - **Responsable:** Bidy
  - **Fichier:** `app/Controllers/Admin/Code.php`
  - **Méthodes:**
    - `list()` - Lister codes
    - `create()` - Formulaire création
    - `store()` - Générer codes (POST)
    - `disable($id)` - Désactiver code
    - `view()` - Voir détails code
  - **Dépendance:** 11.2 complété
  - **Validation:** Contrôleur chargeable

- [ ] **14.2** — Créer vue liste codes admin
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/admin/code/list.php`
  - **Affiche:** Tableau: Code, Montant, Utilisé (oui/non), Utilisateur, Actions
  - **Filtre:** Affichés/Utilisés/Tous
  - **Dépendance:** 14.1 complété
  - **Validation:** Vue affichable

- [ ] **14.3** — Créer vue création codes
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/admin/code/create.php`
  - **Formulaire:**
    - Nombre de codes à générer (input)
    - Montant par code (input)
  - **Dépendance:** 14.1 complété
  - **Validation:** Vue affichable

- [ ] **14.4** — Implémenter génération codes
  - **Responsable:** Sandro
  - **Comment:**
    - Récupérer: nombre, montant
    - Boucle N fois:
      - Générer code unique (random string 8 caractères ou UUID)
      - INSERT INTO codes_portefeuille
    - Afficher codes générés (pour copier/coller)
  - **Dépendance:** 14.1, 14.2, 14.3 complétés
  - **Validation:** Codes générés et affichés

- [ ] **14.5** — Implémenter désactivation code
  - **Responsable:** Sandro
  - **Comment:** UPDATE codes_portefeuille SET utilise = true WHERE id = ?
  - **Dépendance:** 14.1 complété
  - **Validation:** Code désactivable

---

## ⚙️ PHASE 15 — PARAMÈTRES APPLICATION ADMIN

> ⚠️ DÉPENDANCE: Phase 11 complétée

### ✅ Configuration

- [ ] **15.1** — Créer contrôleur Parametre Admin
  - **Responsable:** Sandro
  - **Fichier:** `app/Controllers/Admin/Parametre.php`
  - **Méthodes:**
    - `index()` - Afficher formulaire
    - `update()` - Sauvegarder (POST)
  - **Dépendance:** 11.2 complété
  - **Validation:** Contrôleur chargeable

- [ ] **15.2** — Créer vue paramètres
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/admin/parametre/index.php`
  - **Champs éditables:**
    - Prix Gold
    - % Remise Gold (défaut 15%)
    - Catégories IMC (seuils)
  - **Dépendance:** 15.1 complété
  - **Validation:** Vue affichable

- [ ] **15.3** — Implémenter sauvegarde paramètres
  - **Responsable:** Sandro
  - **Comment:**
    - Récupérer POST
    - UPDATE table parametres WHERE cle = ?
    - Utiliser cache pour performance
  - **Dépendance:** 15.1, 15.2 complétés
  - **Validation:** Paramètres sauvegardables

---

## 👥 PHASE 16 — GESTION UTILISATEURS ADMIN

> ⚠️ DÉPENDANCE: Phase 11 complétée

### ✅ Gestion Utilisateurs

- [ ] **16.1** — Créer contrôleur Utilisateur Admin
  - **Responsable:** Bidy
  - **Fichier:** `app/Controllers/Admin/Utilisateur.php`
  - **Méthodes:**
    - `list()` - Lister utilisateurs
    - `detail($id)` - Détails utilisateur
    - `toggleGold($id)` - Activer/Désactiver Gold (POST)
  - **Dépendance:** 11.2 complété
  - **Validation:** Contrôleur chargeable

- [ ] **16.2** — Créer vue liste utilisateurs
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/admin/utilisateur/list.php`
  - **Affiche:** Tableau: Email, Nom, Gold (oui/non), Date Inscription, Actions
  - **Filtres:** Tous / Gold / Non-Gold
  - **Dépendance:** 16.1 complété
  - **Validation:** Vue affichable

- [ ] **16.3** — Créer vue détails utilisateur
  - **Responsable:** Bidy
  - **Fichier:** `app/Views/admin/utilisateur/detail.php`
  - **Affiche:**
    - Infos personnelles
    - Objectif
    - Régimes achetés
    - Solde
    - Statut Gold
  - **Dépendance:** 16.1 complété
  - **Validation:** Vue affichable

- [ ] **16.4** — Implémenter toggle Gold
  - **Responsable:** Elisa
  - **Comment:** UPDATE utilisateurs SET gold = !gold WHERE id = ?
  - **Dépendance:** 16.1 complété
  - **Validation:** Gold togglable

---

## 🎨 PHASE 17 — FRONT-END & UX (PARALLÈLE)

> ⚠️ DÉPENDANCE: Phases 1-9 fonctionnelles

### ✅ Design & CSS

- [ ] **17.1** — Configurer Bootstrap 5
  - **Responsable:** Bidy
  - **Comment:** Ajouter CDN Bootstrap dans layout principal
  - **Fichier:** `app/Views/layout/header.php`
  - **Dépendance:** 1.2 complété
  - **Validation:** Bootstrap chargé

- [ ] **17.2** — Créer layout principal frontend
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/layout/main.php`
  - **Contenu:**
    - Navbar avec logo, liens (Profil, Régimes, Activités, Portefeuille, Logout)
    - Footer
  - **Comment:** Héritage de vues (utiliser yield ou include)
  - **Dépendance:** 17.1 complétés
  - **Validation:** Layout affichable

- [ ] **17.3** — Créer layout admin
  - **Responsable:** Elisa
  - **Fichier:** `app/Views/admin/layout/main.php`
  - **Contenu:**
    - Sidebar avec menu CRUD
    - Topbar avec utilisateur + logout
  - **Dépendance:** 17.1 complétés
  - **Validation:** Layout affichable

- [ ] **17.4** — Créer fichier CSS custom
  - **Responsable:** Bidy
  - **Fichier:** `public/assets/css/style.css`
  - **Contenu:**
    - Variables couleurs
    - Animations transitions
    - Classes utilitaires
  - **Dépendance:** 17.1 complétés
  - **Validation:** CSS chargé

- [ ] **17.5** — Styliser formulaires
  - **Responsable:** Bidy
  - **Comment:** Appliquer classes Bootstrap + CSS custom
  - **Dépendance:** 17.1, 17.4 complétés
  - **Validation:** Formulaires visuellement agréables

- [ ] **17.6** — Rendre responsive
  - **Responsable:** Elisa
  - **Comment:** Tester sur mobile/tablette, ajuster media queries
  - **Dépendance:** 17.2, 17.3, 17.4, 17.5 complétés
  - **Validation:** Responsive testé

---

## 🧪 PHASE 18 — TESTS D'INTÉGRATION

> ⚠️ DÉPENDANCE: Toutes phases complétées

### ✅ Vérifications Finales

- [ ] **18.1** — Tester flux inscription
  - **Responsable:** Elisa
  - **Checklist:**
    - ✓ Étape 1 validation champs
    - ✓ Étape 2 validation champs
    - ✓ Email unique vérifiée
    - ✓ Mot de passe hashé en BD
  - **Dépendance:** Phase 1 complétée
  - **Validation:** Flux OK

- [ ] **18.2** — Tester flux connexion
  - **Responsable:** Elisa
  - **Checklist:**
    - ✓ Login OK
    - ✓ Session créée
    - ✓ Redirection dashboard
    - ✓ Logout fonctionne
  - **Dépendance:** Phase 1 complétée
  - **Validation:** Flux OK

- [ ] **18.3** — Tester achat régime
  - **Responsable:** Sandro
  - **Checklist:**
    - ✓ Sans Gold: prix normal
    - ✓ Avec Gold: -15% appliqué
    - ✓ Solde insuffisant: erreur
    - ✓ Achat sauvegardé
    - ✓ Régime apparaît dans "Mes régimes"
  - **Dépendance:** Phases 7, 8 complétées
  - **Validation:** Flux OK

- [ ] **18.4** — Tester portefeuille
  - **Responsable:** Bidy
  - **Checklist:**
    - ✓ Code valide: solde augmente
    - ✓ Code utilisé: erreur
    - ✓ Code invalide: erreur
    - ✓ Historique transactions correct
  - **Dépendance:** Phase 6 complétée
  - **Validation:** Flux OK

- [ ] **18.5** — Tester back-office CRUD
  - **Responsable:** Sandro
  - **Checklist:**
    - ✓ Régimes: Ajouter/Modifier/Supprimer
    - ✓ Activités: Ajouter/Modifier/Supprimer
    - ✓ Codes: Générer/Désactiver
    - ✓ Paramètres: Sauvegarder
  - **Dépendance:** Phases 12-15 complétées
  - **Validation:** CRUD OK

- [ ] **18.6** — Tester sécurité
  - **Responsable:** Bidy
  - **Checklist:**
    - ✓ Pages connectées pas accessibles sans login
    - ✓ Pages admin pas accessibles sans admin session
    - ✓ Injection SQL testée (prepared statements en place)
    - ✓ XSS testée (echappage HTML)
  - **Dépendance:** Toutes phases complétées
  - **Validation:** Sécurité OK

---

## 📝 PHASE 19 — DOCUMENTATION & FINALISATION

> ⚠️ DÉPENDANCE: Tous tests passés

### ✅ Finition

- [ ] **19.1** — Documenter API endpoints
  - **Responsable:** Sandro
  - **Fichier:** `API_DOCUMENTATION.md`
  - **Contenu:** Liste routes + paramètres
  - **Dépendance:** Toutes phases complétées
  - **Validation:** Doc écrite

- [ ] **19.2** — Guide utilisateur
  - **Responsable:** Elisa
  - **Fichier:** `GUIDE_UTILISATEUR.md`
  - **Contenu:** Comment s'inscrire, utiliser l'app
  - **Dépendance:** Toutes phases complétées
  - **Validation:** Guide écrit

- [ ] **19.3** — Guide administrateur
  - **Responsable:** Bidy
  - **Fichier:** `GUIDE_ADMIN.md`
  - **Contenu:** Accès admin, paramètres, CRUD régimes
  - **Dépendance:** Toutes phases complétées
  - **Validation:** Guide écrit

- [ ] **19.4** — Cleanup code
  - **Responsable:** Sandro
  - **Comment:** Enlever commentaires debug, formater code
  - **Dépendance:** Toutes phases complétées
  - **Validation:** Code propre

- [ ] **19.5** — Commit final + Push
  - **Responsable:** Tous
  - **Comment:** `git add . && git commit -m "Projet terminé" && git push origin main`
  - **Dépendance:** Toutes phases complétées
  - **Validation:** Code sur GitHub

---

## 📊 DISTRIBUTION DES TÂCHES

### 🟦 **SANDRO** (Chef technique)
- **Total:** ~35 tâches
- **Focus:** Contrôleurs, logique métier, API, routing
- **Phases principales:**
  - Phase 0: Setup routes
  - Phase 1: Auth contrôleur
  - Phases 3-5: Logique recommandations
  - Phase 6: Modèle codes
  - Phase 7: Achat régime
  - Phase 12-14: Back-office CRUD
  - Phase 18: Tests intégration

### 🟩 **BIDY** (Frontend/UX)
- **Total:** ~35 tâches
- **Focus:** Vues, formulaires, design, tests UX
- **Phases principales:**
  - Phase 0: Config BD
  - Phase 1: Auth vues
  - Phases 2-5: Affichage données
  - Phase 6: Portefeuille vues
  - Phases 16-17: UX/Design
  - Phase 18: Tests sécurité

### 🟨 **ELISA** (BD/Données)
- **Total:** ~35 tâches
- **Focus:** Modèles, données, structure
- **Phases principales:**
  - Phase 0: Création BD
  - Phases 1-5: Modèles entités
  - Phases 8-9: Gold + Dashboard
  - Phase 13: Activités admin
  - Phase 17: CSS/responsif
  - Phase 19: Documentation

---

## 🚦 ORDRE RECOMMANDÉ

```
1. PHASE 0 (Setup) — TOUS ensemble
   ↓
2. PHASE 1 (Auth) — BLOQUANTE pour tout le frontend
   ↓
3. PHASES 2-3 (Profil + Objectifs) — Parallèle
   ↓
4. PHASES 4-5 (Régimes + Activités) — Parallèle
   ↓
5. PHASE 6 (Portefeuille) — BLOQUANTE pour Phase 7
   ↓
6. PHASES 7-8 (Achat + Gold) — Dépendants de Phase 6
   ↓
7. PHASE 9 (Dashboard User) — Dépendant de tout
   ↓
8. PHASES 10-16 (Back-office) — Parallèle possible
   ↓
9. PHASE 17 (Design) — Après contenu principal OK
   ↓
10. PHASE 18 (Tests) — Avant finalisation
    ↓
11. PHASE 19 (Finalisation) — Dernière étape
```

---

## 💡 CONSEILS PRATIQUES

### ✅ Avant de coder:
- [ ] Créer une branche git pour chaque phase
- [ ] Faire des commits réguliers (1 par tâche)
- [ ] Tester après chaque tâche

### ✅ Communication équipe:
- [ ] Daily standup sur statut tâches
- [ ] Slack/Discord pour questions blocking
- [ ] Code review avant merge main

### ✅ Méthodologie de travail:
- **Quand doute:** Choisir solution la plus simple
- **Pas d'over-engineering:** Minimum viable pour chaque phase
- **Testing:** Tester immédiatement après coder

---

## 📅 ESTIMATION TEMPS

| Phase | Durée estimée | Criticité |
|-------|---|---|
| 0 | 2h | 🔴 BLOQUANTE |
| 1 | 8h | 🔴 BLOQUANTE |
| 2 | 3h | 🟠 Important |
| 3 | 3h | 🟠 Important |
| 4 | 4h | 🟠 Important |
| 5 | 4h | 🟠 Important |
| 6 | 5h | 🔴 BLOQUANTE |
| 7 | 5h | 🟠 Important |
| 8 | 3h | 🟠 Important |
| 9 | 4h | 🟢 Nice-to-have |
| 10 | 3h | 🟠 Important |
| 11 | 3h | 🟠 Important |
| 12 | 5h | 🟠 Important |
| 13 | 4h | 🟠 Important |
| 14 | 4h | 🟢 Nice-to-have |
| 15 | 2h | 🟢 Nice-to-have |
| 16 | 3h | 🟢 Nice-to-have |
| 17 | 6h | 🟠 Important |
| 18 | 4h | 🟠 Important |
| 19 | 3h | 🟢 Nice-to-have |
| **TOTAL** | **~80h** | - |

---

**Bon courage! 🚀**
