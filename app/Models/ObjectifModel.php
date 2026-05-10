<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifModel extends Model
{
    protected $table = 'objectifs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'objectif', 'description'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'objectif' => 'required|max_length[255]',
        'description' => 'permit_empty'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // Données pré-insérées en BD (3 objectifs)
    // 1. Réduire poids
    // 2. Augmenter poids
    // 3. IMC idéal

    public function createObjectif($data)
    {
        return $this->insert($data);
    }

    public function getAllObjectifs()
    {
        return $this->findAll();
    }

    public function getObjectifById($id)
    {
        return $this->find($id);
    }

    public function updateObjectif($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteObjectif($id)
    {
        return $this->delete($id);
    }
}