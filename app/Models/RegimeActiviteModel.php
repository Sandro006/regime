<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeActiviteModel extends Model
{
    protected $table = 'regime_activite';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'regime_id',
        'activite_id'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'regime_id' => 'required|integer|is_not_unique[regimes.id]',
        'activite_id' => 'required|integer|is_not_unique[activites_sportives.id]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    /**
     * Récupérer le premier enregistrement pour un régime
     */
    public function getFirstByRegimeId(int $regimeId)
    {
        return $this->where('regime_id', $regimeId)->first();
    }

    /**
     * Récupérer tous les enregistrements pour un régime avec détails
     */
    public function getByRegimeIdWithDetails(int $regimeId)
    {
        return $this->select('regime_activite.*, regimes.nom_regime, activites_sportives.nom_activite')
                    ->join('regimes', 'regimes.id = regime_activite.regime_id', 'left')
                    ->join('activites_sportives', 'activites_sportives.id = regime_activite.activite_id', 'left')
                    ->where('regime_activite.regime_id', $regimeId)
                    ->findAll();
    }

    /**
     * Récupérer tous les enregistrements pour une activité
     */
    public function getByActiviteId(int $activiteId)
    {
        return $this->where('activite_id', $activiteId)->findAll();
    }
}
