<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'utilisateur_id',
        'type',
        'montant',
        'date_transaction',
        'description'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'date_transaction';
    protected $updatedField  = null;
    protected $deletedField  = null;

    // Validation
    protected $validationRules    = [
        'utilisateur_id'    => 'required|integer',
        'type'              => 'required|in_list[Recharge,Achat,Gold,Remboursement]',
        'montant'           => 'required|decimal',
        'date_transaction'  => 'permit_empty|valid_date',
        'description'       => 'permit_empty|string'
    ];

    protected $validationMessages = [
        'utilisateur_id' => [
            'required' => 'L\'utilisateur est requis',
            'integer'  => 'L\'ID utilisateur doit être un nombre'
        ],
        'type' => [
            'required'  => 'Le type de transaction est requis',
            'in_list'   => 'Le type doit être: Recharge, Achat, Gold ou Remboursement'
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
     * Récupère l'historique des transactions d'un utilisateur
     */
    public function getByUser(int $userId, int $limit = 50)
    {
        return $this->where('utilisateur_id', $userId)
                    ->orderBy('date_transaction', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Récupère les transactions d'un type spécifique pour un utilisateur
     */
    public function getByUserAndType(int $userId, string $type)
    {
        return $this->where('utilisateur_id', $userId)
                    ->where('type', $type)
                    ->orderBy('date_transaction', 'DESC')
                    ->findAll();
    }

    /**
     * Calcule le total des transactions pour un utilisateur
     */
    public function getTotalByUser(int $userId, string $type = null)
    {
        $builder = $this->where('utilisateur_id', $userId);
        
        if ($type !== null) {
            $builder->where('type', $type);
        }
        
        $result = $builder->selectSum('montant')->first();
        return $result['montant'] ?? 0;
    }

    /**
     * Récupère les transactions d'une période donnée
     */
    public function getByDateRange(string $startDate, string $endDate)
    {
        return $this->where('date_transaction >=', $startDate)
                    ->where('date_transaction <=', $endDate)
                    ->orderBy('date_transaction', 'DESC')
                    ->findAll();
    }

    /**
     * Compte les transactions par type pour un utilisateur
     */
    public function countByType(int $userId, string $type)
    {
        return $this->where('utilisateur_id', $userId)
                    ->where('type', $type)
                    ->countAllResults();
    }

    /**
     * Crée une nouvelle transaction
     */
    public function createTransaction(int $userId, string $type, float $montant, string $description = null)
    {
        $data = [
            'utilisateur_id'   => $userId,
            'type'             => $type,
            'montant'          => $montant,
            'date_transaction' => date('Y-m-d H:i:s'),
            'description'      => $description
        ];

        return $this->insert($data);
    }

    /**
     * Récupère les statistiques des transactions pour un utilisateur
     */
    public function getStatsByUser(int $userId)
    {
        $stats = [];
        
        foreach (['Recharge', 'Achat', 'Gold', 'Remboursement'] as $type) {
            $stats[$type] = [
                'total'  => $this->getTotalByUser($userId, $type),
                'count'  => $this->countByType($userId, $type)
            ];
        }

        return $stats;
    }
}
