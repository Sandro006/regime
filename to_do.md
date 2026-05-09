### objectif
- Donner le IMC (Indice de masse corporelle) de l'utilisateur
- offrire des suggestions de plat selon le types de regime selectionner avec prix des plats
- donner des suggestion d'activiter sportive selon le types de regime selectionner
- Ajouter de l'argent dans le compte de l'utilisateur
- Ajouter l'option Gold: remis de 15% sur tous les regimes 
- Ajouter page d'authentifiCATION (CAPCHA)
- Ajouter tableau de bord, statistiques (mettre des graphes, des
tableaux croisés, …)
- changer le prix des plats selon la durre estimer du regime

### Base

## Tableau
- Utilisateur
    - id
    - nom
    - prenom
    - age
    - mail
    - genre
    - poid
    - taille

- Type_Regime
    - id
    - type

- Ingredient
    - id
    - nom
    - calorie

- Plat 
    - id
    - nom
    - ingredients(liste)
    - prix
    - date_creation

- Sport
    - id
    - nom
    - calorie depenser/heure

- Option
    - id
    - nom
    - %reduction

- Commpte_utilisateur
    - id
    - id_utilisateur
    - montant
    - id_otpion

- Regime
    - id
    - id_type
    - date_debut
    - date fin
    - prix plat

