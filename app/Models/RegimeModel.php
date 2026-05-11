<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regimes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nom_regime', 
        'description', 
        'prix', 
        'duree', 
        'variation_poids', 
        'pourcentage_viande', 
        'pourcentage_poisson', 
        'pourcentage_volaille'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nom_regime' => 'required|max_length[255]',
        'description' => 'permit_empty',
        'prix' => 'permit_empty|decimal',
        'duree' => 'permit_empty|integer',
        'variation_poids' => 'permit_empty|decimal',
        'pourcentage_viande' => 'permit_empty|decimal',
        'pourcentage_poisson' => 'permit_empty|decimal',
        'pourcentage_volaille' => 'permit_empty|decimal'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    /**
     * Récupérer tous les régimes
     */
    public function getAllRegimes()
    {
        return $this->findAll();
    }

    /**
     * Récupérer un régime par son ID
     */
    public function getRegimeById($id)
    {
        return $this->find($id);
    }

    /**
     * Créer un nouveau régime
     */
    public function createRegime($data)
    {
        return $this->insert($data);
    }

    /**
     * Mettre à jour un régime
     */
    public function updateRegime($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Supprimer un régime
     */
    public function deleteRegime($id)
    {
        return $this->delete($id);
    }

    /**
     * Récupérer les régimes avec leurs activités associées
     */
    public function getRegimesWithActivities()
    {
        return $this->select('regimes.*, GROUP_CONCAT(activites_sportives.nom_activite) as activites')
                    ->join('regime_activite', 'regimes.id = regime_activite.regime_id', 'left')
                    ->join('activites_sportives', 'regime_activite.activite_id = activites_sportives.id', 'left')
                    ->groupBy('regimes.id')
                    ->findAll();
    }

    /**
     * Récupérer un régime avec ses activités associées
     */
    public function getRegimeWithActivities($id)
    {
        return $this->select('regimes.*, activites_sportives.id as activite_id, activites_sportives.nom_activite, activites_sportives.description as activite_description')
                    ->join('regime_activite', 'regimes.id = regime_activite.regime_id', 'left')
                    ->join('activites_sportives', 'regime_activite.activite_id = activites_sportives.id', 'left')
                    ->where('regimes.id', $id)
                    ->findAll();
    }

    /**
     * Récupérer les régimes par prix (filtrage)
     */
    public function getRegimesByPriceRange($minPrice, $maxPrice)
    {
        return $this->where('prix >=', $minPrice)
                    ->where('prix <=', $maxPrice)
                    ->findAll();
    }

    /**
     * Récupérer les régimes par durée
     */
    public function getRegimesByDuration($duration)
    {
        return $this->where('duree', $duration)
                    ->findAll();
    }

    /**
     * Compter le nombre total de régimes
     */
    public function getTotalRegimes()
    {
        return $this->countAll();
    }

    /**
     * Récupérer les régimes populaires (triés par prix)
     */
    public function getPopularRegimes($limit = 10)
    {
        return $this->orderBy('prix', 'ASC')
                    ->limit($limit)
                    ->findAll();
    }
}
