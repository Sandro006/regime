```md
# PROJET S4 — APPLICATION DE RÉGIME ALIMENTAIRE

## Objectif du projet

Développer une application web permettant à un utilisateur de :

- calculer son IMC
- définir un objectif physique
- recevoir des régimes alimentaires adaptés
- recevoir des activités sportives adaptées
- gérer un portefeuille virtuel
- acheter des régimes
- accéder à une option Gold (Via le code rechargeable ou code promo)

Le projet est séparé en :

- Front Office (Utilisateur)
- Back Office (Administrateur)

Technologies imposées :

- PHP + CodeIgniter
- HTML / CSS
- JavaScript / AJAX
- MySQL ou PostgreSQL

---

# STRUCTURE GÉNÉRALE

## Front Office

Partie visible par les utilisateurs.

## Back Office

Partie administration.

---

# FRONT OFFICE

# 1. AUTHENTIFICATION

## 1.1 Inscription

L’inscription doit être divisée en 2 étapes.

### Étape 1 : Informations personnelles

Champs :

- nom
- email
- mot de passe
- genre

### Étape 2 : Informations santé

Champs :

- taille
- poids

### Fonctionnalités attendues

- validation des champs
- vérification email unique
- hash du mot de passe
- sauvegarde utilisateur

---

## 1.2 Connexion

### Champs

- email
- mot de passe

### Fonctionnalités attendues

- vérification utilisateur
- création session
- gestion erreurs login

---

## 1.3 Déconnexion

### Fonctionnalités attendues

- destruction session
- redirection accueil/login

---

# 2. PROFIL UTILISATEUR

## Fonctionnalités attendues

- afficher informations utilisateur
- modifier profil
- modifier poids/taille
- afficher IMC
- afficher statut Gold
- afficher solde portefeuille

### Données affichées

- nom
- email
- genre
- taille
- poids
- IMC
- solde
- statut Gold

---

# 3. CALCUL IMC

## Formule

IMC = poids / taille²

### Exemple

70kg et 1.75m

IMC = 22.8

---

## Fonctionnalités attendues

- calcul automatique
- affichage catégorie IMC

### Catégories possibles

| IMC | État |
|---|---|
| < 18.5 | Maigre |
| 18.5 - 25 | Normal |
| > 25 | Surpoids |

---

# 4. OBJECTIFS UTILISATEUR

L’utilisateur peut choisir un objectif.

## Objectifs possibles

### 1. Augmenter son poids

### 2. Réduire son poids

### 3. Atteindre son IMC idéal

---

## Fonctionnalités attendues

- sélection objectif
- sauvegarde objectif
- affichage recommandations adaptées

---

# 5. GESTION DES RÉGIMES

## Fonctionnalités attendues

- afficher liste régimes
- afficher détails régime
- afficher prix
- afficher durée
- afficher variation poids

---

## Informations d’un régime

- nom
- prix
- durée
- variation poids
- % viande
- % poisson
- % volaille

---

## Exemple

| Régime | Durée | Variation |
|---|---|---|
| Keto | 30 jours | -5kg |
| Mass Gain | 60 jours | +8kg |

---

# 6. ACTIVITÉS SPORTIVES

## Fonctionnalités attendues

- afficher activités sportives
- associer activités aux objectifs

---

## Exemples activités

- cardio
- jogging
- musculation
- yoga
- HIIT

---

# 7. PORTEFEUILLE VIRTUEL

## Fonctionnalité principale

Ajouter de l’argent avec un code.

---

## Fonctionnement

1. utilisateur entre un code
2. système vérifie le code
3. si valide :
   - ajout argent
   - code marqué utilisé

---

## Fonctionnalités attendues

- saisie code
- validation code
- ajout solde
- empêcher double utilisation
- affichage solde

---

## Bonus

Historique transactions.

---

# 8. OPTION GOLD

## Fonctionnalités attendues

- achat Gold
- activation Gold
- remise automatique 15%

---

## Effets Gold

- réduction sur tous les régimes

---

# 9. ACHAT DE RÉGIMES

## Fonctionnalités attendues

- achat régime
- déduction portefeuille
- vérification solde suffisant

---

# 10. EXPORT PDF

## Fonctionnalités attendues

Exporter en PDF :

- profil utilisateur
- IMC
- régimes
- programme sportif

---

# 11. DASHBOARD UTILISATEUR

## Informations affichées

- IMC
- objectif
- poids
- solde
- régimes actifs
- activités sportives

---

# BACK OFFICE

# 1. AUTHENTIFICATION ADMIN

## Fonctionnalités attendues

- login admin
- sécurité accès admin

---

# 2. DASHBOARD ADMIN

## Fonctionnalités attendues

Afficher statistiques :

- nombre utilisateurs
- revenus
- utilisateurs Gold
- régimes populaires

---

## Graphiques

Utiliser :

- Chart.js
- ApexCharts
- etc.

---

# 3. CRUD RÉGIMES

## Fonctionnalités attendues

### Ajouter régime

### Modifier régime

### Supprimer régime

### Voir liste régimes

---

## Champs régime

- nom
- prix
- durée
- variation poids
- % viande
- % poisson
- % volaille

---

# 4. CRUD ACTIVITÉS SPORTIVES

## Fonctionnalités attendues

### Ajouter activité

### Modifier activité

### Supprimer activité

### Voir activités

---

# 5. GESTION CODES PORTEFEUILLE

## Fonctionnalités attendues

### Créer codes

### Voir codes

### Désactiver codes

### Vérifier utilisation

---

## Informations code

- code
- montant
- utilisé/non utilisé

---

# 6. PARAMÈTRES APPLICATION

## Fonctionnalités attendues

Gestion :

- prix Gold
- pourcentage réduction
- paramètres IMC
- paramètres système

---

# 7. GESTION UTILISATEURS

## Fonctionnalités conseillées

### Voir utilisateurs

### Voir abonnés Gold

### Désactiver utilisateur

---

# BASE DE DONNÉES

## utilisateurs

Contient :

- informations utilisateur
- poids
- taille
- solde
- Gold

---

## regimes

Contient :

- informations régimes

---

## activites

Contient :

- informations sportives

---

## codes

Contient :

- codes recharge portefeuille

---

## achats_regimes

Contient :

- achats utilisateurs

---

## objectifs

Contient :

- objectifs utilisateurs

---

## transactions (bonus)

Contient :

- historique portefeuille

---

# UI / UX ATTENDU

## Front Office

- design moderne
- responsive
- animations
- dashboard propre

---

## Back Office

- dashboard admin
- tableaux
- statistiques
- CRUD ergonomiques

---

# BONUS CONSEILLÉS

## Fonctionnalités bonus

- dark mode
- historique IMC
- graphique évolution poids
- notifications
- AJAX sans reload
- upload photo profil
- génération programme automatique

---

# POINTS IMPORTANTS

## Git

- commits réguliers
- push fréquents
- merge vers main

---

## Architecture

Respecter MVC :

- Models
- Views
- Controllers

---
```
