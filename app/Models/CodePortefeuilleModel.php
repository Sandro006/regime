<?php

namespace App\Models;

use CodeIgniter\Model;

class CodePortefeuilleModel extends Model
{
    protected $table            = 'codes_portefeuille';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'code',
        'montant',
        'utilise',
        'utilisateur_id',
        'date_creation',
        'date_utilisation'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'date_creation';
    protected $updatedField  = null;
    protected $deletedField  = null;

    // Validation
    protected $validationRules    = [
        'code'              => 'required|string|unique_except[codes_portefeuille.code,id,{id}]',
        'montant'           => 'required|decimal',
        'utilise'           => 'boolean',
        'utilisateur_id'    => 'permit_empty|integer',
        'date_creation'     => 'permit_empty|valid_date',
        'date_utilisation'  => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [
        'code' => [
            'required'      => 'Le code est requis',
            'unique_except' => 'Ce code existe déjà'
        ],
        'montant' => [
            'required' => 'Le montant est requis',
            'decimal'  => 'Le montant doit être un nombre décimal'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

    // Callbacks
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Récupère un code portefeuille par son code unique
     */
    public function findByCode(string $code)
    {
        return $this->where('code', $code)->first();
    }

    /**
     * Récupère les codes disponibles (non utilisés)
     */
    public function getAvailableCodes()
    {
        return $this->where('utilise', false)->findAll();
    }

    /**
     * Récupère les codes utilisés par un utilisateur
     */
    public function getCodesByUser(int $userId)
    {
        return $this->where('utilisateur_id', $userId)
                    ->where('utilise', true)
                    ->findAll();
    }

    /**
     * Marque un code comme utilisé
     */
    public function markAsUsed(int $codeId, int $userId, string $dateUtilisation)
    {
        return $this->update($codeId, [
            'utilise'           => true,
            'utilisateur_id'    => $userId,
            'date_utilisation'  => $dateUtilisation
        ]);
    }

    /**
     * Compte les codes disponibles
     */
    public function countAvailable()
    {
        return $this->where('utilise', false)->countAllResults();
    }

    /**
     * Compte les codes utilisés
     */
    public function countUsed()
    {
        return $this->where('utilise', true)->countAllResults();
    }
}
