<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurObjectifModel extends Model
{
    protected $table = 'utilisateurs_objectifs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id', 'objectif_id', 'date_choix'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'user_id' => 'required|integer',
        'objectif_id' => 'required|integer',
        'date_choix' => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // ============ CRUD METHODS ============

    public function createAssociation($data)
    {
        return $this->insert($data);
    }

    public function getAllAssociations()
    {
        return $this->findAll();
    }

    public function getAssociationById($id)
    {
        return $this->find($id);
    }

    public function getAssociationsByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getAssociationsByObjectif($objectifId)
    {
        return $this->where('objectif_id', $objectifId)->findAll();
    }

    public function updateAssociation($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAssociation($id)
    {
        return $this->delete($id);
    }
}