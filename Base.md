# STRUCTURE BASE DE DONNÉES — RÉGIME ALIMENTAIRE

## Objectif

Cette structure propose une organisation propre et professionnelle de la base de données du projet.

L’objectif est de :

- éviter les tables trop grosses
- faciliter les CRUD
- rendre le backend plus maintenable
- avoir des relations SQL propres

---

# STRUCTURE CONSEILLÉE

### 1.Utilisatuer

```sql
id
nom
email
motdepasse
genre
taille
poids
solde
gold
date_inscription
```
### 2.Objectif : Liste des objectifs disponibles dans l’application.

```sql
id
nom
description
```

### 3.Utilisatuer_Objectif : Table de liaison entre utilisateur et objectifs

```sql
id
utilisateur_id
objectif_id
date_choix
```

### 4.Regime : Contient tous les régimes alimentaires.

```sql
id
nom
description
prix
duree
variation_poids
pourcentage_viande
pourcentage_poisson
pourcentage_volaille
```

### 5.activites_sportives : Liste des activités sportives disponibles.

```sql
id
nom
description
calories
niveau
```

### 6.regime_activite : Table de liaison entre régimes et activités sportives.

```sql
id
regime_id
activite_id
```


### 7.utilisateur_regimes : Regimes utlisées par l'utilisateur

```sql
id
utilisateur_id
regime_activies_id
date_debut
date_fin
```

### 8.Achat_regimes : Historique des achats effectués par les utilisateurs.

```sql
id
utilisateur_id
regime_id
prix_paye
date_achat
```

### 9.Code_Portefeuille : Codes utilisés pour recharger le portefeuille virtuel.

```sql
id
code
montant
utilise
date_creation
```

### 10.Transaction : Historique financier des utilisateurs.

```sql
id
utilisateur_id
type
montant
date_transaction
```

### 11. Abonnement : Gestion des abonnements

```sql
id
utilisateur_id
date_activation
prix
```

### 12.Admins : Comptes administrateurs pour le back office.

```sql
id
nom
email
motdepasse
```

### 13.Parametre : Table des paramètres globaux de l’application

```sql
id
cle
valeur
```


**PS** : Évite de coder les valeurs directement dans le projet.