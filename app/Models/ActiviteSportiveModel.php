<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteSportiveModel extends Model
{
    protected $table = 'activites_sportives';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nom', 'description', 'calories', 'niveau'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|max_length[255]',
        'description' => 'permit_empty',
        'calories' => 'required|integer',
        'niveau' => 'required|in_list[Facile,Moyen,Difficile]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    public function createActivite($data)
    {
        return $this->insert($data);
    }

    public function getAllActivites()
    {
        return $this->findAll();
    }

    public function getActiviteById($id)
    {
        return $this->find($id);
    }

    public function updateActivite($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteActivite($id)
    {
        return $this->delete($id);
    }
}
