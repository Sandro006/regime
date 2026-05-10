<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nom', 'email', 'motdepasse', 'genre', 
        'taille', 'poids', 'solde', 'gold'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'date_inscription';
    protected $updatedField = false;
    protected $deletedField = false;

    // Validation
    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'motdepasse' => 'required|min_length[6]',
        'genre' => 'required|in_list[M,F]',
        'taille' => 'required|decimal|greater_than[0]|less_than[3]',
        'poids' => 'required|decimal|greater_than[0]|less_than[500]',
        'solde' => 'permit_empty|decimal',
        'gold' => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // Hashage automatique du mot de passe
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['motdepasse'])) {
            $data['data']['motdepasse'] = password_hash($data['data']['motdepasse'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // ============ CRUD METHODS ============

    /**
     * CREATE - Créer un utilisateur
     */
    public function createUser($data)
    {
        return $this->insert($data);
    }

    /**
     * READ - Récupérer tous les utilisateurs
     */
    public function getAllUsers()
    {
        return $this->findAll();
    }

    /**
     * READ - Récupérer un utilisateur par ID
     */
    public function getUserById($id)
    {
        return $this->find($id);
    }

    /**
     * READ - Récupérer un utilisateur par email
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * UPDATE - Mettre à jour un utilisateur
     */
    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * DELETE - Supprimer un utilisateur
     */
    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    /**
     * DELETE (soft) - Marquage comme supprimé (si useSoftDeletes = true)
     */
    public function softDeleteUser($id)
    {
        return $this->delete($id);
    }
}