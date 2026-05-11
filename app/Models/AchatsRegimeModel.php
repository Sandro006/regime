<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatsRegimeModel extends Model
{
    protected $table = 'achats_regimes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'regime_id',
        'prix_paye',
        'date_achat'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'user_id' => 'required|integer|is_not_unique[users.id]',
        'regime_id' => 'required|integer|is_not_unique[regimes.id]',
        'prix_paye' => 'required|decimal',
        'date_achat' => 'permit_empty|valid_date[Y-m-d H:i:s]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    /**
     * Récupérer les achats d'un utilisateur
     */
    public function getByUserId(int $userId, int $limit = 50)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('date_achat', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Récupérer un achat spécifique
     */
    public function getAchatWithRegime(int $achatId)
    {
        return $this->select('achats_regimes.*, regimes.nom_regime, regimes.description, regimes.prix')
                    ->join('regimes', 'regimes.id = achats_regimes.regime_id', 'left')
                    ->where('achats_regimes.id', $achatId)
                    ->first();
    }

    /**
     * Récupérer tous les achats d'un utilisateur avec détails du régime
     */
    public function getByUserIdWithDetails(int $userId)
    {
        return $this->select('achats_regimes.*, regimes.nom_regime, regimes.description, regimes.prix')
                    ->join('regimes', 'regimes.id = achats_regimes.regime_id', 'left')
                    ->where('achats_regimes.user_id', $userId)
                    ->orderBy('achats_regimes.date_achat', 'DESC')
                    ->findAll();
    }

    /**
     * Obtenir les statistiques d'achat pour un utilisateur
     */
    public function getStatsByUserId(int $userId)
    {
        return $this->select('COUNT(*) as total_achats, SUM(prix_paye) as total_depense')
                    ->where('user_id', $userId)
                    ->first();
    }

    /**
     * Vérifier si un utilisateur a déjà acheté un régime
     */
    public function hasUserPurchased(int $userId, int $regimeId)
    {
        return $this->where('user_id', $userId)
                    ->where('regime_id', $regimeId)
                    ->first() !== null;
    }
}
