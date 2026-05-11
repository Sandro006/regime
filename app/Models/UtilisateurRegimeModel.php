<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurRegimeModel extends Model
{
    protected $table = 'utilisateurs_regimes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'regime_activite_id',
        'date_debut',
        'date_fin'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'user_id' => 'required|integer|is_not_unique[users.id]',
        'regime_activite_id' => 'required|integer|is_not_unique[regime_activite.id]',
        'date_debut' => 'permit_empty|valid_date[Y-m-d H:i:s]',
        'date_fin' => 'permit_empty|valid_date[Y-m-d H:i:s]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    /**
     * Récupérer les régimes actifs d'un utilisateur (en cours)
     */
    public function getActiveByUserId(int $userId)
    {
        return $this->where('user_id', $userId)
                    ->where('date_fin IS NULL')
                    ->findAll();
    }

    /**
     * Récupérer tous les régimes d'un utilisateur
     */
    public function getByUserId(int $userId, int $limit = 50)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('date_debut', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Récupérer un régime utilisateur avec détails complets
     */
    public function getWithDetails(int $regimeUtilisateurId)
    {
        return $this->select('utilisateurs_regimes.*, 
                            regimes.nom_regime, 
                            regimes.description, 
                            regimes.prix,
                            regimes.duree,
                            regimes.variation_poids,
                            regimes.pourcentage_viande,
                            regimes.pourcentage_poisson,
                            regimes.pourcentage_volaille,
                            activites_sportives.nom_activite,
                            activites_sportives.calories_brulees')
                    ->join('regime_activite', 'regime_activite.id = utilisateurs_regimes.regime_activite_id', 'left')
                    ->join('regimes', 'regimes.id = regime_activite.regime_id', 'left')
                    ->join('activites_sportives', 'activites_sportives.id = regime_activite.activite_id', 'left')
                    ->where('utilisateurs_regimes.id', $regimeUtilisateurId)
                    ->first();
    }

    /**
     * Récupérer tous les régimes d'un utilisateur avec détails
     */
    public function getByUserIdWithDetails(int $userId)
    {
        return $this->select('utilisateurs_regimes.*, 
                            regimes.nom_regime, 
                            regimes.description, 
                            regimes.prix,
                            regimes.duree,
                            activites_sportives.nom_activite')
                    ->join('regime_activite', 'regime_activite.id = utilisateurs_regimes.regime_activite_id', 'left')
                    ->join('regimes', 'regimes.id = regime_activite.regime_id', 'left')
                    ->join('activites_sportives', 'activites_sportives.id = regime_activite.activite_id', 'left')
                    ->where('utilisateurs_regimes.user_id', $userId)
                    ->orderBy('utilisateurs_regimes.date_debut', 'DESC')
                    ->findAll();
    }

    /**
     * Marquer un régime comme terminé
     */
    public function completeRegime(int $regimeUtilisateurId)
    {
        return $this->update($regimeUtilisateurId, [
            'date_fin' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Obtenir le régime actuel d'un utilisateur
     */
    public function getCurrentRegime(int $userId)
    {
        return $this->select('utilisateurs_regimes.*, 
                            regimes.nom_regime, 
                            regimes.description,
                            activites_sportives.nom_activite')
                    ->join('regime_activite', 'regime_activite.id = utilisateurs_regimes.regime_activite_id', 'left')
                    ->join('regimes', 'regimes.id = regime_activite.regime_id', 'left')
                    ->join('activites_sportives', 'activites_sportives.id = regime_activite.activite_id', 'left')
                    ->where('utilisateurs_regimes.user_id', $userId)
                    ->where('utilisateurs_regimes.date_fin IS NULL')
                    ->first();
    }

    /**
     * Vérifier si un utilisateur a ce régime d'activité
     */
    public function hasUserRegime(int $userId, int $regimeActiviteId)
    {
        return $this->where('user_id', $userId)
                    ->where('regime_activite_id', $regimeActiviteId)
                    ->first() !== null;
    }

    /**
     * Obtenir les statistiques d'un utilisateur
     */
    public function getStatsByUserId(int $userId)
    {
        return $this->select('COUNT(*) as total_regimes, 
                            COUNT(CASE WHEN date_fin IS NULL THEN 1 END) as regimes_actifs,
                            COUNT(CASE WHEN date_fin IS NOT NULL THEN 1 END) as regimes_termines')
                    ->where('user_id', $userId)
                    ->first();
    }
}
