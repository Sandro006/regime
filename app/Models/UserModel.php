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
        'username', 'email', 'password', 'gender', 
        'taille', 'poids', 'solde', 'gold'
    ];

    // Dates
    protected $useTimestamps = false;


    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'gender' => 'required|in_list[male,female]',
        'taille' => 'required|decimal|greater_than[0]|less_than[3]',
        'poids' => 'required|decimal|greater_than[0]|less_than[500]',
        'solde' => 'permit_empty|decimal',
        'gold' => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // ============ CRUD METHODS ============

    public function createUser($data){
        return $this->insert($data);
    }

    public function getAllUsers(){
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
     * LOGIN - Authentifier un utilisateur avec email et mot de passe
     */
    public function login($email, $password)
    {
        // Chercher l'utilisateur par email
        $user = $this->getUserByEmail($email);
        
        if (!$user) {
            return null; // Email non trouvé
        }
        
        // Vérifier le mot de passe
        if (!password_verify($password, $user['password'])) {
            return null; // Mot de passe incorrect
        }
        
        return $user; // Authentification réussie
    }
}