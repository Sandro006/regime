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

    protected $allowedFields = [
        'user_id',
        'type',
        'montant',
        'date_transaction',
        'description'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'date_transaction';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules = [
        'user_id'           => 'required|integer',
        'type'              => 'required|in_list[Recharge,Achat,Gold,Remboursement]',
        'montant'           => 'required|decimal',
        'date_transaction'  => 'permit_empty|valid_date',
        'description'       => 'permit_empty|string'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => "L'utilisateur est requis",
            'integer'  => "L'ID utilisateur doit être un nombre"
        ],
        'type' => [
            'required' => 'Le type de transaction est requis',
            'in_list'  => 'Le type doit être: Recharge, Achat, Gold ou Remboursement'
        ],
        'montant' => [
            'required' => 'Le montant est requis',
            'decimal'  => 'Le montant doit être un nombre décimal'
        ]
    ];

    public function getByUser(int $userId, int $limit = 50)
    {
        return $this->where('user_id', $userId)
            ->orderBy('date_transaction', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getByUserAndType(int $userId, string $type)
    {
        return $this->where('user_id', $userId)
            ->where('type', $type)
            ->orderBy('date_transaction', 'DESC')
            ->findAll();
    }

    public function getTotalByUser(int $userId, string $type = null)
    {
        $builder = $this->where('user_id', $userId);

        if ($type !== null) {
            $builder->where('type', $type);
        }

        $result = $builder->selectSum('montant')->first();
        return $result['montant'] ?? 0;
    }

    public function getByDateRange(string $startDate, string $endDate)
    {
        return $this->where('date_transaction >=', $startDate)
            ->where('date_transaction <=', $endDate)
            ->orderBy('date_transaction', 'DESC')
            ->findAll();
    }

    public function countByType(int $userId, string $type)
    {
        return $this->where('user_id', $userId)
            ->where('type', $type)
            ->countAllResults();
    }

    public function createTransaction(int $userId, string $type, float $montant, string $description = null)
    {
        return $this->insert([
            'user_id'           => $userId,
            'type'              => $type,
            'montant'          => $montant,
            'date_transaction' => date('Y-m-d H:i:s'),
            'description'      => $description
        ]);
    }

    public function getStatsByUser(int $userId)
    {
        $stats = [];

        foreach (['Recharge', 'Achat', 'Gold', 'Remboursement'] as $type) {
            $stats[$type] = [
                'total' => $this->getTotalByUser($userId, $type),
                'count' => $this->countByType($userId, $type)
            ];
        }

        return $stats;
    }
}

