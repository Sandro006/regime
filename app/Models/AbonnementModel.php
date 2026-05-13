<?php
namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class AbonnementModel extends Model
{
    protected $table = 'abonnements';
    protected $primaryKey = 'id';
    protected $allowedFields = ['utilisateur_id', 'date_activation', 'prix'];
    protected $useTimestamps = false;
    protected $returnType = 'object';

    // Durée des abonnements en jours (peut être stockée en DB ou en config)
    private $dureeAbonnements = [
        'basic' => 30,      // 1 mois
        'premium' => 90,    // 3 mois
        'platinium' => 365  // 1 an
    ];

    /**
     * Vérifie si un utilisateur a un abonnement actif
     * @param int $userId
     * @return object|null
     */
    public function getAbonnementActif($userId)
    {
        $abonnement = $this->where('utilisateur_id', $userId)
                    ->orderBy('date_activation', 'DESC')
                    ->first();
        
        if (!$abonnement) {
            return null;
        }

        // Vérifier si l'abonnement est encore valide (ex: 30 jours par défaut)
        if ($this->estValide($abonnement)) {
            return $abonnement;
        }

        return null;
    }

    /**
     * Vérifie si un abonnement est encore valide
     * @param object $abonnement
     * @return bool
     */
    public function estValide($abonnement)
    {
        // Si pas de date d'activation, invalide
        if (!$abonnement->date_activation) {
            return false;
        }

        // Durée de validité (30 jours par défaut)
        $dureeValidite = $this->getDureeValidite();
        
        $dateActivation = new DateTime($abonnement->date_activation);
        $dateExpiration = clone $dateActivation;
        $dateExpiration->modify("+{$dureeValidite} days");
        
        $now = new DateTime();
        
        return $now <= $dateExpiration;
    }

    /**
     * Récupère la durée de validité d'un abonnement
     * Peut être récupérée depuis la table paramètres
     * @return int
     */
    private function getDureeValidite()
    {
        // Option 1: Valeur par défaut
        return 30;
        
        // Option 2: Depuis la table paramètres
        // $paramModel = model('ParametreModel');
        // $duree = $paramModel->getValeur('duree_abonnement');
        // return $duree ? (int)$duree : 30;
    }

    /**
     * Récupère la date d'expiration calculée d'un abonnement
     * @param int $userId
     * @return string|null
     */
    public function getDateExpiration($userId)
    {
        $abonnement = $this->getAbonnementActif($userId);
        
        if (!$abonnement) {
            return null;
        }
        
        $dateActivation = new DateTime($abonnement->date_activation);
        $dureeValidite = $this->getDureeValidite();
        $dateActivation->modify("+{$dureeValidite} days");
        
        return $dateActivation->format('Y-m-d H:i:s');
    }

    /**
     * Récupère tous les abonnements d'un utilisateur (historique)
     * @param int $userId
     * @return array
     */
    public function getAbonnementsByUser($userId)
    {
        return $this->where('utilisateur_id', $userId)
                    ->orderBy('date_activation', 'DESC')
                    ->findAll();
    }

    /**
     * Vérifie si l'utilisateur a un abonnement valide
     * @param int $userId
     * @return bool
     */
    public function hasActiveSubscription($userId)
    {
        $abonnement = $this->getAbonnementActif($userId);
        return !is_null($abonnement);
    }

    /**
     * Crée un nouvel abonnement pour un utilisateur
     * @param int $userId
     * @param float $prix
     * @return bool|int
     */
    public function createAbonnement($userId, $prix)
    {
        // Désactiver l'ancien abonnement (optionnel - on garde l'historique)
        // On ajoute simplement un nouvel enregistrement
        
        $data = [
            'utilisateur_id' => $userId,
            'prix' => $prix,
            'date_activation' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    /**
     * Renouvelle l'abonnement d'un utilisateur
     * @param int $userId
     * @param float $prix
     * @return bool|int
     */
    public function renouvelerAbonnement($userId, $prix)
    {
        // Créer un nouvel abonnement (historique conservé)
        return $this->createAbonnement($userId, $prix);
    }

    /**
     * Récupère les jours restants de l'abonnement
     * @param int $userId
     * @return int|null
     */
    public function getJoursRestants($userId)
    {
        $abonnement = $this->getAbonnementActif($userId);
        
        if (!$abonnement) {
            return null;
        }
        
        $dateActivation = new DateTime($abonnement->date_activation);
        $dureeValidite = $this->getDureeValidite();
        $dateExpiration = clone $dateActivation;
        $dateExpiration->modify("+{$dureeValidite} days");
        
        $now = new DateTime();
        
        if ($now > $dateExpiration) {
            return 0;
        }
        
        $interval = $now->diff($dateExpiration);
        return (int)$interval->format('%a');
    }

    /**
     * Récupère la date d'expiration formatée
     * @param int $userId
     * @return string|null
     */
    public function getDateExpirationFormatee($userId)
    {
        $dateExpiration = $this->getDateExpiration($userId);
        
        if (!$dateExpiration) {
            return null;
        }
        
        return date('d/m/Y', strtotime($dateExpiration));
    }

    /**
     * Vérifie si l'abonnement expire bientôt (dans moins de X jours)
     * @param int $userId
     * @param int $seuilJours
     * @return bool
     */
    public function expireBientot($userId, $seuilJours = 7)
    {
        $joursRestants = $this->getJoursRestants($userId);
        
        if ($joursRestants === null) {
            return false;
        }
        
        return $joursRestants <= $seuilJours && $joursRestants > 0;
    }

    /**
     * Récupère le nombre total d'abonnés actifs
     * @return int
     */
    public function getTotalAbonnesActifs()
    {
        $allAbonnements = $this->findAll();
        $count = 0;
        
        foreach ($allAbonnements as $abonnement) {
            // Grouper par utilisateur pour éviter les doublons
            if ($this->estValide($abonnement)) {
                // Vérifier si l'utilisateur n'a pas déjà été compté
                // Une meilleure approche serait de faire une requête SQL plus complexe
                $count++;
            }
        }
        
        return $count;
    }

    /**
     * Récupère le dernier abonnement d'un utilisateur
     * @param int $userId
     * @return object|null
     */
    public function getDernierAbonnement($userId)
    {
        return $this->where('utilisateur_id', $userId)
                    ->orderBy('date_activation', 'DESC')
                    ->first();
    }

    /**
     * Vérifie si l'utilisateur a déjà eu un abonnement
     * @param int $userId
     * @return bool
     */
    public function aDejaEuAbonnement($userId)
    {
        return $this->where('utilisateur_id', $userId)
                    ->countAllResults() > 0;
    }

    /**
     * Calcule le pourcentage de remise basé sur l'abonnement
     * @param int $userId
     * @return int
     */
    public function getRemiseAbonnement($userId)
    {
        if (!$this->hasActiveSubscription($userId)) {
            return 0;
        }
        
        // Remise selon l'ancienneté ou le type d'abonnement
        $abonnement = $this->getDernierAbonnement($userId);
        $dateActivation = new DateTime($abonnement->date_activation);
        $now = new DateTime();
        $moinsAnciennete = $dateActivation->diff($now)->days / 30;
        
        if ($moinsAnciennete >= 12) {
            return 20; // 20% de remise pour les membres depuis plus d'un an
        } elseif ($moinsAnciennete >= 6) {
            return 15; // 15% pour 6 mois
        } elseif ($moinsAnciennete >= 3) {
            return 10; // 10% pour 3 mois
        }
        
        return 5; // 5% de remise de base
    }
}